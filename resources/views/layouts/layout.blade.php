<!DOCTYPE HTML>
<html lang="ja">

<head>
  <!-- cssをインポート -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
  <link rel=”stylesheet” href=”https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css”> <link rel="shortcut icon" href="{{ asset('/favicon.png') }}">
</head>


<header>
  <nav class="navbar navbar-expand-lg navbar-light pl-5 pr-5 pt-2 pb-2">
    <a class="navbar-brand text-white" href="/test"><img class="logo" src="{{ asset('image/logo_transparent.png') }}" alt="logo" style="height: 50px;"></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="ナビゲーションの切替">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="Navber">



      <ul class="navbar-nav ml-auto mr-5">
        <li class="nav-item ml-2">
          <a class="nav-link text-white" id="post-link" href="/test/add">悩みを投稿する</a>
        </li>
        <li class="nav-item dropdown">
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">マイページ</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">下書き一覧</a>
            <a class="dropdown-item" href="#">編集リクエスト一覧</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">設定</a>
            <a class="dropdown-item" href="#">ヘルプ</a>
            <div class="dropdown-divider"></div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
        @auth
        <li class="nav-item ml-2">
          <a class="nav-link text-white" href="/test/mypage">マイページ</a>
        </li>
        <li class="nav-item ml-2">
          <a class="nav-link text-white" href="/logout">ログアウト</a>
        </li>
        @endauth
        @guest
        <li class="nav-item ml-2">
          <a class="nav-link text-white" id="register" href="/register">ユーザ登録</a>
        </li>
        <li class="nav-item ml-2">
          <a class="nav-link text-white" href="/login">ログイン</a>
        </li>
        @endguest
      </ul>
    </div><!-- /.navbar-collapse -->
  </nav>

</header>



<body>

  @yield('content')

</body>


</html>