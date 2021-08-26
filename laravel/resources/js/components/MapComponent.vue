<template>
    <!-- ここにhtmlを記載します -->
    <div id="map-view">
        <inputform-component
            v-bind:input-id="inputId"
            v-bind:prefs-data="prefsData"
            v-bind:pref-id="prefId"
            v-bind:municipality-code="municipalityCode"
            v-bind:is-select-data="isSelectData"
            v-bind:select-data-name="selectDataName"
            v-bind:bus="bus"
            v-on:init-municipality="initMunicipality"
            v-on:set-marker="setMarker"
            v-on:click-marker="clickMarker"
            v-on:input-municipality="inputMunicipality"
            v-on:change-search-box="changeSearchBox"
            ref="inputform">
        </inputform-component>
        <div id="map"></div>
        <information-component
            v-bind:info-dataset="infoDataset"
            v-bind:info-data="infoData"
            v-on:disp-info="dispDatasetDetailInfo"
            v-if="isInfoShow"
            ref="information">
        </information-component>
        <tour-component
            v-bind:v-step-id0="vStepId0"
            v-bind:bus="bus"
            v-if="municipalityCode === undefined">
        </tour-component>
    </div>
</template>

<script>
  // ここにjavascriptを記載します

    import 'leaflet/dist/leaflet.css'
    import 'leaflet.locatecontrol/dist/L.Control.Locate.min.js'
    import 'leaflet.locatecontrol/dist/L.Control.Locate.min.css'
    import 'leaflet-easybutton/src/easy-button.js'
    import 'leaflet-easybutton/src/easy-button.css'
    import 'leaflet-control-window/src/L.Control.Window.js';
    import 'leaflet-control-window/src/L.Control.Window.css';
    import L from 'leaflet'
    import axios from 'axios'
    import inputformComponent from './InputFormComponent.vue'
    import InformationComponent from './InformationComponent.vue'
    import TourComponent from './TourComponent.vue'

    // アイコンサイズの設定など
    L.Icon.Default.imagePath = '/images/vendor/leaflet/dist/'
    var LeafIcon = L.Icon.extend({
        options: {
            shadowUrl: '/images/vendor/leaflet/dist/marker-shadow.png', // シャドウ付きアイコンを使う場合は、削除もしくはコメントアウト
            shadowSize: [41, 41], // シャドウ付きアイコンを使う場合は、削除もしくはコメントアウト
            shadowAnchor: [10, 41], // シャドウ付きアイコンを使う場合は、削除もしくはコメントアウト
            iconSize: [25, 41], // シャドウ付きアイコンを使う場合は、[41, 41]に設定
            iconAnchor: [10, 41],
            popupAnchor: [3, -40],
        }
    });

    const INIT_LATITUDEXL = 32.6825;
    const INIT_LONGITUDEXL = 131.752778;
    const INIT_ZOOMLEVELXL = 8;
    const INIT_LATITUDE = 33;
    const INIT_LONGITUDE = 131;
    const INIT_ZOOMLEVEL = 7;

    export default {
        components: {
            inputformComponent,
            InformationComponent,
            TourComponent,
        },

        props: {
            prefsData: {
                name: 'prefsData',
            },
            prefId: {
                name: 'prefId',
            },
            municipalityCode: {
                name: 'municipalityCode',
            },
        },

        data: function() {
            return {
                bus: new Vue(),
                inputId: '',
                infoDataset: '',
                myMap: null, // マップ
                hallMarkers: [], // マーカー情報
                datasetMarkers: [], // データセット用マーカー情報
                infoData: {
                    prefectureName: '', // 一覧表示都道府県名
                    municipalityCode: '', // 一覧表示団体コード
                    municipalityName: '', // 一覧表示市区町村名
                    score: 0, // 一覧表示スコア
                    exsitSite: '', // 一覧表示サイトの有無
                    dataset: [], // 一覧表示データセット整備有無
                    url: '', // 一覧表示オープンデータサイトURL
                    latitude: 0, // 緯度
                    longitude: 0, // 経度
                },
                isInfoShow: false, // データセット一覧表示可否
                isSelectData: false, // データセット選択フラグ
                selectDataName: '', // データセット選択名
                vStepId0: '', // チュートリアル１
            };
        },

        mounted: function() {
            this.initMap();

            if (this.prefId !== undefined) {
                var selectPref = document.getElementById('select-pref');
                var selectMunicipality = document.getElementById('select-municipality');

                this.$refs.inputform.selectedPref = this.prefId;
                selectPref.classList.add('select-code');
                if (this.municipalityCode !== undefined) {
                    this.$refs.inputform.selectedMunicipality = this.municipalityCode;
                    selectMunicipality.classList.add('select-code');
                }

                this.$refs.inputform.selectPrefecture(true);
            }
        },

        methods: {
            // マップ初期処理
            initMap: function() {
                var latitude = 0;
                var longitude = 0;
                var zoomlevel = 0;

                this.inputId = 'input-id';
                this.infoDataset = 'info-dataset';
                this.vStepId0 = '#prefecture';

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
                this.myMap = L.map('map', {
                    center: [latitude, longitude],
                    zoom: zoomlevel,
                });
                this.myMap.zoomControl.setPosition('bottomright');

                // OSMレイヤー追加
                L.tileLayer('https://opendata-map-base.gcom-lab.com/tile/{z}/{x}/{y}.png', {
                    attribution: "&copy; <a href='http://osm.org/copyright'>OpenStreetMap</a> contributors"
                }).addTo(this.myMap);

                // 県境GeoJsonの読み込み
                axios
                    .get('/assets/json/prefectures.geojson')
                    .then(function (json) {
                        addDataToMap(this.myMap, json.data);
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

                // ボタン追加処理
                function addButton(thismap) {
                    // 現在地ボタン
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
                    })
                    locateBtn.addTo(thismap);

                    // ヘルプボタン
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
                    helpContent += '<div class="about">';
                    helpContent += '<a href="/">このサービスについて</a>';
                    helpContent += '</div>';
                    helpContent += '<div class="ver-info">';
                    helpContent += '<p class="ver-title">バージョン情報</p>';
                    helpContent += '<p class="ver-info-detail version">OpenDataMapService 1.0</p>';
                    helpContent += '<p class="ver-info-detail copyright">&copy; 2021 Code for Kanoya</p>';
                    helpContent += '<a href="https://code-for-kanoya.github.io/" target="_blank" rel="noopener" id="ver-info-link">公式ホームページ</a>';
                    helpContent += '</div>';

                    var helpWindow = L.control.window(map,{
                                        title: 'ヘルプ',
                                        content: helpContent,
                                        position: 'bottomRight',
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
                    helpBtn.addTo(thismap);
                }

                // マップ内ボタン追加
                addButton(this.myMap);
            },

            // 市区町村境初期処理
            initMunicipality: function(prefectureData, datasetlistData) {
                var self = this;
                var prefectureId = 0;
                var prefGeoJson = '';

                this.dispLoading('');

                // 自治体境をクリアする
                this.clearMunicipalityCoordinates();

                if (prefectureData === undefined) {
                    prefectureId = 0;
                } else {
                    prefectureId = prefectureData.id;
                    this.infoData.prefectureName = prefectureData.name;
                }

                switch(prefectureId) {
                    case 40:
                        // 福岡県
                        prefGeoJson = 'N03-20_40_200101.geojson';
                        break;
                    case 41:
                        // 佐賀県
                        prefGeoJson = 'N03-20_41_200101.geojson';
                        break;
                    case 42:
                        // 長崎県
                        prefGeoJson = 'N03-20_42_200101.geojson';
                        break;
                    case 43:
                        // 熊本県
                        prefGeoJson = 'N03-20_43_200101.geojson';
                        break;
                    case 44:
                        // 大分県
                        prefGeoJson = 'N03-20_44_200101.geojson';
                        break;
                    case 45:
                        // 宮崎県
                        prefGeoJson = 'N03-20_45_200101.geojson';
                        break;
                    case 46:
                        // 鹿児島県
                        prefGeoJson = 'N03-20_46_200101.geojson';
                        break;
                    default:
                        // 指定なし
                        prefGeoJson = '';
                }

                // jsonファイルが指定されていないとき、処理を終了する
                if (prefGeoJson === '') {
                    return;
                }

                axios
                    .get('/assets/json/' + prefGeoJson)
                    .then(function (json) {
                        addDataToMap(this.myMap, json.data);
                    }
                    .bind(this))
                    .finally(function () {
                        self.removeLoading();
                    });

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

                    var data = datasetlistData.find((item) => {
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
                                } else if (data[item] === '異' || data[item] === '複' || data[item] === '不') {
                                    score = score + 3;
                                }
                                break;
                        }
                    }

                    switch (true) {
                        case score === 90:
                            score = score + 10;
                            break;
                        case 50 <= score:
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
                        latitude = INIT_LATITUDE;
                        longitude = INIT_LONGITUDE;
                        zoomlevel = INIT_ZOOMLEVEL;
                    }
                } else {
                    // 指定あり
                    latitude = prefectureData.latitude;
                    longitude = prefectureData.longitude;
                    if (window.parent.screen.width > 567) {
                        zoomlevel = 10;
                    } else {
                        zoomlevel = 9;
                    }
                }

                // マップの表示
                this.myMap.setView([latitude, longitude], zoomlevel);
            },

            // 各市区町村のマーカー設定処理
            setMarker: function(municipalityData, datasetlistData) {
                var self = this;
                var i = 0;
                var listData = null;

                municipalityData.forEach(function(item) {
                    // マーカー設定（青）
                    var defaultIcon = new LeafIcon({iconUrl: '/images/vendor/leaflet/dist/marker-icon.png'});
                    self.hallMarkers[i] = L.marker([item.latitude,item.longitude],{icon: defaultIcon,});
                    self.hallMarkers[i].addTo(this.myMap);
                    self.hallMarkers[i].bindTooltip(item.name);

                    // ここでクリックイベント時に使用したいデータを登録
                    listData = datasetlistData.find(target => target.code === item.code);
                    self.hallMarkers[i].data = listData;
                    self.hallMarkers[i].data.index = i;
                    self.hallMarkers[i].data.name = item.name;
                    self.hallMarkers[i].data.latitude = item.latitude;
                    self.hallMarkers[i].data.longitude = item.longitude;
                    self.hallMarkers[i].select = false;

                    // クリックイベントの登録
                    self.hallMarkers[i].on('click', function(e) {
                        self.clickMarker(e);
                    });

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
                    data = e.data;
                }
                index = data.index;

                if (self.hallMarkers[index].select === false) {
                    // マーカー削除
                    if (self.datasetMarkers) {
                        self.datasetMarkers.forEach(function(marker) {
                            self.myMap.removeLayer(marker);
                            marker = null;
                        });
                    }

                    // データセット選択フラグクリア
                    self.isSelectData = false;
                    // データセット選択名クリア
                    self.selectDataName = '';
                }

                self.hallMarkers.forEach(function(marker) {
                    if ('select' in marker) {
                        if (marker.select === true) {
                            marker.setIcon(L.spriteIcon());
                            marker.select = false;
                            marker.closePopup();;
                            marker._popup = undefined;
                        }
                    }
                });

                // 選択自治体のマーカーの色を変更（青→赤）
                var townHallIcon = new LeafIcon({iconUrl: '/images/vendor/icon/Red.png'});
                self.hallMarkers[index].setIcon(townHallIcon);
                self.hallMarkers[index].select = true;

                // 市区町村リストボックスの値を選択マーカーと同じにする
                this.$refs.inputform.clickMapMarker(data.code);
                // ランキング表示
                if (this.$refs.information !== undefined) {
                    this.$refs.information.getRankingResult(data.code);
                }

                // データセット一覧データ設定
                self.infoData = data;

                // データセット一覧の表示
                self.isInfoShow = true;

                history.pushState(null, null, '/map/'+this.$refs.inputform.selectedPref+'/'+data.code);
            },

            // 検索画面の入力処理
            inputMunicipality: function(index, inputData) {
                this.clickMarker(this.hallMarkers[index]);

                // マップの表示
                if (window.parent.screen.width > 567) {
                    this.myMap.setView([inputData.latitude, inputData.longitude], 10);
                } else {
                    this.myMap.setView([inputData.latitude, inputData.longitude], 9);
                }
            },

            // 市区町村境のクリア処理
            clearMunicipalityCoordinates: function() {
                var self = this;

                // データセット一覧の非表示
                self.isInfoShow = false;
                // データセット選択フラグクリア
                self.isSelectData = false;
                // 選択データセット名クリア
                self.selectDataName = '';

                // 選択都道府県のレイヤーをクリア
                self.myMap.eachLayer(function(layer) {
                    if ('setting' in layer) {
                        if (layer.setting === true) {
                            self.myMap.removeLayer(layer);
                        }
                    }
                });

                // マーカーをクリア
                if (self.hallMarkers) {
                    self.hallMarkers.forEach(function(marker) {
                        self.myMap.removeLayer(marker);
                        marker = null;
                    });
                }
                if (self.datasetMarkers) {
                    self.datasetMarkers.forEach(function(marker) {
                        self.myMap.removeLayer(marker);
                        marker = null;
                    });
                }
            },

            // データセット詳細情報表示処理
            dispDatasetDetailInfo: async function (datasetCode, infoData, detailData, datasetName) {
                var self = this;
                var i = 0;
                var targetMarker;

                // マップのズーム
                if (window.parent.screen.width > 567) {
                    self.myMap.setView([infoData.latitude, infoData.longitude], 13);
                } else {
                    self.myMap.setView([infoData.latitude, infoData.longitude], 12);
                }

                // 現在選択中の市区町村マーカー取得
                self.hallMarkers.forEach(function(marker) {
                    if (marker.select) {
                        targetMarker = marker;
                    }
                });

                // 現在選択中の市区町村マーカーのポップアップをクリア
                targetMarker.closePopup();
                targetMarker._popup = undefined;

                // マーカー削除
                if (self.datasetMarkers) {
                    self.datasetMarkers.forEach(function(marker) {
                        self.myMap.removeLayer(marker);
                        marker = null;
                    });
                }

                // データセットが、地域・年齢別人口 or オープンデータ一覧のとき、処理を抜ける
                if (datasetCode === 11 || datasetCode === 14) {
                    return;
                }

                var content = '';
                var popup;

                // マーカー設定
                i = 0;
                detailData.forEach(function(item) {
                    // ポップアップ内容設定
                    content = setContent(datasetCode, item);

                    // ポップアップオブジェクトの生成
                    popup = L.popup({
                                maxHeight: 300,
                            })
                            .setContent(content);
                    // マーカー設定（緑）
                    var plotIcon = self.setPlotMarker(datasetCode);
                    self.datasetMarkers[i] = L.marker([item.latitude, item.longitude], {icon: plotIcon});
                    self.datasetMarkers[i].addTo(self.myMap);
                    self.datasetMarkers[i].bindTooltip(item.name);
                    self.datasetMarkers[i].bindPopup(popup);

                    i = i + 1;
                }, this);

                self.isSelectData = true;
                self.selectDataName = datasetName;

                function setContent(datasetCode, item) {
                    var content = '';

                    switch (datasetCode) {
                        case 1:
                            // AED設置箇所一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>名称：'+self.nvl(item.name, '')+'</div>'
                                    +'<div>住所：'+self.nvl(item.address, '')+'</div>'
                                    +'<div>設置位置：'+self.nvl(item.installation_position, '')+'</div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                        case 2:
                            // 介護サービス事業所一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>事業所名称　：'+self.nvl(item.name, '')+'</div>'
                                    +'<div>実施サービス：'+self.nvl(item.implementation_service, '')+'</div>'
                                    +'<div>住所：'+self.nvl(item.address, '')+'</div>'
                                    +'<div>電話番号：'+self.nvl(item.phone_number, '')+'</div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                        case 3:
                            // 医療機関一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>名称：'+self.nvl(item.name, '')+'</div>'
                                    +'<div>種類：'+self.nvl(item.type, '')+'</div>'
                                    +'<div>住所：'+self.nvl(item.address, '')+'</div>'
                                    +'<div>電話番号：'+self.nvl(item.phone_number, '')+'</div>'
                                    +'<div>診療曜日：'+self.nvl(item.medical_treatment_day, '')+'</div>'
                                    +'<div>診療時間：'+self.nvl(item.start_time, '')+'～'+self.nvl(item.end_time, '')+'</div>'
                                    +'<div>診療科目：'+self.nvl(item.clinical_department, '')+'</div>'
                                    +'<div>病床数：'+self.nvl(item.bed_count, '')+'</div>'
                                    +'<div>ＵＲＬ：<a href="'+item.url+'" target="_blank" rel="noopener noreferrer">'+self.nvl(item.url, '')+'</a></div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                        case 4:
                            // 文化財一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>名称：'+self.nvl(item.name, '')+'</div>'
                                    +'<div>分類：'+self.nvl(item.classification, '')+'</div>'
                                    +'<div>ＵＲＬ：<a href="'+item.url+'" target="_blank" rel="noopener noreferrer">'+self.nvl(item.url, '')+'</a></div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                        case 5:
                            // 観光施設一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>名称：'+self.nvl(item.name, '')+'</div>'
                                    +'<div>住所：'+self.nvl(item.address, '')+'</div>'
                                    +'<div>説明：'+self.nvl(item.explanation, '')+'</div>'
                                    +'<div>ＵＲＬ：<a href="'+item.url+'" target="_blank" rel="noopener noreferrer">'+self.nvl(item.url, '')+'</a></div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                        case 6:
                            // イベント一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>イベント名：'+self.nvl(item.name, '')+'</div>'
                                    +'<div>開催日：'+self.nvl(item.start_date, '')+'～'+self.nvl(item.end_date, '')+'</div>'
                                    +'<div>開催時間：'+self.nvl(item.start_time, '')+'～'+self.nvl(item.end_time, '')+'</div>'
                                    +'<div>説明：'+self.nvl(item.explanation, '')+'</div>'
                                    +'<div>場所名称：'+self.nvl(item.place_name, '')+'</div>'
                                    +'<div>住所：'+self.nvl(item.address, '')+'</div>'
                                    +'<div>ＵＲＬ：<a href="'+item.url+'" target="_blank" rel="noopener noreferrer">'+self.nvl(item.url, '')+'</a></div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                        case 7:
                            // 公衆無線LANアクセスポイント一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>名称：'+self.nvl(item.name, '')+'</div>'
                                    +'<div>住所：'+self.nvl(item.address, '')+'</div>'
                                    +'<div>ＵＲＬ：<a href="'+item.url+'" target="_blank" rel="noopener noreferrer">'+self.nvl(item.url, '')+'</a></div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                        case 8:
                            // 公衆トイレ一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>名称：'+self.nvl(item.name, '')+'</div>'
                                    +'<div>住所：'+self.nvl(item.address, '')+'</div>'
                                    +'<div>設置位置：'+self.nvl(item.installation_position, '')+'</div>'
                                    +'<div>男性トイレ総数：'+self.nvl(item.male_toilet_total_count, '')+'</div>'
                                    +'<div>女性トイレ総数：'+self.nvl(item.female_toilet_total_count, '')+'</div>'
                                    +'<div>男女共用トイレ総数：'+self.nvl(item.unisex_toilet_total_count, '')+'</div>'
                                    +'<div>多機能トイレ数：'+self.nvl(item.multifunctional_toilet_count, '')+'</div>'
                                    +'<div>車椅子使用者用トイレ有無：'+self.nvl(item.existence_toilet_wheelchair, '')+'</div>'
                                    +'<div>乳幼児用設備設置トイレ有無：'+self.nvl(item.existence_toilet_equipment_infant, '')+'</div>'
                                    +'<div>利用時間：'+self.nvl(item.start_time, '')+'～'+self.nvl(item.end_time, '')+'</div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                        case 9:
                            // 消防水利施設一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>種別：'+self.nvl(item.type, '')+'</div>'
                                    +'<div>住所：'+self.nvl(item.address, '')+'</div>'
                                    +'<div>口径：'+self.nvl(item.caliber, '')+'</div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                        case 10:
                            // 指定緊急避難場所一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>名称：'+self.nvl(item.name, '')+'</div>'
                                    +'<div>住所：'+self.nvl(item.address, '')+'</div>'
                                    +'<div>電話番号：'+self.nvl(item.phone_number, '')+'</div>'
                                    +'<div>災害種別_洪水：'+(item.disaster_type_flood == '1' ? '対応済み' : '未対応')+'</div>'
                                    +'<div>災害種別_崖崩れ、土石流及び地滑り：'+(item.disaster_type_sediment == '1' ? '対応済み' : '未対応')+'</div>'
                                    +'<div>災害種別_高潮：'+(item.disaster_type_storm_surge == '1' ? '対応済み' : '未対応')+'</div>'
                                    +'<div>災害種別_地震：'+(item.disaster_type_earthquake == '1' ? '対応済み' : '未対応')+'</div>'
                                    +'<div>災害種別_津波：'+(item.disaster_type_tsunami == '1' ? '対応済み' : '未対応')+'</div>'
                                    +'<div>災害種別_大規模な火事：'+(item.disaster_type_fire == '1' ? '対応済み' : '未対応')+'</div>'
                                    +'<div>災害種別_内水氾濫：'+(item.disaster_type_inland_water_flood == '1' ? '対応済み' : '未対応')+'</div>'
                                    +'<div>災害種別_火山現象：'+(item.disaster_type_volcanic_phenomenon == '1' ? '対応済み' : '未対応')+'</div>'
                                    +'<div>指定避難所との重複：'+(item.duplicate_designated_shelter == '1' ? '重複している' : '重複していない')+'</div>'
                                    +'<div>想定収容人数：'+self.nvl(item.estimated_capacity, '')+'</div>'
                                    +'<div>対象となる町会・自治会：'+self.nvl(item.target_resident_association, '')+'</div>'
                                    +'<div>ＵＲＬ：<a href="'+item.url+'" target="_blank" rel="noopener noreferrer">'+self.nvl(item.url, '')+'</a></div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                        case 12:
                            // 公共施設一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>名称：'+self.nvl(item.name, '')+'</div>'
                                    +'<div>住所：'+self.nvl(item.address, '')+'</div>'
                                    +'<div>電話番号：'+self.nvl(item.phone_number, '')+'</div>'
                                    +'<div>利用可能曜日：'+self.nvl(item.available_day, '')+'</div>'
                                    +'<div>ＵＲＬ：<a href="'+item.url+'" target="_blank" rel="noopener noreferrer">'+self.nvl(item.url, '')+'</a></div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                        case 13:
                            // 子育て施設一覧
                            content ='<div class="dataset-plot-content">'
                                    +'<div>名称：'+self.nvl(item.name, '')+'</div>'
                                    +'<div>種別：'+self.nvl(item.type, '')+'</div>'
                                    +'<div>住所：'+self.nvl(item.address, '')+'</div>'
                                    +'<div>アクセス方法：'+self.nvl(item.how_to_access, '')+'</div>'
                                    +'<div>駐車場情報：'+self.nvl(item.parking_infomation, '')+'</div>'
                                    +'<div>電話番号：'+self.nvl(item.phone_number, '')+'</div>'
                                    +'<div>収容定員：'+self.nvl(item.capacity, '')+'</div>'
                                    +'<div>受入年齢：'+self.nvl(item.acceptance_age, '')+'</div>'
                                    +'<div>利用可能曜日：'+self.nvl(item.available_day, '')+'</div>'
                                    +'<div>開始時間：'+self.nvl(item.start_time, '')+'～'+self.nvl(item.end_time, '')+'</div>'
                                    +'<div>一時預かりの有無：'+self.nvl(item.existence_temporary_custody, '')+'</div>'
                                    +'<div>ＵＲＬ：<a href="'+item.url+'" target="_blank" rel="noopener noreferrer">'+self.nvl(item.url, '')+'</a></div>'
                                    +'<div>備考：'+self.nvl(item.note, '')+'</div>'
                                    +'</div>';
                            break;
                    }

                    return content;
                }
            },

            // 検索入力画面変更処理
            changeSearchBox: function() {
                this.isSelectData = false;
            },

            // Null置換処理
            nvl: function(val1, val2) {
                var ret;

                if (val1 === null) {
                    ret = val2;
                } else {
                    ret = val1;
                }

                return ret;
            },

            setPlotMarker: function(datasetCode) {
                var marker;

                switch (datasetCode) {
                    case 1:
                        // AED設置箇所一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset01',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-heartbeat"></i>',
                        });
                        break;
                    case 2:
                        // 介護サービス事業所一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset02',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-wheelchair"></i>',
                        });
                        break;
                    case 3:
                        // 医療機関一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset03',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-clinic-medical"></i>',
                        });
                        break;
                    case 4:
                        // 文化財一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset04',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-torii-gate"></i>',
                        });
                        break;
                    case 5:
                        // 観光施設一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset05',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-landmark"></i>',
                        });
                        break;
                    case 6:
                        // イベント一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset08',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-users"></i>',
                        });
                        break;
                    case 7:
                        // 公衆無線LANアクセスポイント一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset07',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-wifi"></i>',
                        });
                        break;
                    case 8:
                        // 公衆トイレ一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset08',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-restroom"></i>',
                        });
                        break;
                    case 9:
                        // 消防水利施設一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset08',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-fire-extinguisher"></i>',
                        });
                        break;
                    case 10:
                        // 指定緊急避難場所一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset08',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-running"></i>',
                        });
                        break;
                    case 12:
                        // 公共施設一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset04',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-building"></i>',
                        });
                        break;
                    case 13:
                        // 子育て施設一覧
                        marker = L.divIcon({
                            className: 'marker-plot dataset08',
                            iconSize: [25, 41],
                            iconAnchor: [7, 20],
                            popupAnchor: [3, -20],
                            html: '<i class="fas fa-baby"></i>',
                        });
                        break;
                }

                return marker;
            },

            dispLoading: function(msg) {
                if (msg === undefined) {
                    msg = "";
                }

                if ($('#loading').length === 0) {
                    $('body').append("<div id='loading'></div>");
                    $('#loading').append("<div class='loader'></div>");
                    $('.loader').append("<i class='fas fa-spinner fa-5x'></i>");
                }
            },

            removeLoading: function() {
                $("#loading").remove();
            },
        }
    }
</script>

<style>
    /* ここにcssを記載します */

    /* マップ */
    html, body, #map {
      width:  100%;
      height: 100%;
    }

    /* 検索入力 */
    #input-id {
      position: absolute;
      z-index: 2000;
    }

    @media screen and (min-width: 576px) {
        #input-id {
            top: 3px;
            left: 3px;
        }
    }

    /* データセット一覧 */
    #info-dataset {
        position: fixed;
        bottom: 0;
        z-index: 3000;
    }

    /* データセットプロットデータ */
    .dataset-plot-content {
        overflow-wrap: break-word;
        word-wrap: break-word;
    }
    .marker-plot {
        position: absolute;
        left: -5px;
        bottom: 0px;
        font-size: 20px;
        color: white;
    }
    .marker-plot i {
        background-color: forestgreen;
        border-radius: 50%;
        text-align: center;
        width: 30px;
        height: 30px;
    }
    .marker-plot i::before {
        padding: 0;
        line-height: 30px;
    }

    /* ヘルプ */
    .leaflet-control-window {
        width: 10%;
    }

    /* 凡例 */
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
        width: 130px;
    }
    .legend i {
        width: 17px;
        height: 17px;
        float: left;
        margin-right: 8px;
	  }
    .leaflet-control-window a:hover {
        color: #ff7043;
    }
    .leaflet-control-window .about {
        margin-bottom: 10px;
    }
    .leaflet-control-window .ver-title {
        margin-bottom: 0;
    }
    .leaflet-control-window .ver-info-detail {
        margin-bottom: 0;
        padding-left: 10px;
    }
    #ver-info-link {
        padding-left: 10px;
    }
    .leaflet-control-window .ver-info .copyright {
        text-align: left;
    }

    @media screen and (max-width: 576px) {
        .leaflet-control-window {
            width: 50%;
        }
    }

    /* Now Loading */
    #loading {
        display: table;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 20000;
        color: #fff;
        background-color: black;
        opacity: 0.6;
    }
    .loader {
        display: table-cell;
        text-align: center;
        vertical-align: middle;
        top: 50%;
        animation: spin 1s ease-in infinite;
    }
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
