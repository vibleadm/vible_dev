<html>
<body>


<p>{{$session_data}}</p>
<form action="/hello/session" method="post">
@csrf
<input type="text" name="input">
<input type="submit" value="send">
</form>

</body>
</html>