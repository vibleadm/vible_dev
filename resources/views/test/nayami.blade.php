@extends('layouts.layout')
<!DOCTYPE html>
<html>
<head>
    <title>nayami</title>
    <style>
    body {font-size:16pt; color:#999;}
    h1 {font-size:50pt; text-align:right; color:#f6f6f6;
        margin:-20px 0px -30px 0px; letter-spacing:-4pt;}

    th {background-color:#999; color:fff; padding:5px 10px;}
    td {border: solid 1px #aaa; color:#999; padding:5px 10px;}
    </style>
</head>

@section('content')
@auth
<p>↓マイページ↓</p>
<form action="/test/mypage" method="post">
    @csrf
    <td><input type="submit" name="id" value="{{$whoami->name}}"></td>
</form>
@endauth

<br>
<h2>投稿された悩み一覧(クリックで詳細とぶ)</h2>
<br>
<body>
<p><a href="/test/add" >ログインして悩みを投稿しよう</a></p>
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

</body>

<!--
<head>
<meta charset="utf-8">
<title>sample</title>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script>
$(function(){ // 遅延処理
$('#button').click(
function() {
  $.ajax({
    type: 'GET',
    url: '/sample2', // url: は読み込むURLを表す
    dataType: 'html', // 読み込むデータの種類を記入
  }).done(function (results) {
    // 通信成功時の処理
    $('#text').html(results);
  }).fail(function (err) {
    // 通信失敗時の処理
    alert('ファイルの取得に失敗しました。');
  });
}
);
});
</script>
</head>
<body>
<input type="button" id="button" value="「sample2.html」取得" />
<br>
<div id="text"></div>
</body>
-->

<head>
<meta charset="utf-8">
<title>sample</title>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script>
$(function(){ // 遅延処理
$('#button').click(
function() {
  $.ajax({
    type: 'GET',
    url: '/sample2', // url: は読み込むURLを表す
    dataType: 'html', // 読み込むデータの種類を記入
  }).done(function (results) {
    // 通信成功時の処理
    $('#text').html(results);
  }).fail(function (err) {
    // 通信失敗時の処理
    alert('ファイルの取得に失敗しました。');
  });
}
);
});
</script>
</head>
<body>
<input type="button" id="button" value="「sample2.html」取得" />
<br>
<div id="text"></div>
</body>


<h3>
<table>
@foreach($items as $item)
<tr>
<td><a href="{{ action('PostsController@show2', $item->qid) }}">{{$item->title}}</a></td>
<td>{{$item->userID}}</td>
<td>
    @if($item->liked)
    <p>うんこif</p>
    {{ Form::model($item, array('action' => array('LikesController@destroy', $item->qid, $item->liked->id))) }}
    <button type="submit">
    <i class="fas fa-heart"></i>
    いいね {{ $item->likes_count }}
    </button>
    {!! Form::close() !!}
    @else
    <p>うんこelse</p>
    {{ Form::model($item, array('action' => array('LikesController@store', $item->qid))) }}
    <button type="submit">
    <i class="far fa-heart"></i>
    いいね {{ $item->likes_count }}
    </button>
    {!! Form::close() !!}
    @endif
</td>
</tr>
@endforeach
</table>
</h3>

@endsection