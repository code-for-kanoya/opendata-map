<template>
  <!-- ここにhtmlを記載します -->
  <div class="municipality-container">
    <div class="drawer">
      <input type="checkbox" id="chk" />
      <div class="content">
        <div class="menu">
          <button class="closebtn btn btn-outline-secondary" type="button" v-on:click="clickCloseBtnDataset()">
            <i class="far fa-times-circle"></i>
          </button>
          <div class="score text-danger font-italic">{{ datasetlists.score }} / 100 pt</div>
          <div class="col-12 select-name">{{ datasetlists.prefectureName }}{{ datasetlists.municipalityName }}</div>
          <div class="row-cols-1">
            <div id="dataset-0">
              <div class="col-1 result">{{ datasetlists.exsitSite }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="openBODIKSite(datasetlists.url)">オープンデータカタログサイト</button>
            </div>
            <div id="dataset-1">
              <div class="col-1 result">{{ datasetlists.dataset[1] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 1)">AED設置個所一覧</button>
            </div>
            <div id="dataset-2">
              <div class="col-1 result">{{ datasetlists.dataset[2] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 2)">介護サービス事業所一覧</button>
            </div>
            <div id="dataset-3">
              <div class="col-1 result">{{ datasetlists.dataset[3] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 3)">医療機関一覧</button>
            </div>
            <div id="dataset-4">
              <div class="col-1 result">{{ datasetlists.dataset[4] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 4)">文化財一覧</button>
            </div>
            <div id="dataset-5">
              <div class="col-1 result">{{ datasetlists.dataset[5] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 5)">観光施設一覧</button>
            </div>
            <div id="dataset-6">
              <div class="col-1 result">{{ datasetlists.dataset[6] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 6)">イベント一覧</button>
            </div>
            <div id="dataset-7">
              <div class="col-1 result">{{ datasetlists.dataset[7] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 7)">公衆無線LANアクセスポイント一覧</button>
            </div>
            <div id="dataset-8">
              <div class="col-1 result">{{ datasetlists.dataset[8] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 8)">公衆トイレ一覧</button>
            </div>
            <div id="dataset-9">
              <div class="col-1 result">{{ datasetlists.dataset[9] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 9)">消防水利施設一覧</button>
            </div>
            <div id="dataset-10">
              <div class="col-1 result">{{ datasetlists.dataset[10] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 10)">指定緊急避難場所一覧</button>
            </div>
            <div id="dataset-11">
              <div class="col-1 result">{{ datasetlists.dataset[11] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 11)">地域・年齢別人口</button>
            </div>
            <div id="dataset-12">
              <div class="col-1 result">{{ datasetlists.dataset[12] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 12)">公共施設一覧</button>
            </div>
            <div id="dataset-13">
              <div class="col-1 result">{{ datasetlists.dataset[13] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 13)">子育て施設一覧</button>
            </div>
            <div id="dataset-14">
              <div class="col-1 result">{{ datasetlists.dataset[14] }}</div>
              <button type="button" class="btn btn-dataset" v-on:click="dispDatasetDetailInfo(datasetlists, 14)">オープンデータ一覧</button>
            </div>
          </div>
          <div class="col-11 explain">
            〇：整備されている<br>
            異：データセット名、ファイル名が異なる<br>
            複：データセットが複数存在している<br>
            失：データセットのダウンロードに失敗<br>
            ✕：整備されていない<br>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  // ここにjavascriptを記載します

  import 'leaflet/dist/leaflet.css'
  import 'leaflet-sprite/dist/leaflet.sprite.js'
  import 'leaflet.awesome-markers/dist/leaflet.awesome-markers.js'
  import 'leaflet.awesome-markers/dist/leaflet.awesome-markers.css'
  import L from 'leaflet'
  import axios from 'axios'

  // アイコンサイズの設定など
  L.Icon.Default.imagePath = 'images/vendor/leaflet/dist/'
  var LeafIcon = L.Icon.extend({
    options: {
      shadowUrl: 'images/vendor/leaflet/dist/marker-shadow.png', // シャドウ付きアイコンを使う場合は、削除もしくはコメントアウト
      shadowSize: [41, 41], // シャドウ付きアイコンを使う場合は、削除もしくはコメントアウト
      shadowAnchor: [10, 41], // シャドウ付きアイコンを使う場合は、削除もしくはコメントアウト
      iconSize: [25, 41], // シャドウ付きアイコンを使う場合は、[41, 41]に設定
      iconAnchor: [10, 41],
      popupAnchor: [3, -40],
    }
  });

  export default {
    props: [
      'bus',
      'prefMap',
    ],

    data: function() {
      return {
        prefData: null, // 都道府県データ
        prefectureMapData: {
          index: [], // PrefectureMapComponent使用データインデックス
          data: [], // PrefectureMapComponent使用データ
          markers: [], // PrefectureMapComponent使用マーカー情報
          datasetlists: {}, // PrefectureMapComponent使用データセット一覧情報
        },
        municipalityData: [], // 自治体情報データ
        datasetlistData: [], // データセット一覧データ
        markers: [], // マーカー情報
        datasetMarkers: [], // データセット用マーカー情報
        datasetlists: {
          prefectureName: '', // 一覧表示都道府県名
          municipalityCode: '', // 一覧表示団体コード
          municipalityName: '', // 一覧表示自治体名
          score: 0, // 一覧表示スコア
          exsitSite: '', // 一覧表示サイトの有無
          dataset: [], // 一覧表示データセット整備有無
          url: '', // 一覧表示オープンデータサイトURL
          latitude: 0, // 緯度
          longitude: 0, // 経度
        },
        datasetData: [],
        dataFromForm: {
          centerLatitude: 0, // 画面中央緯度
          centerLongitude: 0, // 画面中央経度
          zoomLevel: 0, // ズームレベル
        },
        isMarkerClickSelectMunicipality: false, //
      };
    },

    mounted: function() {
      $(function() {
        const CNT_DATASET = 15;

        $('.menu').on('DOMSubtreeModified propertychange', function() {
          var i;

          // データセット一覧の表示／非表示を検証
          if ($('#chk').prop('checked') == true) {
            for (i = 0; i < CNT_DATASET; i += 1) {
              changeDatasetTextcolor('#dataset-' + i, i);
            }
          }
        });

        // データセットボタン色変更処理
        function changeDatasetTextcolor(id, No) {
          var result = $(id).children('.result').html();
          var button = $(id).children('button');

          button.removeClass();

          button.addClass('col-10');
          button.addClass('btn');
          button.addClass('btn-dataset');
          switch (result) {
            case '〇':
              button.addClass('btn-primary');
              button.prop('disabled', false);
              break;
            default:
              button.addClass('btn-secondary');
              button.prop('disabled', true);
          }

          // データセット一覧のリスト選択可否設定
          selectDatasetList(button, No);
        }

        // データセット一覧のリスト選択可否設定処理
        function selectDatasetList(button, No) {
          var option = $('#select-dataset option[value="' + No +'"]');

          if (button.is(':disabled')) {
            option.prop('disabled', true);
          } else {
            option.prop('disabled', false);
          }
        }

        // クリックイベントを実装
        $('.btn-dataset').on('click', function() {
          var datasetNo = $(this).parent().attr('id').replace('dataset-', '');
          $('#select-dataset').val(datasetNo);
        });
      });

      this.bus.$on('initMunicipality', this.initMunicipality);
      this.bus.$on('clearMunicipalitycoordinates', this.clearMunicipalitycoordinates);
      this.bus.$on('clickMarker', this.clickMarker);
      this.bus.$on('dispDatasetDetailInfo', this.dispDatasetDetailInfo);
    },

    methods: {
      clickCloseBtnDataset: function() {
        // データセット一覧を閉じる
        var chk = document.getElementById('chk');
        chk.checked = false;
      },

      //自治体情報データ取得処理
      getMunicipalityDataFromList: async function(prefData) {
        // 変数
        var params = new URLSearchParams();
        // 戻り値
        var data = null;

        // パラメータ設定
        params.append('prefId', prefData.id);

        await axios
          .post('/municipality', params)
          .then(function (response) {
            data = response.data;
          })
          .catch(function (err) {
            console.log(err);
          }
          .bind(this));

        return data;
      },

      // データセット一覧情報データ取得処理
      getDatasetlist: async function(prefData) {
        // 変数
        var params = new URLSearchParams();
        // 戻り値
        var data = null;

        // パラメータ設定
        params.append('prefId', prefData.id);

        await axios
          .post('/datasetlist', params)
          .then(function (response) {
            data = response.data;
          })
          .catch(function (err) {
            console.log(err);
          }
          .bind(this));

        return data;
      },

      // データセット詳細情報取得処理
      getDatasetDetailInfo: async function(municipalityCode, datasetCode) {
        // 変数
        var params = new URLSearchParams();
        var name = '';
        // 戻り値
        var data = null;

        // 現在（画面中央）の緯度・経度を取得する
        this.outputPos(this.prefMap);

        // パラメータ設定
        params.append('datasetCode', datasetCode);
        params.append('municipalityCode', municipalityCode);
        params.append('lat', this.dataFromForm.centerLatitude);
        params.append('lng', this.dataFromForm.centerLongitude);

        switch (datasetCode) {
          case 1:
            name = 'Aed'
            break;
          case 2:
            name = 'CareService'
            break;
          case 3:
            name = 'MedicalInstitutions'
            break;
          case 4:
            name = 'CulturalProperties'
            break;
          case 5:
            name = 'TouristFacilities'
            break;
          case 6:
            name = 'Events'
            break;
          case 7:
            name = 'PublicWirelessLan'
            break;
          case 8:
            name = 'PublicToilet'
            break;
          case 9:
            name = 'FireIrrigationFacilities'
            break;
          case 10:
            name = 'DesignatedEmergencyEvacuationSite'
            break;
          case 11:
            name = 'AreaAgePopulation'
            break;
          case 12:
            name = 'PublicFacilitees'
            break;
          case 13:
            name = 'ChildRearingFacilities'
            break;
          case 14:
            name = 'OpenData'
            break;
        }

        await axios
          .post('/datasetlist/'+name, params)
          .then(function (response) {
            data = response.data;
          })
          .catch(function (err) {
            console.log(err);
          }.bind(this));

        return data;
      },

      // 現在の緯度・経度・倍率を取得して指定の要素に情報を出力する関数
      outputPos: function(map){
          var pos = map.getCenter();
          var zoom = map.getZoom();

          this.dataFromForm.centerLatitude = pos.lat;
          this.dataFromForm.centerLongitude = pos.lng;
          this.dataFromForm.zoomLevel = zoom;
      },

      // 自治体境のクリア処理
      clearMunicipalitycoordinates: function() {
        var self = this;

        // データセット一覧を閉じる
        var chk = document.getElementById('chk');
        chk.checked = false;

        // 選択都道府県のレイヤーをクリア
        self.prefMap.eachLayer(function(layer) {
          if ('setting' in layer) {
            if (layer.setting === true) {
              self.prefMap.removeLayer(layer);
            }
          }
        });

        // マーカーをクリア
        if (self.markers) {
          self.markers.forEach(function(marker) {
            self.prefMap.removeLayer(marker);
            marker = null;
          });
        }
        if (self.datasetMarkers) {
          self.datasetMarkers.forEach(function(marker) {
            self.prefMap.removeLayer(marker);
            marker = null;
          });
        }
      },

      // 自治体境GeoJsonデータ取得処理
      initMunicipality: async function(prefData) {
        var self = this;

        // 自治体境をクリアする
        this.clearMunicipalitycoordinates();

        if (prefData.prefData === undefined) {
          // 指定なしのとき
          this.prefData.id = 0;
          this.municipalityData.length = 0;
          this.datasetlistData.length = 0;

          // PrefectureMapComponentで使用するデータをセットする
          this.prefectureMapData.index[0] = 0;
          this.prefectureMapData.data[0] = this.municipalityData;
          this.prefectureMapData.index[1] = 1;
          this.prefectureMapData.data[1] = this.datasetlistData;
        } else {
          // 指定ありのとき
          this.prefData = prefData.prefData;
          this.datasetlists.prefectureName = prefData.prefData.name;

          // 自治体情報データ取得
          this.municipalityData = await this.getMunicipalityDataFromList(this.prefData);
          // データセット一覧情報データ取得
          this.datasetlistData = await this.getDatasetlist(this.prefData);

          // 自治体情報データ取得
          // this.getMunicipalityDataFromList(this.prefData);
          // データセット一覧情報データ取得
          // this.getDatasetlist(this.prefData);
          // データセット詳細情報データ取得
          // for (var i = 1; i <= 14; i++) {
          //   this.getDatasetDetailInfo(i);
          // }

          // PrefectureMapComponentで使用するデータをセットする
          this.prefectureMapData.index[0] = 0;
          this.prefectureMapData.data[0] = this.municipalityData;
          this.prefectureMapData.index[1] = 1;
          this.prefectureMapData.data[1] = this.datasetlistData;
        }
        this.$emit('getMunicipalityMapData', this.prefectureMapData);

        var prefJson = '';

        switch(this.prefData.id) {
          case 40:
            // 福岡県
            prefJson = 'N03-20_40_200101.geojson';
            break;
          case 41:
            // 佐賀県
            prefJson = 'N03-20_41_200101.geojson';
            break;
          case 42:
            // 長崎県
            prefJson = 'N03-20_42_200101.geojson';
            break;
          case 43:
            // 熊本県
            prefJson = 'N03-20_43_200101.geojson';
            break;
          case 44:
            // 大分県
            prefJson = 'N03-20_44_200101.geojson';
            break;
          case 45:
            // 宮崎県
            prefJson = 'N03-20_45_200101.geojson';
            break;
          case 46:
            // 鹿児島県
            prefJson = 'N03-20_46_200101.geojson';
            break;
          default:
            // 指定なし
            prefJson = '';
        }

        // jsonファイルが指定されていないとき、処理を終了する
        if (prefJson === '') {
          return;
        }

        axios
          .get('./assets/json/' + prefJson)
          .then(function (json) {
            addDataToMap(this.prefMap, json.data);
          }
          .bind(this));

        // 自治体情報の各データ追加処理
        function addDataToMap(map, data) {
          var geoJsonLayer = L.geoJson(data, {
            onEachFeature: myOnEachFeature,
          }).addTo(map);
        }

        // onEachFeature設定
        function myOnEachFeature(feature, layer) {
          layer.setStyle(myStyle(feature));
          layer.setting = true;
        }

        // スタイル設定
        function myStyle(feature) {
          return {
            color: 'black',
            opacity: 0.6,
            fillColor: scoring(feature.properties.N03_007),
            fillOpacity: 0.5,
          }
        }

        // スコアリング処理
        function scoring(code) {
          // 変数
          var score = 0;
          // 戻り値
          var color = '';

          var data = self.datasetlistData.find((item) => {
            return item.code.substring(0, 5) === code;
          });

          score = 0;

          for (var item in data) {
            if (data[item] === '〇' || data[item] === '○') {
              data[item] = '〇';
            } else if (data[item] === '×' || data[item] === '') {
              data[item] = '✕';
            }

            switch (item) {
              case 'existsite':
                if (data[item] === '〇') {
                  score = score + 6;
                }
                break;
              case 'dataset01':
              case 'dataset02':
              case 'dataset03':
              case 'dataset04':
              case 'dataset05':
              case 'dataset06':
              case 'dataset07':
              case 'dataset08':
              case 'dataset09':
              case 'dataset10':
              case 'dataset11':
              case 'dataset12':
              case 'dataset13':
              case 'dataset14':
                if (data[item] === '〇') {
                  score = score + 6;
                } else if (data[item] === '異' || data[item] === '複') {
                  score = score + 3;
                }
                break;
            }
          }

          switch (true) {
            case score === 90:
              score = score + 10;
              break;
            case 45 <= score:
              score = score + 5;
              break;
          }

          if (!(data === undefined)) {
            data.score = score;
          }

          switch (true) {
            case 1 <= score && score < 20:
              color = 'red';
              break;
            case 20 <= score && score < 40:
              color = 'orange';
              break;
            case 40 <= score && score < 60:
              color = 'yellow';
              break;
            case 60 <= score && score < 80:
              color = 'lawngreen';
              break;
            case 80 <= score:
              color = '#00B0FF';
              break;
            default:
              color = 'black';
          }

          return color;
        }

        // 各自治体の位置にマーカーを設定する
        this.setMarker();
      },

      // 各自治体のマーカー設定処理
      setMarker: function() {
        var self = this;
        var i = 0;
        var listData = null;

        this.municipalityData.forEach(function(item) {
          // マーカー設定（青）
          var defaultIcon = new LeafIcon({iconUrl: 'images/vendor/leaflet/dist/marker-icon.png'});
          self.markers[i] = L.marker([item.latitude, item.longitude],{icon: defaultIcon});
          self.markers[i].addTo(this.prefMap);
          self.markers[i].bindTooltip(item.name);

          // ここでクリックイベント時に使用したいデータを登録
          listData = this.datasetlistData.find(target => target.code === item.code);
          self.markers[i].data = listData;
          self.markers[i].data.index = i;
          self.markers[i].data.name = item.name;
          self.markers[i].data.latitude = item.latitude;
          self.markers[i].data.longitude = item.longitude;
          self.markers[i].select = false;

          // クリックイベントの登録
          self.markers[i].on('click', function(e) {
            self.clickMarker(e);
          });

          // PrefectureMapComponentで使用するマーカー情報をセットする
          this.prefectureMapData.markers[i] = self.markers[i];

          i = i + 1;
        }, this);
      },

      // マーカークリックイベント定義
      clickMarker: function (e) {
        var self = this;
        var index = 0;
        var data = null;

        if ('target' in e) {
          data = e.target.data;
        } else {
          data = e.e.data;
        }
        index = data.index;

        // マーカー削除
        if (self.markers[index].select === false) {
          if (self.datasetMarkers) {
            self.datasetMarkers.forEach(function(marker) {
              self.prefMap.removeLayer(marker);
              marker = null;
            });
          }
        }

        self.markers.forEach(function(marker) {
          if ('select' in marker) {
            if (marker.select === true) {
              marker.setIcon(L.spriteIcon());
              marker.select = false;
            }
          }
        });

        // 選択自治体のマーカーの色を変更（青→赤）
        var townHallIcon = new LeafIcon({iconUrl: 'images/vendor/icon/Red.png'});
        self.markers[index].setIcon(townHallIcon);
        self.markers[index].select = true;

        var select = document.getElementById("select-municipality");
        for (var i = 0; i < select.options.length; i++) {
          if (select.options[i].value === self.markers[index].data.code) {
            this.$emit('getMunicipalityFlg', true, select.options[i].value);
            break;
          }
        }

        // データセット一覧表示
        self.datasetlists.municipalityCode = data.code;
        self.datasetlists.municipalityName = data.name;
        self.datasetlists.latitude = data.latitude;
        self.datasetlists.longitude = data.longitude;
        self.datasetlists.score = data.score;
        self.datasetlists.exsitSite = data.existsite;
        self.datasetlists.dataset[1] = data.dataset01;
        self.datasetlists.dataset[2] = data.dataset02;
        self.datasetlists.dataset[3] = data.dataset03;
        self.datasetlists.dataset[4] = data.dataset04;
        self.datasetlists.dataset[5] = data.dataset05;
        self.datasetlists.dataset[6] = data.dataset06;
        self.datasetlists.dataset[7] = data.dataset07;
        self.datasetlists.dataset[8] = data.dataset08;
        self.datasetlists.dataset[9] = data.dataset09;
        self.datasetlists.dataset[10] = data.dataset10;
        self.datasetlists.dataset[11] = data.dataset11;
        self.datasetlists.dataset[12] = data.dataset12;
        self.datasetlists.dataset[13] = data.dataset13;
        self.datasetlists.dataset[14] = data.dataset14;
        self.datasetlists.url = data.url;

        // PrefectureMapComponentで使用するデータセット情報をセットする
        this.prefectureMapData.datasetlists = self.datasetlists;
        this.$emit('getMunicipalityMapData', this.prefectureMapData);

        var chk = document.getElementById('chk');
        chk.checked = true;
      },

      // オープンデータカタログサイト表示処理
      openBODIKSite: function(url) {
        window.open(url);
      },

      // データセット詳細情報表示処理
      dispDatasetDetailInfo: async function (data, datasetCode) {
        var self = this;
        var i = 0;

        // データセット一覧を閉じる
        this.clickCloseBtnDataset();

        // マップのズーム
        if (window.parent.screen.width > 567) {
          this.prefMap.setView([data.latitude, data.longitude], 13);
        } else {
          this.prefMap.setView([data.latitude, data.longitude], 12);
        }

        if (data.dataset[datasetCode] === '〇') {
          // 該当データセット詳細情報
          self.datasetData = await this.getDatasetDetailInfo(data.municipalityCode, datasetCode);

          // マーカー削除
          if (self.datasetMarkers) {
            self.datasetMarkers.forEach(function(marker) {
              self.prefMap.removeLayer(marker);
              marker = null;
            });
          }

          // マーカー設定
          self.datasetData.forEach(function(item) {
            // ポップアップ内容設定
            var content = setContent(datasetCode, item);

            // マーカー設定（緑）
            var plotIcon = new LeafIcon({iconUrl: 'images/vendor/icon/ForestGreen.png'});
            // var plotIcon = L.AwesomeMarkers.icon({
            //                   icon: 'coffee',
            //                   markerColor: 'green',
            //                 });
            self.datasetMarkers[i] = L.marker([item.latitude, item.longitude], {icon: plotIcon});
            self.datasetMarkers[i].addTo(this.prefMap);
            self.datasetMarkers[i].bindTooltip(item.name);
            self.datasetMarkers[i].bindPopup(content);

            i = i + 1;
          }, this);

          function setContent(datasetCode, item) {
            var content = '';

            switch (datasetCode) {
              case 1:
                // AED設置箇所一覧
                content ='名称：'+item.name+'</br>'
                        +'住所：'+item.address+'</br>'
                        +'設置位置：'+item.installation_position+'</br>'
                        +'備考：'+item.note;
                break;
              case 2:
                // 介護サービス事業所一覧
                content ='事業所名称　：'+item.name+'</br>'
                        +'実施サービス：'+item.implementation_service+'</br>'
                        +'住所：'+item.address+'</br>'
                        +'電話番号：'+item.phone_number+'</br>'
                        +'備考：'+item.note;
                break;
              case 3:
                // 医療機関一覧
                content ='名称：'+item.name+'</br>'
                        +'種類：'+item.type+'</br>'
                        +'住所：'+item.address+'</br>'
                        +'電話番号：'+item.phone_number+'</br>'
                        +'診療曜日：'+item.medical_treatment_day+'</br>'
                        +'診療時間：'+item.start_time+'～'+item.end_time+'</br>'
                        +'診療科目：'+item.clinical_department+'</br>'
                        +'病床数：'+item.bed_count+'</br>'
                        +'ＵＲＬ：'+item.url+'</br>'
                        +'備考：'+item.note;
                break;
              case 4:
                // 文化財一覧
                content ='名称：'+item.name+'</br>'
                        +'分類：'+item.classification+'</br>'
                        +'ＵＲＬ：'+item.url+'</br>'
                        +'備考：'+item.note;
                break;
              case 5:
                // 観光施設一覧
                content ='名称：'+item.name+'</br>'
                        +'住所：'+item.name+'</br>'
                        +'説明：'+item.explanation+'</br>'
                        +'ＵＲＬ：'+item.url+'</br>'
                        +'備考：'+item.note;
                break;
              case 6:
                // イベント一覧
                content ='イベント名：'+item.name+'</br>'
                        +'開催日：'+item.start_date+'～'+item.end_date+'</br>'
                        +'開催時間：'+item.start_time+'～'+item.end_time+'</br>'
                        +'説明：'+item.explanation+'</br>'
                        +'場所名称：'+item.place_name+'</br>'
                        +'住所：'+item.address+'</br>'
                        +'ＵＲＬ：'+item.url+'</br>'
                        +'備考：'+item.note;
                break;
              case 7:
                // 公衆無線LANアクセスポイント一覧
                content ='名称：'+item.name+'</br>'
                        +'住所：'+item.address+'</br>'
                        +'ＵＲＬ：'+item.url+'</br>'
                        +'備考：'+item.note;
                break;
              case 8:
                // 公衆トイレ一覧
                content ='名称：'+item.name+'</br>'
                        +'住所：'+item.address+'</br>'
                        +'設置位置：'+item.installation_position+'</br>'
                        +'男性トイレ総数：'+item.male_toilet_total_count+'</br>'
                        +'女性トイレ総数：'+item.female_toilet_total_count+'</br>'
                        +'男女共用トイレ総数：'+item.unisex_toilet_total_count+'</br>'
                        +'多機能トイレ数：'+item.multifunctional_toilet_count+'</br>'
                        +'車椅子使用者用トイレ有無：'+item.existence_toilet_wheelchair+'</br>'
                        +'乳幼児用設備設置トイレ有無：'+item.existence_toilet_equipment_infant+'</br>'
                        +'利用時間：'+item.start_time+'～'+item.end_time+'</br>'
                        +'備考：'+item.note;
                break;
              case 9:
                // 消防水利施設一覧
                content ='種別：'+item.type+'</br>'
                        +'住所：'+item.address+'</br>'
                        +'口径：'+item.caliber+'</br>'
                        +'備考：'+item.note;
                break;
              case 10:
                // 指定緊急避難場所一覧
                content ='名称：'+item.name+'</br>'
                        +'住所：'+item.address+'</br>'
                        +'電話番号：'+item.phone_number+'</br>'
                        +'災害種別_洪水：'+item.disaster_type_flood+'</br>'
                        +'災害種別_崖崩れ、土石流及び地滑り：'+item.disaster_type_sediment+'</br>'
                        +'災害種別_高潮：'+item.disaster_type_storm_surge+'</br>'
                        +'災害種別_地震：'+item.disaster_type_earthquake+'</br>'
                        +'災害種別_津波：'+item.disaster_type_tsunami+'</br>'
                        +'災害種別_大規模な火事：'+item.disaster_type_fire+'</br>'
                        +'災害種別_内水氾濫：'+item.disaster_type_inland_water_flood+'</br>'
                        +'災害種別_火山現象：'+item.disaster_type_volcanic_phenomenon+'</br>'
                        +'指定避難所との重複：'+item.duplicate_designated_shelter+'</br>'
                        +'想定収容人数：'+item.estimated_capacity+'</br>'
                        +'対象となる町会・自治会：'+item.target_resident_association+'</br>'
                        +'ＵＲＬ：'+item.url+'</br>'
                        +'備考：'+item.note;
                break;
              case 11:
                // 地域・年齢別人口
                content ='';
                break;
              case 12:
                // 公共施設一覧
                content ='名称：'+item.name+'</br>'
                        +'住所：'+item.address+'</br>'
                        +'電話番号：'+item.phone_number+'</br>'
                        +'利用可能曜日：'+item.available_day+'</br>'
                        +'ＵＲＬ：'+item.url+'</br>'
                        +'備考：'+item.note;
                break;
              case 13:
                // 子育て施設一覧
                content ='名称：'+item.name+'</br>'
                        +'種別：'+item.type+'</br>'
                        +'住所：'+item.address+'</br>'
                        +'アクセス方法：'+item.how_to_access+'</br>'
                        +'駐車場情報：'+item.parking_infomation+'</br>'
                        +'電話番号：'+item.phone_number+'</br>'
                        +'収容定員：'+item.capacity+'</br>'
                        +'受入年齢：'+item.acceptance_age+'</br>'
                        +'利用可能曜日：'+item.available_day+'</br>'
                        +'開始時間：'+item.start_time+'～'+item.end_time+'</br>'
                        +'一時預かりの有無：'+item.existence_temporary_custody+'</br>'
                        +'ＵＲＬ：'+item.url+'</br>'
                        +'備考：'+item.note;
                break;
              case 14:
                // オープンデータ一覧
                content ='';
                break;
            }

            return content;
          }
        }
      },
    }
  }
</script>

<style>
  /* ここにcssを記載します */

  /*データセット一覧*/
  .score {
    display: inline-block;
    position: relative;
    /* margin-left: 12rem; */
    margin-right: 0.375rem;
    padding-left: 0.375rem;
    padding-right: 0.375rem;
    font-size: 27px;
    background: linear-gradient(transparent 50%, yellow 50%);
  }
  .select-name {
    padding-left: 0.375rem;
    font-size: 27px;
  }

  .result {
    display: inline-block;
  }
  .btn-dataset {
    margin: 0.375rem 0.75rem 0.375rem 0rem;
    padding: 0rem 0rem;
  }

  .drawer .leaflet-control {
    position: fixed;
    top: 10px;
    cursor: pointer;
  }
  .drawer .content {
    display: table;
    border: 1px solid #000000;
    border-radius: 4px;
    background: #fff;
    width: 130vw;
    top: 10px;
    right: 0;
    text-align: left;
    position: fixed;
  }
  .drawer .content .menu {
    height: 850px;
    overflow-y: auto;
  }
  .drawer .content .menu .closebtn {
    margin: 0.375rem;
  }
  .drawer .content .menu .closebtn i::before {
    font-size: 20px;
    cursor: pointer;
  }
  .drawer .content .menu .explain {
    padding-top: 20px;
    padding-bottom: 10px;
    text-decoration: none;
    color: #000000;
    display: inline-block;
    width: 100%;
    flex-flow: column;
    font-size: 14px;
  }
  .drawer .leaflet-control,
  .drawer .content {
    z-index: 1001;
  }
  .drawer #chk {
    display: none;
  }
  .drawer #chk ~ .leaflet-control::before {
    display: block;
  }
  .drawer #chk ~ .leaflet-control::after {
    display: none;
  }
  .drawer #chk:checked ~ .leaflet-control::before {
    display: none;
  }
  .drawer #chk:checked ~ .leaflet-control::after {
    display: block;
  }
  .drawer #chk ~ .content {
    transform: translate(350%, 0);
    transition: transform 0.3s ease-in-out;
  }
  .drawer #chk:checked ~ .content {
    transform: none;
  }
  @media screen and (min-width: 0px) {
    .btn-dataset {
      font-size: 13px;
    }
    .drawer .content {
      width: 100%;
    }
    .drawer .content .menu {
      height: 490px;
    }
    .drawer .content .menu .explain {
      width: 100%;
      font-size: 13px;
    }
  }
  @media screen and (min-width: 992px) {
    .btn-dataset {
      font-size: 15px;
    }
    .drawer .content {
      width: 350px;
    }
    .drawer .content .menu {
      height: 850px;
    }
    .drawer .content .menu .explain {
      width: 100%;
      font-size: 14px;
    }
  }
</style>
