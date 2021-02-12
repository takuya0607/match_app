<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    @yield('content')

<script>
// changeイベントは、フォーム要素が変更された時に発火するイベント
$(document).on("change", "#file_photo", function (e) {
  // varで変数readerを定義する
  var reader;
  // ファイルの有無を判定
  if (e.target.files.length) {
    // JavaScriptでファイル操作をしたい時はFileReaderのオブジェクトを作成
    // 4行目で定義したreaderという変数に、FileReaderオブジェクトのインスタンスを代入
    // これでFileReaderに関するオブジェクトが、readerを用いて使用可能に！
    reader = new FileReader;
    // ファイルの読み込みがうまくいけば、reader.onloadイベントが発生
    reader.onload = function (e) {
      // varで変数userThumbnail(サムネイル)を定義する
      var userThumbnail;
      // プレビューを表示するための要素を取得
      userThumbnail = document.getElementById('thumbnail');
      // 取得したファイルを表示させるために、.is - activeクラスを付与
      $("#userImgPreview").addClass("is-active");
      // プレビュー画像を表示するためにimgタグのsrc属性に、e.target.resultで取得したファイル名を設定
      userThumbnail.setAttribute('src', e.target.result);
    };
    return reader.readAsDataURL(e.target.files[0]);
  }
});
</script>

</body>
</html>
