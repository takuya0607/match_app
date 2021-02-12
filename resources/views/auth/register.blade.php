@extends('layouts.layout')

@section('content')

<div class="signupPage">
  <header class="header">
    <h3>アカウントを作成</h1>
  </header>
  <div class='container'>

    <form class="row mt-5" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf
    <div class="col-sm-6 offset-sm-3">
        <label for="file_photo" class="rounded-circle userProfileImg">
          <div class="userProfileImg_description">画像をアップロード</div>
          <i class="fas fa-camera fa-3x"></i>
          <input type="file" id="file_photo" name="img_name">

        </label>
        <div class="userImgPreview" id="userImgPreview">
          <img id="thumbnail" class="userImgPreview_content" accept="image/*" src="">
          <p class="userImgPreview_text">画像をアップロード済み</p>
        </div>
        <div class="form-group @error('name')has-error @enderror">
          <label>名前 <span class="badge badge-danger p-2">必須</span></label>
          <input type="text" name="name" class="form-control" placeholder="名前を入力してください">
          <!-- エラーメッセージ'name'は、validation.phpに記載 -->
          @error('name')
              <span class="errorMessage">
                {{ $message }}
              </span>
          @enderror
        </div>

        <div class="form-group @error('email')has-error @enderror">
          <label class="pt-2">メールアドレス <span class="badge badge-danger p-2">必須</span></label>
          <input type="email" name="email" class="form-control" placeholder="メールアドレスを入力してください">
          @error('email')
              <span class="errorMessage">
                {{ $message }}
              </span>
          @enderror
        </div>

        <div class="form-group @error('password')has-error @enderror">
          <label>パスワード</label>
          <em>8文字以上入力してください <span class="badge badge-danger p-2">必須</span></em>
          <input type="password" name="password" class="form-control" placeholder="パスワードを入力してください">
          @error('password')
              <span class="errorMessage">
                {{ $message }}
              </span>
          @enderror
        </div>

        <div class="form-group pt-1">
          <label>確認用パスワード</label>
          <input type="password" name="password_confirmation" class="form-control" placeholder="パスワードを再度入力してください">
        </div>

        <div class="form-group">
          <label>年齢 <span class="badge badge-danger p-2">必須</span></label>
          <select class="form-control" name="age">
            <option value="">-----</option>
            @for ($i = 20; $i <= 60; $i++)
              <option value="{{ $i }}">{{ $i }}歳</option>
            @endfor
          </select>
          @error('age')
              <span class="errorMessage">
                {{ $message }}
              </span>
          @enderror
        </div>

        <div class="form-group">
          <div><label>性別</label></div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" name="sex" value="0" type="radio" id="inlineRadio1" checked>
            <label class="form-check-label" for="inlineRadio1">男</label>
          </div>
          <div class="form-check form-check-inline">
          <input class="form-check-input" name="sex" value="1" type="radio" id="inlineRadio2">
            <label class="form-check-label" for="inlineRadio2">女</label>
          </div>
        </div>

        <div class="form-group @error('self_introduction')has-error @enderror">
          <label>自己紹介文 <span class="badge badge-danger p-2">必須</span></label>
          <textarea class="form-control" name="self_introduction" rows="10"></textarea>
            @error('self_introduction')
            <span class="errorMessage">
              {{ $message }}
            </span>
            @enderror
        </div>

        <div class="text-center">
        <button type="submit" class="btn submitBtn">はじめる</button>
        <div class="linkToLogin">
          <a href="{{ route('login') }}">ログインはこちら</a>
        </div>
    </div>
    </form>
  </div>
</div>
@endsection

<!-- user.js -->
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