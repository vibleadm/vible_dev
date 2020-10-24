<!DOCTYPE HTML>
<html lang="ja">
<link rel=”stylesheet” href=”https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css”>

@auth
  <p>ログインユーザーに表示する。</p>
@endauth

@guest
  <p>ログインしていないユーザーに表示する。</p>
@endguest

<header>
  <p><a href="/test">VIBLE</a></p>
  @auth
    <p class="nav-item"><a href="/test/mypage">MYPAGE</a></p>
    <p class="nav-item"><a href="/logout">LOGOUT</a></p>
  @endauth

  @guest
    <p class="nav-item"><a href="/login">LOGIN</a></p>
  @endguest
</header>



<body>

    @yield('content')

</body>


</html>