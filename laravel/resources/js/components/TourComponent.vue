<template>
    <div>
        <v-tour name="myTour" :steps="steps" :options="myOptions" :callbacks="callbacks">
        </v-tour>
    </div>
</template>

<script>
    // ここにjavascriptを記載します

    import VueTour from 'vue-tour'
    import 'vue-tour/dist/vue-tour.css'

    Vue.use(VueTour)

    export default {
        props: {
            myTour: {
                name: 'myTour',
            },
            vStepId0: {
                name: "vStepId0",
            },
            bus: {
                name: "bus",
            },
        },

        data: function() {
            return {
                content: [
                    // step0Content
                    '<ul style="text-align: left;">'+
                        '<li>確認したい市区町村の都道府県を選択ください。</li>'+
                        '<li>選択した都道府県がカラーリングされます。</li>'+
                        '<li>各カラーの凡例は、画面右下の「？」ボタンより確認できます。</li>'+
                    '</ul>',
                    // step1Content
                    '<ul style="text-align: left;">'+
                        '<li>都道府県選択後、確認したい市区町村を選択ください。</li>'+
                        '<li>マップ上の青いピンをクリックすることでも、市区町村を選択できます。</li>'+
                    '</ul>',
                    // step2Content
                    '<ul style="text-align: left;">'+
                        '<li>選択した市区町村の推奨データセットの整備状況を確認できます。</li>'+
                        '<li>整備されている推奨データセットは、マップにプロットされます。</li>'+
                    '</ul>',
                ],
                myOptions: {
                    // highlight: true,
                    labels: {
                        buttonSkip: 'スキップ',
                        buttonPrevious: '前へ',
                        buttonNext: '次へ',
                        buttonStop: '終わり'
                    },
                },
                steps: [
                    {
                        target:     '#prefecture',
                        content:    '<ul style="text-align: left;">'+
                                        '<li>確認したい市区町村の都道府県を選択ください。</li>'+
                                        '<li>選択した都道府県がカラーリングされます。</li>'+
                                    '</ul>',
                    },
                    {
                        target:     '#municipality',
                        content:    '<ul style="text-align: left;">'+
                                        '<li>都道府県選択後、確認したい市区町村を選択ください。</li>'+
                                        '<li>マップ上の青いピンをクリックすることでも、市区町村を選択できます。</li>'+
                                    '</ul>',
                    },
                    {
                        target:     '#info-dataset',
                        content:    '<ul style="text-align: left;">'+
                                        '<li>選択した市区町村の推奨データセットの整備状況を確認できます。</li>'+
                                        '<li>整備されている推奨データセットは、マップにプロットされます。</li>'+
                                    '</ul>',
                        params: {
                            placement: 'right'
                        }
                    },
                    {
                        target:     '.score-help',
                        content:    '<ul style="text-align: left;">'+
                                        '<li>「？」ボタンよりスコアに関するヘルプを確認できます。</li>'+
                                    '</ul>',
                        params: {
                            placement: 'right'
                        }
                    },
                    {
                        target:     '.state-help',
                        content:    '<ul style="text-align: left;">'+
                                        '<li>「？」ボタンよりヘルプを確認できます。</li>'+
                                        '<li>カラーリングの凡例もこちらから確認できます。</li>'+
                                    '</ul>',
                        params: {
                            placement: 'top'
                        }
                    },
                ],
                callbacks: {
                    onPreviousStep: this.myCustomPreviousStepCallback,
                    onNextStep: this.myCustomNextStepCallback,
                },
            };
        },

        mounted: function() {
            this.$tours['myTour'].start();
            this.bus.$on('myTourStart', this.myTourStart);
        },

        methods: {
            myTourStart: function() {
                this.$tours['myTour'].start();
            },

            myStepsContentInit: function() {
                this.steps[1].content =
                    '<ul style="text-align: left;">'+
                        '<li>都道府県選択後、確認したい市区町村を選択ください。</li>'+
                        '<li>マップ上の青いピンをクリックすることでも、市区町村を選択できます。</li>'+
                    '</ul>';
            },
            myCustomPreviousStepCallback: function(currentStep) {
            },

            myCustomNextStepCallback: function(currentStep) {
                this.myStepsContentInit();

                // チュートリアル市区町村リストの「次へ」ボタンクリック時
                if (currentStep === 1) {
                    if (document.getElementById('info-dataset') === null) {
                        this.steps[1].content =
                            this.steps[1].content+
                            '<div>※市区町村を選択ください。</div>';
                        this.$tours['myTour'].start(1);
                    }

                    // チュートリアル内容設定（データセット一覧）
                    var step2Content = '';
                    var step2Placement = '';

                    if (window.parent.screen.width > 567) {
                        step2Content =
                            '<ul style="text-align: left;">'+
                                '<li>選択した市区町村の推奨データセットの整備状況を確認できます。</li>'+
                                '<li>整備されている推奨データセットは、マップにプロットされます。</li>'+
                            '</ul>';
                        step2Placement = 'right';
                    } else {
                        step2Content =
                            '<ul style="text-align: left;">'+
                                '<li>選択した市区町村の推奨データセットの整備状況を上にスワイプすると確認できます。</li>'+
                                '<li>整備されている推奨データセットは、マップにプロットされます。</li>'+
                            '</ul>';
                        step2Placement = 'top';
                    }

                    this.steps[2].content = step2Content;
                    this.steps[2].params.placement = step2Placement;
                }

                if (currentStep === 2) {
                    // チュートリアル内容設定（データセット一覧）
                    var step3Placement = '';

                    if (window.parent.screen.width > 567) {
                        step3Placement = 'right';
                    } else {
                        step3Placement = 'top';
                    }

                    this.steps[3].params.placement = step3Placement;
                }
            },
        }
    }
</script>

<style>
    /* ここにcssを記載します */
    .v-step {
        z-index: 999;
    }

    .v-step__content {
        margin: 0 0 1rem -1rem;
    }
</style>
