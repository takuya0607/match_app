@extends('layouts.layout')

@section('content')

<div class="topPage">
  <nav class="nav">
    <ul>
      <li class="personIcon">
        <a href="/users/show/{{Auth::id()}}"><i class="fas fa-user fa-3x"></i></a></li>
      <li class="appIcon"><a href="{{route('home')}}"><img src="/storage/images/techpit-match-icon.png"></a></li>

      <!-- ここの行を追加 -->
      <li class="messageIcon"><a href="{{route('matching')}}"><i class="fas fa-3x fa-comments"></a></i></li>

    </ul>
  </nav>
  <div id="tinderslide">
    <ul>
        @foreach($users as $user)
        <li data-user_id="{{ $user->id }}">
          <div class="userNews d-flex justify-content-between">
            <div>{{ $user->name }}</div>
            <div class="ml-2">{{ $user->age }}歳</div>
          </div>
          <img src="/storage/images/{{ $user->img_name}}" alt onerror="this.onerror = null; this.src='';">
          <div class="like"></div>
          <div class="dislike"></div>
        </li>
        @endforeach
    </ul>
    <div class="noUser">近くにお相手がいません。</div>
  </div>
  <div class="actions" id="actionBtnArea">
      <a href="#" class="dislike"><i class="fas fa-times fa-2x"></i></a>
      <a href="#" class="like"><i class="fas fa-heart fa-2x"></i></a>
  </div>
</div>

<script>
var usersNum = {{ $userCount }};
var from_user_id = {{ $from_user_id }};
</script>

@endsection