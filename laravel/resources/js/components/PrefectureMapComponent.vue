<template>
  <!-- ここにhtmlを記載します -->

  <div id="prefecture-map" class="">
    <!-- 検索メニュー -->
    <!-- <nav class="navbar navbar-light  bg-light fixed-bottom">
      <i class=""></i>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fas fa-search"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <form class="form-group form-inline">
          <label class="control-label col-4 col-md-2 col-lg-1">都道府県</label>
          <select id="select-pref" class="form-control col-8 col-md-3 col-lg-1" v-model="selectedPref" v-on:change="selectPrefecture">
            <option value="00">指定なし</option>
            <option v-for="pref in prefsData" v-bind:key="pref.id" v-bind:value="pref.id">
              {{ pref.name }}
            </option>
          </select>

          <label class="control-label col-4 col-md-2 col-lg-1">市町村</label>
          <select id="select-municipality" class="form-control col-8 col-md-3 col-lg-2" v-model="selectedMunicipality" v-on:change="selectMunicipality">
            <option value="000000">指定なし</option>
            <option v-for="municipality in municipalityData" v-bind:key="municipality.code" v-bind:value="municipality.code">
              {{ municipality.name }}
            </option>
          </select>

          <label class="control-label col-4 col-md-2 col-lg-1" v-show="isSelectMunicipality">ﾃﾞｰﾀｾｯﾄ</label>
          <select id="select-dataset" class="form-control col-8 col-md-2 col-lg-2" v-show="isSelectMunicipality" v-model="selectedDataset" v-on:change="selectDataSet">
            <option value="00">指定なし</option>
            <option value="1">AED設置箇所一覧</option>
            <option value="2">介護サービス事業所一覧</option>
            <option value="3">医療機関一覧</option>
            <option value="4">文化財一覧</option>
            <option value="5">観光施設一覧</option>
            <option value="6">イベント一覧</option>
            <option value="7">公衆無線LANアクセスポイント一覧</option>
            <option value="8">公衆トイレ一覧</option>
            <option value="9">消防水利施設一覧</option>
            <option value="10">指定緊急避難場所一覧</option>
            <option value="11">地域・年齢別人口</option>
            <option value="12">公共施設一覧</option>
            <option value="13">子育て施設一覧</option>
            <option value="14">オープンデータ一覧</option>
          </select>
        </form>
      </div>
    </nav> -->

    <!-- 都道府県表示 -->
    <div id="map">
      <!-- 自治体表示 -->
      <municipalityMapComponent
        v-bind:bus="bus"
        v-bind:pref-map="mymap"
        v-on:getMunicipalityMapData="setMunicipalityMapData"
        v-on:getMunicipalityFlg="setMunicipalityFlg"
        ref="Prefecturemapcomponent">
      </municipalityMapComponent>
    </div>

  </div>
</template>

<script>
  // ここにjavascriptを記載します

  import 'leaflet/dist/leaflet.css'
  import 'leaflet.defaultextent/dist/leaflet.defaultextent.css'
  import 'leaflet.defaultextent/dist/leaflet.defaultextent.js'
  import 'leaflet-easybutton/src/easy-button.js'
  import 'leaflet-easybutton/src/easy-button.css'
  import 'leaflet.locatecontrol/dist/L.Control.Locate.min.js'
  import 'leaflet.locatecontrol/dist/L.Control.Locate.min.css'
  import 'leaflet-control-window/src/L.Control.Window.js';
  import 'leaflet-control-window/src/L.Control.Window.css';
  import L from 'leaflet'
  import axios from 'axios'
  import municipalityMapComponent from './MunicipalityMapComponent.vue'

  const INIT_LATITUDEXL = 32.6825;
  const INIT_LONGITUDEXL = 131.752778;
  const INIT_ZOOMLEVELXL = 8;
  const INIT_LATITUDE = 33;
  const INIT_LONGITUDE = 131;
  const INIT_ZOOMLEVEL = 7;

  export default {
    components: {
      municipalityMapComponent,
    },

    props: [
      'prefsData',
    ],

    data: function() {
      return {
        bus: new Vue(),
        mymap: null, // 都道府県マップ
        selectedPref: '00', // 都道府県リスト初期値
        selectedPrefData: [], // 選択都道府県データ
        isSelectMunicipality: false, // 自治体リスト選択フラグ
        selectedMunicipality: '000000', // 自治体リスト初期値
        municipalityData: [], // 自治体情報データ
        selectedDataset: '00', // データセットリスト初期値
        datasetData: [], // データセットデータ
        municipalityMarkers: [], // 自治体のマーカー情報
        municipalitydatasetlists: {}, // 自治体のデータセットリスト情報
      };
    },

    mounted: function() {
      $(function() {
        // ハンバーガーメニュークリック
        $('.navbar-toggler').on('click', function() {
          // ハンバーガーメニューの表示／非表示
          if ($('#navbar').hasClass('show')) {
            $('#navbar').removeClass('show');
          } else {
            $('#navbar').addClass('show');
          }
        });
      });

      this.initMap();
    },

    methods: {
      // マップ初期処理
      initMap: function() {
        var self = this;
        var latitude = 0;
        var longitude = 0;
        var zoomlevel = 0;

        // Mapの基本設定
        if (window.parent.screen.width > 567) {
          latitude = INIT_LATITUDEXL;
          longitude = INIT_LONGITUDEXL;
          zoomlevel = INIT_ZOOMLEVELXL;
        } else {
          latitude = INIT_LATITUDE;
          longitude = INIT_LONGITUDE;
          zoomlevel = INIT_ZOOMLEVEL;
        }
        this.mymap = L.map('map', {
          center: [latitude, longitude],
          zoom: zoomlevel,
          zoomControl: false,
          // scrollWheelZoom: false,
        });

        // OSMレイヤー追加
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: "&copy; <a href='http://osm.org/copyright'>OpenStreetMap</a> contributors"
        }).addTo(this.mymap);

        // 虫眼鏡ボタンの追加・アクションの定義
        var searchBtn = L.easyButton({
                        position: 'topleft',
                        states: [{
                          stateName: 'init-map',
                          icon: 'fas fa-search fa-2x',
                          title: '初期表示に戻す',
                          onClick: function(btn, map) {
                            map.setView([latitude, longitude], zoomlevel);
                            btn.state('init-map');
                            // 自治体境のクリア処理
                            self.bus.$emit('clearMunicipalitycoordinates');
                            // 各リストのクリア
                            self.selectedPref = '00';
                            self.municipalityData.length = 0;
                            self.isSelectMunicipality = false;
                            self.selectedMunicipality = '000000';
                            self.selectedDataset = '00';
                            // 現在地のクリア
                            locateBtn.stop();
                          }
                        }],
                      });
        searchBtn.addTo(this.mymap);

        // // ホームボタンの追加・アクションの定義
        // var homeBtn = L.easyButton({
        //                 position: 'bottomright',
        //                 states: [{
        //                   stateName: 'init-map',
        //                   icon: 'fas fa-home fa-2x',
        //                   title: '初期表示に戻す',
        //                   onClick: function(btn, map) {
        //                     map.setView([latitude, longitude], zoomlevel);
        //                     btn.state('init-map');
        //                     // 自治体境のクリア処理
        //                     self.bus.$emit('clearMunicipalitycoordinates');
        //                     // 各リストのクリア
        //                     self.selectedPref = '00';
        //                     self.municipalityData.length = 0;
        //                     self.isSelectMunicipality = false;
        //                     self.selectedMunicipality = '000000';
        //                     self.selectedDataset = '00';
        //                     // 現在地のクリア
        //                     locateBtn.stop();
        //                   }
        //                 }],
        //               });
        // homeBtn.addTo(this.mymap);

        // 現在地ボタンの追加
        var locateZoomLevel = 0;
        if (window.parent.screen.width > 567) {
          locateZoomLevel = 13;
        } else {
          locateZoomLevel = 12;
        }
        var locateBtn = L.control.locate({
                          position: 'bottomright',
                          setView: 'untilPanOrZoom',
                          flyTo: true,
                          drawCircle: false,
                          icon: 'fas fa-location-arrow locate-icon',
                          initialZoomLevel: locateZoomLevel,
                          showPopup: false,
                          strings: {
                            title: "現在地を表示",
                            popup: "",
                          },
                        });
        locateBtn.addTo(this.mymap);

        // ヘルプボタンの追加・アクションの定義
        function getColor(x) {
          return 1 <= x && x < 19 ? 'rgba(255,0,0,0.65)' :
			           20 <= x && x < 39 ? 'rgba(255,165,0,0.65)' :
			           40 <= x && x < 59 ? 'rgba(255,255,0,0.65)' :
			           60 <= x && x < 79 ? 'rgba(124,252,0,0.65)' :
			           80 <= x ? 'rgba(0,176,255,0.65)':
                 'rgba(0,0,0,0.65)';
        }

        var helpContent = '';

        helpContent += '<div class="title-legend">凡例</div>';
        helpContent += '<div class="legend">';
        helpContent += '<i style="background: ' + getColor(0) + ';"></i>' + ' 不参加団体<br>';
			  helpContent += '<i style="background: ' + getColor(1) + ';"></i>' + ' 1点 &ndash; 19点<br>';
			  helpContent += '<i style="background: ' + getColor(20) + ';"></i> ' + '20点 &ndash; 39点<br>';
			  helpContent += '<i style="background: ' + getColor(40) + ';"></i> ' + '40点 &ndash; 59点<br>';
			  helpContent += '<i style="background: ' + getColor(60) + ';"></i> ' + '60点 &ndash; 79点<br>';
        helpContent += '<i style="background: ' + getColor(80) + ';"></i> ' + '80点 &ndash; 100点<br>';
        helpContent += '</div>';
        helpContent += '<footer>';
        helpContent += '<div class="ver-info">';
        helpContent += '<p class="ver-title">バージョン情報</p>';
        helpContent += '<p class="version">OpenDataMapService 1.0</p>';
        helpContent += '<p class="copyright">&copy; 2021 Code for Kanoya</p>';
        helpContent += '<div class="link">';
        helpContent += '<a href="https://code-for-kanoya.github.io/" target="_blank" rel="noopener">公式ホームページ</a>';
        helpContent += '</div>';
        helpContent += '</div>';
        helpContent += '</footer>';

        var helpWindow = L.control.window(map,{
                            title: 'ヘルプ',
                            content: helpContent,
                            position: 'bottomLeft',
                         });
        var helpBtn = L.easyButton({
                        position: 'bottomright',
                        states: [{
                          stateName: 'help',
                          icon: 'fas fa-question fa-2x',
                          title: 'ヘルプ',
                          onClick: function(btn, map) {
                            helpWindow.show();
                          }
                        }],
                      });
        helpBtn.addTo(this.mymap);

        // 県境GeoJsonの読み込み
        axios
          .get('./assets/json/prefectures.geojson')
          .then(function (json) {
            addDataToMap(this.mymap, json.data);
          }.bind(this));

        // 県境情報の各データ追加処理
        function addDataToMap(map, data) {
          var geoJsonLayer = L.geoJson(data, {
            onEachFeature: myOnEachFeature,
          }).addTo(map);
        }

        // onEachFeature設定
        function myOnEachFeature(feature, layer) {
          layer.setStyle(myStyle(feature));
        }

        // スタイル設定
        function myStyle(feature) {
          return {
            color: '#6E6E6E',
            fillOpacity: 0,
          }
        }
      },

      // 都道府県選択処理
      selectPrefecture: function() {
        // 選択した都道府県データを取得
        this.selectedPrefData = this.prefsData.find(pref => pref.id === this.selectedPref);

        // 自治体境の表示
        this.bus.$emit('initMunicipality', { prefData: this.selectedPrefData });

        // 取得データより、緯度、経度、ズームレベルをセット
        var latitude = 0;
        var longitude = 0;
        var zoomlevel = 0;

        if (this.selectedPref === '00') {
          // 指定なし
          if (window.parent.screen.width > 567) {
            latitude = INIT_LATITUDEXL;
            longitude = INIT_LONGITUDEXL;
            zoomlevel = INIT_ZOOMLEVELXL;
          } else {
            zoomlevel = INIT_ZOOMLEVEL;
          }
        } else {
          // 指定あり
          latitude = this.selectedPrefData.latitude;
          longitude = this.selectedPrefData.longitude;
          if (window.parent.screen.width > 567) {
            zoomlevel = 10;
          } else {
            zoomlevel = 9;
          }
        }

        // マップの表示
        this.mymap.setView([latitude, longitude], zoomlevel);

        // 自治体リスト選択フラグクリア
        this.isSelectMunicipality = false;
        this.selectedMunicipality = '000000';
      },

      // MunicipalityMapComponentより、自治体情報＆データセットリストデータを取得
      setMunicipalityMapData: function(data) {
        this.municipalityData = data.data[0];
        this.datasetData = data.data[1];
        this.municipalityMarkers = data.markers;
        this.municipalitydatasetlists = data.datasetlists;
      },

      // 自治体リスト選択フラグ設定処理
      setMunicipalityFlg: function(flg, optionVal) {
        this.isSelectMunicipality = flg;
        this.selectedMunicipality = optionVal;
      },

      // 自治体選択処理
      selectMunicipality: function() {
        // 自治体リスト選択フラグ
        if (this.selectedMunicipality === '000000') {
          // 指定なしのとき、データセットリストを非表示
          this.isSelectMunicipality = false;
        } else {
          // 指定ありのとき、データセットリストを表示
          this.isSelectMunicipality = true;
        }

        // 自治体の指定があるとき
        if (this.isSelectMunicipality) {
          // 各自治体のマーカーをクリックした時と同じ動作をさせる
          var marker = this.municipalityMarkers.find(target => target.data.code === this.selectedMunicipality);
          this.bus.$emit('clickMarker', { e: marker });
        }

        // データセットの指定があるとき、データセット選択処理を行う
        if (!(this.selectedDataset === '00')) {
          this.selectedDataset = '00';
        }

        // マップの表示
        if (window.parent.screen.width > 567) {
          this.mymap.setView([this.selectedPrefData.latitude, this.selectedPrefData.longitude], 10);
        } else {
          this.mymap.setView([this.selectedPrefData.latitude, this.selectedPrefData.longitude], 9);
        }
      },

      // データセット選択処理
      selectDataSet: function() {
        var code = parseInt(this.selectedDataset);
        if (!(code === 0)) {
          this.bus.$emit('dispDatasetDetailInfo', this.municipalitydatasetlists, code);
        }
      },
    }
  }
</script>

<style>
  /* ここにcssを記載します */

  /* マップ */
  html, body, #map {
    width:  auto;
    /* height: 99%; */
    height: 100%;
  }

  /* ボタンアイコン */
  .easy-button-button {
    padding: 1px;
  }
  .leaflet-bar-part {
    padding: 1px;
  }

  /* ヘルプ内容 */
  .leaflet-control-window {
    margin: 0px;
    width: 300px;
    z-index: 1000;
  }
  .locate-icon {
    font-size: 1.6em;
  }

  /*凡例*/
  .legend {
    margin-bottom: 10px;
    padding: 6px 8px;
		font: 14px/16px Arial, Helvetica, sans-serif;
		background: white;
		background: rgba(255,255,255,0.8);
		box-shadow: 0 0 15px rgba(0,0,0,0.2);
		border-radius: 5px;
		line-height: 17px;
    color: #555;
    width: 200px;
  }
  .legend i {
    width: 17px;
		height: 17px;
		float: left;
		margin-right: 8px;
	}
</style>
