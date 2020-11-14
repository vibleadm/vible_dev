<!DOCTYPE HTML>
<html lang="ja">

<head>
  <!-- cssをインポート -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
  <link rel=”stylesheet” href=”https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css”> <link rel="shortcut icon" href="{{ asset('/favicon.png') }}">
  <style>
    .outer {
      position: relative;
    }

    .button1 {
      margin-left: 70%;
    }

    .button2 {}

    .inner1 {
      position: relative;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      margin: auto;
      width: 50%;
    }

    .inner2 {
      position: relative;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      margin-left: 30%;
      width: 50%;
    }
  </style>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-8QRPRE4PPS"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-8QRPRE4PPS');
  </script>
  <script data-ad-client="ca-pub-6224979193111346" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>


<header>
  <nav class="navbar navbar-expand-xl navbar-dark mt-3 mb-3">
    <a class="navbar-brand text-white" href="/test"><img class="logo" src="{{ asset('image/logo_transparent.png') }}" alt="logo" style="height: 50px;"></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#Navber" aria-controls="Navber" aria-expanded="false" aria-label="ナビゲーションの切替">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="Navber">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item ml-2">
          <a class="nav-link text-white" id="post-link" href="/test/add">悩みを投稿する</a>
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

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</header>

<body>
  @yield('content')
</body>

<footer>
  <p>Copyright ©2020 Surap. All Rights Reserved.</p>
</footer>






</html>