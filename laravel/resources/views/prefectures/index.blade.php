@extends('layouts.app')

<!-- タイトル設定 -->
@section('title', 'オープンデータ - 九州')

@section('css')
@endsection

<body>
  <div id="app">
    <prefecturemap-component v-bind:prefs-data={{ $prefsData }}></prefecturemap-component>
  </div>
  <script src="{{ mix('js/app.js') }}"></script>
</body>
