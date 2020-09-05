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
    <table>
    <tr><th>title</th><th>userID</th><th>main</th></tr>
    @foreach($items as $item)
        <tr>
            <td>{{$item->title}}</td>
            <td>{{$item->userID}}</td>
            <td>{{$item->main}}</td>
        </tr>
    @endforeach
    </table>
</body>
</html>
