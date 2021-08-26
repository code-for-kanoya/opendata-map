@extends('layouts.app')

<!-- タイトル設定 -->
@section('title', 'オープンデータはどけ行ったけ？-WHERE DOES MY DATA GO?-')

@section('css')
@endsection

{{-- <body> --}}
@section('content')
    <div class="container">
        <div class="header_title">
            <h1>オープンデータはどけ行ったけ？-WHERE DOES MY DATA GO?-</h1>
        </div>

        <div class="main">
            <section id="service" class="section-turquoise">
                <div class="container">
                    <h3>このサービスについて</h3>
                    <div class="content">
                        <p>
                            <div>九州を中心とした<a class="bodik-odcs-link link" data-toggle="collapse" href="#bodik-odcs-content" aria-controls="#bodik-odcs-content" aria-expanded="false">BODIK ODCS</a>という</div>
                            <div>オープンデータカタログサイトがあり、</div>
                            <div>多くの市区町村が参画しています。</div>
                        </p>
                        <p>
                            <div>ここに公開されている</div>
                            <div><a class="opendata-link link" data-toggle="collapse" href="#opendata-content" aria-controls="#opendata-content" aria-expanded="false">オープンデータ</a>（<a class="dataset-link link" data-toggle="collapse" href="#dataset-content" aria-controls="#dataset-content" aria-expanded="false">推奨データセット</a>）を</div>
                            <div>クローリングツールにより取得し、</div>
                            <div>各市区町村のオープンデータの整備状況を</div>
                            <div>マップに表示するサービスです。</div>
                        </p>
                        <p>
                            <div>以下に、このサービスのソースコードを公開しています。<div>
                            <a class="service-link link" href="https://github.com/code-for-kanoya/opendata-map.git" role="button" target="_blank" rel="noopener noreferrer">https://github.com/code-for-kanoya/opendata-map.git</a>
                        </p>
                        <p>
                            <div>このサービスの推奨ブラウザは以下のとおりです。</div>
                            <div>いずれのブラウザも最新版をご利用ください。</div>
                            <ul class="content-list">
                                <li>Google Chrome</li>
                                <li>Microsoft Edge</li>
                                <li>Safari</li>
                            </ul>
                        </p>
                        <p>
                          <div>サービス名「オープンデータはどけ行ったけ？」は、鹿屋弁です。</div>
                        </p>
                        <p>
                            <div>最終データ更新日：2021年04月27日</div>
                        </p>
                    </div>
                    <a class="btn btn-custom btn-lg" href="{{ url('/map') }}" role="button" target="_blank" rel="noopener noreferrer">マップを使う</a>
                </div>
            </section>

            <section id="opendata" class="section">
                <div class="container">
                    <a class="accordion" data-toggle="collapse" href="#opendata-content" aria-controls="#opendata-content" aria-expanded="false">
                      <h3>オープンデータとは？</h3>
                    </a>
                    <div id="opendata-content" class="content collapse" data-parent="#opendata">
                        <p>
                            <div>国、地方公共団体及び事業者が</div>
                            <div>保有する官民データのうち、国民誰もが</div>
                            <div>インターネット等を通じて容易に</div>
                            <div>利用（加工、編集、再配布等）できるよう、</div>
                            <div>次のいずれの項目にも該当する形で</div>
                            <div>公開されたデータのことです。</div>
                        </p>
                        <div class="about-opendata">
                            <p>
                                <div>①営利目的、非営利目的を問わず二次利用可能なルールが適用されたもの</div>
                                <div>②機械判読に適したもの</div>
                                <div>③無償で利用できるもの</div>
                            </p>
                        </div>
                        <a class="link" href="https://cio.go.jp/policy-opendata#ketteibunsyo" target="_blank" rel="noopener noreferrer">詳細はこちら</a>
                    </div>
                </div>
            </section>

            <section id="dataset" class="section-turquoise">
                <div class="container">
                    <a class="accordion" data-toggle="collapse" href="#dataset-content" aria-controls="#dataset-content" aria-expanded="false">
                        <h3>推奨データセットとは？</h3>
                    </a>
                    <div id="dataset-content" class="content collapse" data-parent="#dataset">
                        <p>
                            <div>オープンデータの公開とその利活用を</div>
                            <div>促進することを目的とし、</div>
                            <div>政府として公開を推奨するデータと、</div>
                            <div>公開するデータの作成にあたり準拠すべき</div>
                            <div>ルールやフォーマット等を取りまとめたものです。</div>
                        </p>
                        <a class="link" href="https://cio.go.jp/policy-opendata#dataset" target="_blank" rel="noopener noreferrer">詳細はこちら</a>
                    </div>
                </div>
            </section>

            <section id="bodik-odcs" class="section">
                <div class="container">
                    <a class="accordion" data-toggle="collapse" href="#bodik-odcs-content" aria-controls="#bodik-odcs-content" aria-expanded="false">
                        <h3>BODIK ODCSとは？</h3>
                    </a>
                    <div id="bodik-odcs-content" class="content collapse" data-parent="#bodik-odcs">
                        <p>
                            <div>地方自治体がオープンデータを公開するための</div>
                            <div>データカタログサイトを無償で提供する</div>
                            <div>クラウドサービスのことです。</div>
                        </p>
                        <a class="link" href="https://odcs.bodik.jp/" target="_blank" rel="noopener noreferrer">詳細はこちら</a>
                    </div>
                </div>
            </section>

            <section id="municipality-efforts" class="section-turquoise">
                <div class="container">
                    <a class="accordion" data-toggle="collapse" href="#municipality-efforts-content" aria-controls="#municipality-efforts-content" aria-expanded="false">
                        <h3>自治体の取組について</h3>
                    </a>
                    <div id="municipality-efforts-content" class="content collapse" data-parent="#municipality-efforts">
                        <p>
                            <div>「世界最先端ＩＴ国家創造宣言・</div>
                            <div>官民データ活用推進基本計画」</div>
                            <div>（平成29年5月30日、閣議決定）以来、</div>
                            <div>令和2年度までに地方公共団体の</div>
                            <div>オープンデータ取組率100％を目指し取り組んでいます。</div>
                        </p>
                        <p>
                            <div>令和3年04月12日時点の取組率は、</div>
                            <div>約65%（1,157／1,788自治体）です。</div>
                        </p>
                        <a class="link" href="https://cio.go.jp/policy-opendata#jichitaisuu" target="_blank" rel="noopener noreferrer">詳細はこちら</a>
                    </div>
                </div>
            </section>

            <section id="c4k" class="section">
                <div class="container">
                    <a class="accordion" data-toggle="collapse" href="#c4k-content" aria-controls="#c4k-content" aria-expanded="false">
                        <h3>Code for Kanoyaとは？</h3>
                    </a>
                    <div id="c4k-content" class="content collapse" data-parent="#c4k">
                        <p>
                            <div>シビックテック（Civic Tech）の考えに基づき、</div>
                            <div>Codeの力で地域課題の解決を目指す</div>
                            <div>有志による任意団体です。</div>
                        </p>
                        <p>
                            <div>シビックテックとは、</div>
                            <div>シビック（Civic：市民）と</div>
                            <div>テック（Tech：テクノロジー）を</div>
                            <div>掛け合わせた造語で、</div>
                            <div>テクノロジーを活用した市民の手による</div>
                            <div>地域課題の解決方法のことです。</div>
                        </p>
                        <a class="link" href="https://code-for-kanoya.github.io/" target="_blank" rel="noopener noreferrer">詳細はこちら</a>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <footer class="footer">
        <p class="copyright">
            @ 2021 Code for Kanoya
        </p>
    </footer>
@endsection
{{-- </body> --}}

@section('scripts')
    <script type="text/javascript">
        $(function() {
            // クリックイベントを実装
            $('.bodik-odcs-link').on('click', function(e) {
                var top = $('#bodik-odcs').offset().top;
                scrollTop(top);
            });

            // クリックイベントを実装
            $('.opendata-link').on('click', function(e) {
                var top = $('#opendata').offset().top;
                scrollTop(top);
            });

            // クリックイベントを実装
            $('.dataset-link').on('click', function(e) {
                var top = $('#dataset').offset().top;
                scrollTop(top);
            });

            function scrollTop(top) {
                $('html,body').animate({
                    scrollTop: top
                } ,500);
            }
        });
    </script>
@endsection
