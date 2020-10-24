@extends('layouts.layout')
<!DOCTYPE html>
<html>

<head>
    <title>nayami</title>
    <style>
        body {
            font-size: 16pt;
            color: #999;
        }

        h1 {
            font-size: 50pt;
            text-align: right;
            color: #f6f6f6;
            margin: -20px 0px -30px 0px;
            letter-spacing: -4pt;
        }

        th {
            background-color: #999;
            color: fff;
            padding: 5px 10px;
        }

        td {
            border: solid 1px #aaa;
            color: #999;
            padding: 5px 10px;
        }
    </style>
</head>

@section('content')
<br>
<h2>投稿内容一覧(クリックで詳細とぶs)</h2>
<br>

<body>
    <p><a href="/test/add">ログインして悩みを投稿しよう</a></p>
</body>


<p>うんこlike</p>
<p>{{$post}}</p>
<p>うんこpost2</p>
<p>{{$post2}}</p>
<p>like</p>
<p>{{$like}}</p>








@endsection

</html>