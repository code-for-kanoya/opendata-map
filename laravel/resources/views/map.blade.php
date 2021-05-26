@extends('layouts.app')

<!-- タイトル設定 -->
@section('title', 'オープンデータマップサービス')

@section('css')
@endsection

<body>
    <div id="app">
        <map-component v-bind:prefs-data={{ $prefsData }}></map-component>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
