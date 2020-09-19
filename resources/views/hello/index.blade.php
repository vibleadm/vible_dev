<html>
<head>
    <title>Hello/Index</title>
    <style>
    body {font-size:16pt; color:#999;}
    h1 {font-size:50pt; text-align:right; color:#f6f6f6;
        margin:-20px 0px -30px 0px; letter-spacing:-4pt;}

    th {background-color:#999; color:fff; padding:5px 10px;}
    td {border: solid 1px #aaa; color:#999; padding:5px 10px;}
    </style>
</head>

<body>
    @if (Auth::check())
    <p>USER: {{$user->name . '(' . $user->email .')'}}</p>
    @else
    <p>※ログインしていません。(<a href="/login">ログイン</a>|<a href="/register">登録</a>)</p>
    @endif

    <table>
    <tr><th>Name</th><th>Mail</th><th>Age</th></tr>
    @foreach($items as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->mail}}</td>
            <td>{{$item->age}}</td>
        </tr>
    @endforeach
    </table>
</body>
</html>
