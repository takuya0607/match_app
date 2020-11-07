@extends('layouts.layout')

@section('content')
<div class="signupPage">
  <header class="header">
    <div>プロフィールを編集</div>
  </header>
  <div class='container'>

    <form class="row mt-5" method="POST" action="/users/update/{{ $user->id }}" enctype="multipart/form-data">
    @csrf

    @error('email')
    <span class="errorMessage">
        {{ $message }}
    </span>
    @enderror
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

      <div class="form-group">
        <label>名前</label>
        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
      </div>

      <div class="form-group">
        <label>メールアドレス</label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
      </div>

      <div class="form-group">
        <label>年齢</label>
        <select class="form-control" name="age">
          @for ($i = 20; $i <= 60; $i++)
            <option value="{{ $i }}" selected="{{ old($user->age) }}">{{ $i }}歳</option>
          @endfor
        </select>
      </div>

      <div class="form-group">
        <div><label>性別</label></div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" name="sex" value="0" type="radio" id="inlineRadio1" @if($user->sex === 0) checked @endif>
          <label class="form-check-label" for="inlineRadio1">男</label>
        </div>
        <div class="form-check form-check-inline">
        <input class="form-check-input" name="sex" value="1" type="radio" id="inlineRadio2" @if($user->sex === 1) checked @endif>
          <label class="form-check-label" for="inlineRadio2">女</label>
        </div>
      </div>

      <div class="form-group">
        <label>自己紹介文</label>
        <textarea class="form-control" name="self_introduction" rows="10">{{$user->self_introduction}}
        </textarea>
      </div>

      <div class="text-center">
        <button type="submit" class="btn submitBtn mb-3">変更する</button>
      </div>
      <div class="text-center">
        <button type="button" class="btn submitBtn mb-3" data-toggle="modal" data-target="#destroyModal">削除する</button>
      </div>
      <div class="linkToLogin">
        <a href="/users/show/{{ $user->id }}">戻る</a>
      </div>
    </div>
    </form>
  </div>
</div>

<!-- ボタン・リンククリック後に表示される画面の内容 -->
<div class="modal fade" id="destroyModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <label>本当に削除しますか？</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        <form id="logout-form" action="/users/destroy/{{ $user->id }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="delete_btn">
            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#destroyModal">削除する</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection