<link rel="stylesheet" type="text/css" href="style.css">
<header>
    <h1>
	<a href="test.php">VIBLE</a>
    <h1>
    <nav class="pc-nav">
	<ul>
            <li><a href="test.php">TOP</a></li>
	    <?php if(isset($_SESSION['userID'])){ ?>
                <li><a href="mypage.php">MYPAGE</a></li>
		<li><a href="logout.php">LOGOUT</a></li>
	    <?php }else{ ?>
                <li><a href="index2.php">LOGIN</a></li>
	    <?php } ?>
	</ul>
    </nav>
</header>
