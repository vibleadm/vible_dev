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
	<ul class="nav nav-tabs">

        @auth
        <!--
        <li class="nav-item"><a href="/test/mypage">MYPAGE</a></li>
        -->
        <li class="nav-item"><a href="/logout">LOGOUT</a></li>
        @endauth

        @guest
        <li class="nav-item"><a href="/login">LOGIN</a></li>
        @endguest
	</ul>
</header>



<body>

    @yield('content')

</body>


</html>