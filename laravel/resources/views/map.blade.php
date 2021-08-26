@extends('layouts.app')

<!-- タイトル設定 -->
@section('title', 'オープンデータマップサービス')

@section('css')
@endsection

<body>
    <div id="app">
        @if (isset($id))
            @if (isset($code))
                <map-component v-bind:prefs-data={{ $prefsData }} v-bind:pref-id={{ $id }} v-bind:municipality-code={{ $code }}></map-component>
            @else
                <map-component v-bind:prefs-data={{ $prefsData }} v-bind:pref-id={{ $id }}></map-component>
            @endif
        @else
            <map-component v-bind:prefs-data={{ $prefsData }}></map-component>
        @endif
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
