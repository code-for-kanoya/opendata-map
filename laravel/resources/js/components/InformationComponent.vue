<template>
    <!-- ここにhtmlを記載します -->
    <div id="info-dataset" class="info-container">
        <div class="info-menu">
            <div class="info-menu-top">
                <div class="info-menu-arrow info-menu-up"></div>
            </div>
            <label class="info-action-label label-score">{{ infoData.score }} / 100 pt</label>
            <button type="button" class="score-help">
                <i class="fas fa-question"></i>
            </button>
            <div class="info-action-label">
                <span class="icon-rank"><i class="fas fa-crown"></i></span>
                <div class="rank">{{ ranking }} / 233位</div>
                <label class="label-time">2021年04月27日　時点</label>
            </div>
            <div class="dataset row-cols-1 form-inline">
                <div id="dataset-1">
                    <div class="col-1 result">{{ infoData.dataset01 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(1)">AED設置箇所一覧</button>
                </div>
                <div id="dataset-2">
                    <div class="col-1 result">{{ infoData.dataset02 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(2)">介護サービス事業所一覧</button>
                </div>
                <div id="dataset-3">
                    <div class="col-1 result">{{ infoData.dataset03 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(3)">医療機関一覧</button>
                </div>
                <div id="dataset-4">
                    <div class="col-1 result">{{ infoData.dataset04 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(4)">文化財一覧</button>
                </div>
                <div id="dataset-5">
                    <div class="col-1 result">{{ infoData.dataset05 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(5)">観光施設一覧</button>
                </div>
                <div id="dataset-6">
                    <div class="col-1 result">{{ infoData.dataset06 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(6)">イベント一覧</button>
                </div>
                <div id="dataset-7">
                    <div class="col-1 result">{{ infoData.dataset07 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(7)">公衆無線LANアクセスポイント一覧</button>
                </div>
                <div id="dataset-8">
                    <div class="col-1 result">{{ infoData.dataset08 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(8)">公衆トイレ一覧</button>
                </div>
                <div id="dataset-9">
                    <div class="col-1 result">{{ infoData.dataset09 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(9)">消防水利施設一覧</button>
                </div>
                <div id="dataset-10">
                    <div class="col-1 result">{{ infoData.dataset10 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(10)">指定緊急避難場所一覧</button>
                </div>
                <div id="dataset-11">
                    <div class="col-1 result">{{ infoData.dataset11 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(11)">地域・年齢別人口</button>
                </div>
                <div id="dataset-12">
                    <div class="col-1 result">{{ infoData.dataset12 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(12)">公共施設一覧</button>
                </div>
                <div id="dataset-13">
                    <div class="col-1 result">{{ infoData.dataset13 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(13)">子育て施設一覧</button>
                </div>
                <div id="dataset-14">
                    <div class="col-1 result">{{ infoData.dataset14 }}</div>
                    <button type="button" class="btn btn-dataset" v-on:click="clickDataset(14)">オープンデータ一覧</button>
                </div>
                <div id="dataset-0">
                    <div class="col-1 result">{{ infoData.existsite }}</div>
                    <div v-if="infoData.existsite === '〇'" class="link-dataset">
                        <a v-bind:href="infoData.url" target="_blank" rel="noopener noreferrer">オープンデータカタログサイト</a>
                    </div>
                    <div v-else-if="infoData.existsite === '✕'" class="link-dataset">
                        <div>オープンデータカタログサイト</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- モーダルエリアはここから -->
        <!-- データセット「地域・年齢別人口」 -->
        <div id="modal-dataset11" class="modal-area">
            <div class="modal-bg"></div>
            <div class="modal-wrapper">
                <div class="close-modal">
                    <i class="fas fa-times-circle fa-2x"></i>
                </div>
                <div class="modal-contents">
                    <div class="modal-content-head"></div>
                    <div class="table">
                        <div class="tr">
                            <div class="th">地域名</div>
                            <div class="th">総人口</div>
                            <div class="th">男性</div>
                            <div class="th">女性</div>
                        </div>
                        <div v-for="data in datasetData" v-bind:key="data.id" class="tr">
                            <div class="td">{{ data.area_name }}</div>
                            <div class="td td-number">{{ formatNumber(data.total_population) }}</div>
                            <div class="td td-number">{{ formatNumber(data.total_male) }}</div>
                            <div class="td td-number">{{ formatNumber(data.total_female) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- データセット「オープンデータ一覧」 -->
        <div id="modal-dataset14" class="modal-area">
            <div class="modal-bg"></div>
            <div class="modal-wrapper">
                <div class="close-modal">
                    <i class="fas fa-times-circle fa-2x"></i>
                </div>
                <div class="modal-contents">
                    <div class="modal-content-head"></div>
                    <div class="table">
                        <div class="tr">
                            <div class="th">データ名称</div>
                            <div class="th">データ形式</div>
                            <div class="th">分類</div>
                            <div class="th">最終更新日</div>
                        </div>
                        <div v-for="data in datasetData" v-bind:key="data.id" class="tr">
                            <div class="td">{{ data.name }}</div>
                            <div class="td">{{ data.format }}</div>
                            <div class="td">{{ data.classification }}</div>
                            <div class="td">{{ data.score }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- スコアヘルプ -->
        <section id="modal-area" class="modal-area">
            <div class="modal-bg"></div>
            <div class="modal-wrapper">
                <div class="close-modal">
                    <i class="fas fa-times-circle fa-2x"></i>
                </div>
                <div class="modal-contents">
                    <div class="modal-content-head"></div>
                    <div class="modal-content-title">【データセット判定】</div>
                    <ul>
                        <li>「〇」オープンデータカタログサイトにて、データセットが取得できる</li>
                        <li>「不」オープンデータカタログサイトにて、データセットが取得できるが、必須項目または緯度・経度のデータが存在しない</li>
                        <li>「異」オープンデータカタログサイトにて、データセット名での検索結果1件以上、データセット名を含む名称が存在しない</li>
                        <!-- RPAで対応後にコメントをはずす -->
                        <!-- <li>「複」オープンデータカタログサイトにて、データセット名での検索結果2件以上、データセット名を含む名称が2件以上</li> -->
                        <li>「失」オープンデータカタログサイトにて、データセットのダウンロードに失敗する</li>
                        <li>「✕」オープンデータカタログサイトにて、データセット名での検索結果0件</li>
                    </ul>
                    <div class="modal-content-title">【オープンデータカタログサイト判定】</div>
                    <ul>
                        <li>
                            <div>「〇」https://odcs.bodik.jp/+全国地方公共団体コード　で、各自治体のオープンデータカタログサイトに遷移できる</div>
                            <div>※オープンデータカタログサイトのURLの全国地方公共団体コードが古い場合、遷移できない</div>
                        </li>
                        <li>
                            <div>「✕」https://odcs.bodik.jp/+全国地方公共団体コード　で、各自治体のオープンデータカタログサイトに遷移できない</div>
                        </li>
                    </ul>
                    <div class="modal-content-title">【データセットの配点】</div>
                    <ul>
                        <li>オープンデータカタログサイト「〇」：6pt</li>
                        <li>オープンデータカタログサイト「✕」：0pt</li>
                        <li>各データセット「〇」：6pt</li>
                        <li>各データセット「不」：3pt</li>
                        <li>各データセット「異」：3pt</li>
                        <!-- RPAで対応後にコメントをはずす -->
                        <!-- <li>各データセット「複」：3pt</li> -->
                        <li>各データセット「失」：0pt</li>
                        <li>各データセット「✕」：0pt</li>
                    </ul>
                    <div class="modal-content-title">【ボーナス点】</div>
                    <ul>
                        <li>合計点が90pt：+10pt</li>
                        <li>合計点が50pt以上90pt未満：+5pt</li>
                    </ul>
                    <div class="modal-content-title">（計算例）</div>
                    <ol>
                        <li>
                            <div>オープンデータカタログサイトが〇（6pt）</div>
                            <div>全データセットが〇（6pt×14）</div>
                            <div class="ex-score">
                                <div>6pt+6pt×14=90pt</div>
                                <div>合計点90pt+ボーナス点10pt=100pt</div>
                            </div>
                        </li>
                        <li>
                            <div>オープンデータカタログサイトが〇（6pt）</div>
                            <div>8つのデータセットが〇（6pt×8）</div>
                            <div>3つのデータセットが異（3pt×3）</div>
                            <!-- RPAで対応後にコメントをはずす -->
                            <!-- <div>1つのデータセットが複（3pt×1）</div>
                            <div class="ex-score">6pt+48pt+9pt+3pt=66pt+5=71pt</div> -->
                            <div class="ex-score">
                                <div>6pt+6pt×8+3pt×3=63pt</div>
                                <div>合計点63pt+ボーナス点5pt=68pt</div>
                            </div>
                        </li>
                        <li>
                            <div>オープンデータカタログサイトが〇（6pt）</div>
                            <div>5つのデータセットが〇（6pt×5）</div>
                            <div>1つのデータセットが異（3pt×1）</div>
                            <!-- RPAで対応後にコメントをはずす -->
                            <!-- <div>2つのデータセットが複（3pt×2）</div>
                            <div class="ex-score">6pt+30pt+3pt+6pt=45pt+0=45pt</div> -->
                            <div class="ex-score">
                                <div>6pt+6pt×5+3pt×1=39pt</div>
                                <div>合計点39pt+ボーナス点0pt=39pt</div>
                            </div>
                        </li>
                        <li>
                            <div>オープンデータカタログサイトが✕（0pt）</div>
                            <div>全データセットが✕（0pt×14）</div>
                            <div class="ex-score">
                                <div>0pt+0pt×14=0pt</div>
                                <div>合計点0pt+ボーナス点0pt=0pt</div>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
        </section>

        <!-- ランキング -->
        <!-- <section id="modal-area-rank" class="modal-area-rank">
            <div class="modal-bg"></div>
            <div class="modal-wrapper">
                <div class="close-modal">
                    <i class="fas fa-times-circle fa-2x"></i>
                </div>
                <div class="modal-contents">
                    <div class="modal-content-head"></div>
                    <div class="table">
                        <div class="tr">
                            <div class="th">順位</div>
                            <div class="th">都道府県</div>
                            <div class="th">市区町村</div>
                            <div class="th">スコア</div>
                        </div>
                        <div v-for="rank in rankingData" v-bind:key="rank.municipalityCode" class="tr">
                            <div class="td">{{ rank.rank }}</div>
                            <div class="td">{{ rank.prefectureName }}</div>
                            <div class="td">{{ rank.municipalityName }}</div>
                            <div class="td">{{ rank.score }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- モーダルエリアはここまで -->
    </div>
</template>

<script>
    // ここにjavascriptを記載します
    export default {
        props: {
            infoDataset: {
                name: "infoDataset",
                type: String,
                Required: true,
            },
            infoData: {
              name: "infoData",
              Required: true,
            },
        },

        data: function() {
            return {
                datasetData: [],
                datasetName: '',
                rankingData: [],
                ranking: 0,
            };
        },

        mounted: function() {
            var self = this;

            $(function () {
                const CNT_DATASET = 15;
                var i = 0;

                var scoreTop;
                var positionY;
                var top;
                var touched;

                scoreTop = $('.label-score').position().top;
                $('.score-help').css('top', scoreTop + 5);

                if (window.matchMedia('(max-width: 576px)').matches) {
                    var infoTop = $('#info-dataset').position().top;
                    $('#map').css('height', infoTop)
                }

                i = 1;
                for (i = 1; i < CNT_DATASET; i += 1) {
                    changeDatasetButtonColor('#dataset-'+i);
                }

                $('.info-menu').on('DOMSubtreeModified', function() {
                    i = 1;
                    for (i = 1; i < CNT_DATASET; i += 1) {
                        changeDatasetButtonColor('#dataset-'+i);
                    }
                });

                // データセットボタン色変更処理
                function changeDatasetButtonColor(id) {
                    var result = $(id).children('.result').html();
                    var button = $(id).children('button');

                    button.removeClass();

                    button.addClass('col-9');
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
                            break;
                    }
                };

                $('.btn-dataset').on('click', function() {
                    if ($(this).parent().attr('id').replace('dataset-', '') !== '0') {
                        if (window.matchMedia('(max-width: 576px)').matches) {
                            $('.info-container').css('top', 'calc(100% - 110px)');
                            $('.info-container').css('overflow', 'hidden');
                            $('.info-menu-arrow').removeClass('info-menu-down');
                            $('.info-menu-arrow').addClass('info-menu-up');
                            $('.info-container').scrollTop(0);
                        }
                    }
                });

                // データセット一覧表示スワイプ処理
                $('.info-menu').on('touchstart', function(e) {
                    onTouchStart(e);
                });
                $('.info-menu').on('touchmove', function(e) {
                    onTouchMove(e);
                });
                $('.info-menu').on('touchEnd', function(e) {
                    onTouchEnd(e);
                });

                // データセット一覧表示矢印タップ処理
                $('.info-menu-arrow').on('touchstart', function(e) {
                    if ($('.info-menu-arrow').hasClass('info-menu-up')) {
                        swipeUp();
                    } else if ($('.info-menu-arrow').hasClass('info-menu-down')) {
                        swipeDown();
                    }
                    return false;
                });

                function getPosition(event) {
                    return event.originalEvent.touches[0].pageY;
                };

                function onTouchStart(e) {
                    positionY = getPosition(e);
                    top = $('.info-container').position().top;;

                    touched = true;
                };

                function onTouchMove(e) {
                    if (!touched) {
                        return;
                    }

                    if (positionY - getPosition(e) > 30) {
                        // 上にスワイプしたとき
                        swipeUp();
                    } else if (positionY - getPosition(e) < -30) {
                        // 下にスワイプしたとき
                        swipeDown();
                    }
                };

                function swipeUp() {
                    $('.info-container').css('top', 0);
                    $('.info-container').css('overflow', 'auto');
                    $('.info-menu-arrow').removeClass('info-menu-up');
                    $('.info-menu-arrow').addClass('info-menu-down');
                };

                function swipeDown() {
                    $('.info-container').css('top', 'calc(100% - 110px)');
                    $('.info-container').css('overflow', 'hidden');
                    $('.info-container').scrollTop(0);
                    $('.info-menu-arrow').removeClass('info-menu-down');
                    $('.info-menu-arrow').addClass('info-menu-up');
                };

                function onTouchEnd(e) {
                    if (!touched) {
                        return;
                    }

                    touched = false;
                };

                // データセット一覧「地域・年齢別人口」のクリックイベントを実装
                $('#dataset-11').on('click', function() {
                    $('#modal-dataset11').fadeIn();
                });

                // データセット一覧「オープンデータ一覧」のクリックイベントを実装
                $('#dataset-14').on('click', function() {
                    $('#modal-dataset14').fadeIn();
                });

                // スコアヘルプボタンのクリックイベントを実装
                $('.score-help').on('click', function() {
                    $('#modal-area').fadeIn();
                });

                // モーダル閉じるボタンのクリックイベントを実装
                $('.close-modal').on('click', function() {
                    $('#modal-dataset11').fadeOut();
                    $('#modal-dataset14').fadeOut();
                    $('#modal-area').fadeOut();
                });
                // モーダル背景のクリックイベントを実装
                $('.modal-bg').on('click', function() {
                    $('#modal-dataset11').fadeOut();
                    $('#modal-dataset14').fadeOut();
                    $('#modal-area').fadeOut();
                });
            });

            this.getRankingResult(this.infoData.code);
        },

        methods: {
            // オープンデータカタログサイト表示処理
            openBODIKSite: function(url) {
                window.open(url);
            },

            // データセットクリック処理
            clickDataset: async function(datasetCode) {
                var self = this;

                // データセット詳細情報取得
                await self.getDatasetDetailInfo(self.infoData.code, datasetCode);
                // データセット詳細表示
                this.$emit('disp-info', datasetCode, self.infoData, self.datasetData, self.datasetName);
            },

            // データセット詳細情報取得処理
            getDatasetDetailInfo: async function(municipalityCode, datasetCode) {
                var self = this;
                var params = new URLSearchParams();
                var name = '';

                // パラメータ設定処理
                params.append('datasetCode', datasetCode);
                params.append('municipalityCode', municipalityCode);

                switch (datasetCode) {
                    case 1:
                        name = 'Aed';
                        self.datasetName = 'AED設置箇所一覧';
                        break;
                    case 2:
                        name = 'CareService'
                        self.datasetName = '介護サービス事業所一覧';
                        break;
                    case 3:
                        name = 'MedicalInstitutions'
                        self.datasetName = '医療機関一覧';
                        break;
                    case 4:
                        name = 'CulturalProperties'
                        self.datasetName = '文化財一覧';
                        break;
                    case 5:
                        name = 'TouristFacilities'
                        self.datasetName = '観光施設一覧';
                        break;
                    case 6:
                        name = 'Events'
                        self.datasetName = 'イベント一覧';
                        break;
                    case 7:
                        name = 'PublicWirelessLan'
                        self.datasetName = '公衆無線LANアクセスポイント一覧';
                        break;
                    case 8:
                        name = 'PublicToilet'
                        self.datasetName = '公衆トイレ一覧';
                        break;
                    case 9:
                        name = 'FireIrrigationFacilities'
                        self.datasetName = '消防水利施設一覧';
                        break;
                    case 10:
                        name = 'DesignatedEmergencyEvacuationSite'
                        self.datasetName = '指定緊急避難場所一覧';
                        break;
                    case 11:
                        name = 'AreaAgePopulation'
                        self.datasetName = '地域・年齢別人口';
                        break;
                    case 12:
                        name = 'PublicFacilitees'
                        self.datasetName = '公共施設一覧';
                        break;
                    case 13:
                        name = 'ChildRearingFacilities'
                        self.datasetName = '子育て施設一覧';
                        break;
                    case 14:
                        name = 'OpenData'
                        self.datasetName = 'オープンデータ一覧';
                        break;
                }

                await axios
                    .post('/map/datasetlist/'+name, params)
                    .then(function (response) {
                        self.datasetData = response.data;
                    })
                    .catch(function (err) {
                      console.log(err);
                    }
                    .bind(this));
            },

            // ランキング結果取得処理
            getRankingResult: async function(municipalityCode) {
                var self = this;
                var params = new URLSearchParams();
                var name = '';

                // パラメータ設定処理（なし）

                await axios
                    .post('/map/ranking', params)
                    .then(function (response) {
                        self.rankingData = response.data;
                    })
                    .catch(function (err) {
                      console.log(err);
                    }
                    .bind(this));

                self.ranking = self.rankingData.find(target => target.municipalityCode === municipalityCode).rank;
            },

            formatNumber: function(number) {
                return String(number).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
            },
        }
    }
</script>

<style>
    /* ここにcssを記載します */
    /* 一覧情報 */
    .info-container {
        top: 80;
        width: 345px;
        transition: transform 0.3s;
        background-color: white;
        overflow: auto;
    }
    .info-menu {
        position: relative;
        -webkit-text-size-adjust: 100%;
    }
    .info-menu-top {
        background-color: white;
        border-radius: 10px 10px 0px 0px;
        border-top: 8px solid white;
        margin: 0 auto 15 auto;
    }
    .info-menu-up {
        display: none;
        width: 1rem;
        height: 1rem;
        border-top: solid #dadce0;
        border-right: solid #dadce0;
        -webkit-transform: rotate(-45deg);
        transform: rotate(-45deg);
        margin-left: 50%;
    }
    .info-menu-down {
        display: none;
        width: 1rem;
        height: 1rem;
        border-top: solid #dadce0;
        border-left: solid #dadce0;
        -webkit-transform: rotate(-135deg);
        transform: rotate(-135deg);
        margin-left: 50%;
    }
    .info-action-label {
        display: block;
        line-height: 24px;
        padding-left: 12px 0;
        text-transform: none;
    }
    .label-name {
        padding-left: 15px;
        color: black;
        text-align: left;
        font-size: 27px;
        font-weight: 500;
    }
    .label-score {
        color: red;
        text-align: center;
        font-size: 40px;
        font-weight: 500;
        font-style: italic;
    }
    .label-time {
        display: block;
        margin-top: 1rem;
        margin-right: 0.75rem;
        color: black;
        text-align: right;
    }
    .label-select-item {
        margin-right: 0.75rem;
        color: black;
        text-align: right;
    }
    .score-help {
        position: absolute;
        right: 11px;
    }

    .result {
        display: inline-block;
    }
    .btn-dataset {
        margin: 0.375rem 0.75rem;
        padding: 0rem 0rem;
    }
    .link-dataset {
        display: inline-block;
        margin: 0.375rem 0.75rem;
        padding: 0rem 0rem;
    }

    .icon-rank {
        display: block;
        position: absolute;
        margin: 4px 0 0 45px;
    }
    .rank {
        position: absolute;
        margin: 0 0 0 70px;
    }

    @media screen and (max-width: 576px) {
        .info-container {
            width: 100%;
            margin-top: 0;
            top: calc(100% - 110px);
            transition: all .5s;
        }
        .info-menu-up {
            display: block;
            z-index: 3500;
        }
        .info-menu-down {
            display: block;
            z-index: 3500;
        }
    }

    /* モーダル */
    .modal-area,
    .modal-area-rank {
        display: none;
        position: fixed;
        z-index: 4000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    .modal-bg {
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(30,30,30,0.7);
    }
    .modal-wrapper {
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
        width: 95%;
        max-width: 900px;
        padding: 10px 30px;
        background-color: #fff;
        height: 70%;
        overflow: auto;
    }
    .close-modal {
        position: fixed;
        top: 0.5rem;
        right: 0.5rem;
        cursor: pointer;
    }
    .modal-content-head {
        margin-bottom: 1.1rem;
    }
    .modal-content-title {
        margin-top: 1rem;
    }
    li {
        font-size: 0.81rem;
    }
    .ex-score {
        display: block;
        margin: 0.5rem;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 0.3rem;
        padding: 0rem 0.5rem;
    }
    .table {
        margin-top: 2rem;
        border-top: 1px solid #cccccc;
        border-left: 1px solid #cccccc;
    }
    .table .tr {
        display: table;
        width: 100%;
    }
    .table .tr .th,
    .table .tr .td {
        display: table-cell;
        width: 25%;
        padding: 8px 15px;
        border-right: 1px solid #cccccc;
        border-bottom: 1px solid #cccccc;
    }
    .table .tr .th {
        background-color: #f5f5f5;
    }
    .table .tr .td {
        background-color: #f5f5f5;
    }
    .td-number {
        text-align: right;
    }

    @media screen and (max-width: 576px) {
        .table .tr .th,
        .table .tr .td {
            font-size: 0.65rem;
        }
    }
</style>
