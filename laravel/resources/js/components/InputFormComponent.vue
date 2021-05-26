<template>
    <!-- ここにhtmlを記載します -->
    <div id="input-id" class="searchbox">
        <form class="form-inline">
            <label class="searchbox-icon">
                <i class="fas fa-search fa-2x"></i>
            </label>
            <div id="prefecture">
                <select id="select-pref" class="form-control select-nocode" v-model="selectedPref" v-on:change="selectPrefecture">
                    <option class="select-nocode" value="00">都道府県</option>
                    <option class="select-code" v-for="pref in prefsData" v-bind:key="pref.id" v-bind:value="pref.id">
                        {{ pref.name }}
                    </option>
                </select>
            </div>
            <div id="municipality" class="col-6 col-md-4">
                <select id="select-municipality" class="form-control select-nocode" v-model="selectedMunicipality" v-on:change="selectMunicipality">
                    <option class="select-nocode" value="000000">市区町村</option>
                    <option class="select-code" v-for="municipality in municipalityData" v-bind:key="municipality.code" v-bind:value="municipality.code">
                        {{ municipality.name }}
                    </option>
                </select>
            </div>
        </form>
        <div id="dataset">
            <div class="select-dataset" v-show="isSelectData">{{ selectDataName }}</div>
        </div>
    </div>
</template>

<script>
    // ここにjavascriptを記載します
    export default {
        props: {
            inputId: {
                name: "inputId",
                type: String,
                Required: true,
            },
            prefsData: {
                name: 'prefsData',
            },
            isSelectData: {
                name: 'isSelectData',
                type: Boolean,
            },
            selectDataName: {
                name: 'selectDataName',
                type: String,
            },
        },

        data: function() {
          return {
              selectedPref: '00', // 都道府県リスト初期値
              selectedPrefData: [], // 選択都道府県データ
              selectedMunicipality: '000000', // 自治体リスト初期値
              municipalityData: [], // 自治体情報データ
              isSelectMunicipality: false, // 自治体リスト選択フラグ
              datasetlistData: [], // データセット一覧データ
          };
        },

        mounted: function() {
            $(function() {
                // 都道府県の変更時イベントを実装
                $('#select-pref').on('change', function(e) {
                    var select = e.target;
                    if (select.value === '00') {
                        $(this).removeClass('select-code');
                        $(this).addClass('select-nocode');
                    } else {
                        $(this).removeClass('select-nocode');
                        $(this).addClass('select-code');
                    }

                    $('#map').css('height', '100%');

                    // 市区町村の初期化
                    $('#select-municipality').val('000000');
                    $('#select-municipality').trigger('change');
                });

                // 市区町村の変更時イベントを実装
                $('#select-municipality').on('change', function(e) {
                    var select = e.target;

                    if (select.value === '000000') {
                        $(this).removeClass('select-code');
                        $(this).addClass('select-nocode');
                    } else {
                        $(this).removeClass('select-nocode');
                        $(this).addClass('select-code');
                    }
                });
            });
        },

        methods: {
            // 都道府県選択処理
            selectPrefecture: async function() {
                var self = this;

                // 自治体リスト選択フラグクリア
                self.selectedMunicipality = '000000';

                // 選択した都道府県データを取得
                self.selectedPrefData = self.prefsData.find(pref => pref.id === self.selectedPref);

                // 各データ取得
                if (self.selectedPrefData === undefined) {
                    self.municipalityData.length = 0;
                    self.datasetListData.length = 0;
                } else {
                    // 自治体情報
                    await self.getMunicipalityDataList(self.selectedPrefData.id);
                    // データセット一覧情報
                    await self.getDatasetlist(self.selectedPrefData.id);
                }

                this.$emit('init-municipality', self.selectedPrefData, self.datasetListData);
                this.$emit('set-marker', self.municipalityData, self.datasetListData);
            },

            //自治体情報データ取得処理
            getMunicipalityDataList: async function(prefId) {
                var self = this;
                var params = new URLSearchParams();

                // パラメータ設定
                params.append('prefId', prefId);

                await axios
                    .post('/map/municipality', params)
                    .then(function (response) {
                        self.municipalityData = response.data;
                    })
                    .catch(function (err) {
                        console.log(err);
                    }
                    .bind(this));
            },

            // データセット一覧データ取得処理
            getDatasetlist: async function(prefId) {
                var self = this;
                var params = new URLSearchParams();

                // パラメータ設定
                params.append('prefId', prefId);

                await axios
                    .post('/map/datasetlist', params)
                    .then(function (response) {
                        self.datasetListData = response.data;
                    })
                    .catch(function (err) {
                        console.log(err);
                    }
                    .bind(this));
            },

            // 市区町村選択処理
            selectMunicipality: function() {
                var i = 0;

                // 市区町村リスト選択フラグ
                if (this.selectedMunicipality === '000000') {
                    // 指定なしのとき、データセットリストを非表示
                    this.isSelectMunicipality = false;
                } else {
                    // 指定ありのとき、データセットリストを表示
                    this.isSelectMunicipality = true;
                }

                // 市区町村の指定があるとき
                if (this.isSelectMunicipality) {
                    // 各市区町村のマーカーをクリックした時と同じ動作をさせる
                    this.municipalityData.forEach(function(item) {
                        if (this.selectedMunicipality === item.code) {
                            this.$emit('input-municipality', i, item);
                        }
                        i = i + 1;
                    }, this);
                }

                // 検索入力画面変更処理を発火
                this.$emit('change-search-box');
            },

            // MapComponentのclickMarkerより処理される
            clickMapMarker: function(code) {
                var self = this;

                $(function() {
                    self.selectedMunicipality = code;
                    $('#select-municipality').val(code);
                    $('#select-municipality').trigger('change');
                });
            },
        }
    }
</script>

<style>
    /* ここにcssを記載します */
    .searchbox {
        background-color: white;
        box-shadow: 0 1px 2px rgb(0 0 0 / 20%);
        position: relative;
    }

    .form-inline {
        margin-bottom: 0;
    }
    .searchbox-icon {
        margin: 5px;
        padding: 5px 0px 5px 0px;
    }
    #prefecture,
    #municipality {
        padding-right: 0px;
        padding-left: 0px;
    }
    #municipality {
        margin-right: 5px;
    }
    select.select-nocode {
        color: #BFBFBF;
    }
    select.select-nocode:focus {
        color: #BFBFBF;
    }
    select.select-code {
        color: #212121;
    }
    select.select-code:focus {
        color: #212121;
    }
    .select-code {
        color: #212121;
    }
    .select-code:focus {
        color: #212121;
    }
    .select-nocode {
        color: #BFBFBF;
    }
    .select-nocode:focus {
        color: #BFBFBF;
    }

    .select-dataset {
        margin-bottom: 5px;
        margin-left: 38.75px;
    }

    @media screen and (max-width: 576px) {
        .searchbox {
            width: 100%;
        }
    }
</style>
