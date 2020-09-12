<!DOCTYPE HTML>
<html lang="ja">
<link rel="stylesheet" type="text/css" href="style.css">


@auth
  <p>ログインユーザーに表示する。</p>
@endauth

@guest
  <p>ログインしていないユーザーに表示する。</p>
@endguest

<header>
    <p><a href="/test">VIBLE</a></p>
    <nav class="pc-nav">
	<ul>
        <li><a href="/">TOP</a></li>
        @auth
            <li><a href="/test/mypage">MYPAGE</a></li>
		    <li><a href="/logout">LOGOUT</a></li>
        @endauth
        @guest
            <li><a href="/login">LOGIN</a></li>
        @endguest
	</ul>
    </nav>
</header>



<body>

    @yield('content')

</body>


</html>
