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
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>sample</title>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script>
// jsのajax使う前に記述
//metaのやつも必要
//こいつはqidのこと
var post = 28;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function(){ // 遅延処理
$('#store').click(
function() {
  $.ajax({
    type: 'POST',
    url: '/posts/'+ post + '/likes', // url: は読み込むURLを表す
    //url: action('PostsController@show2'),
    dataType: 'html', // 読み込むデータの種類を記入
    success: function() {
                console.log('成功');
    },
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
<button id="button">btn01</button>
<div id="text"></div>
</body>

-->

<!--
@foreach($items as $item)
<body>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script>
var test = '{{$item->qid}}';
console.log(test);
</script>
</body>
@endforeach
-->

@foreach($items as $item)
<button id="{{$item->qid}}">うんこ</button>
<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
<script>
$("#{{$item->qid}}").click(function(e){
  console.log(this);
  //console.log($(this));
  //console.log(e);
  //console.log($(e));
});
</script>
@endforeach




<h3>
<table>
@foreach($items as $item)
<tr>
<td><a href="{{ action('PostsController@show2', $item->qid) }}">{{$item->title}}</a></td>
<td>{{$item->userID}}</td>
<td>{{$item->qid}}</td>
<td>
    @if($item->liked)
    <p>うんこif</p>
    {{ Form::model($item, array('action' => array('LikesController@destroy', $item->qid, $item->liked->id))) }}
    <button id="destroy">
    <i class="fas fa-heart"></i>
    いいね {{ $item->likes_count }}
    </button>
    {!! Form::close() !!}




    @else
    <p>うんこelse</p>
    <button class="{{$item->qid}}">
    <i class="far fa-heart"></i><span>
    いいねうんこ {{ $item->likes_count }}</span>
    </button>



    <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>sample</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
    
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function(){ // 遅延処理
    $('.{{$item->qid}}').click(
    function() {
      var $this = $(this);
      var post = '{{$item->qid}}';
      console.log(post);
      console.log('うんこ！');

      $.ajax({
        type: 'POST',
        url: '/posts/'+ post + '/likes', // url: は読み込むURLを表す
        //url: action('PostsController@show2'),
        dataType: 'html', // 読み込むデータの種類を記入
        success: function() {
          console.log('成功');
          console.log(this);
        },
      }).done(function (results) {
        // 通信成功時の処理
        $this.children('span').html('いいねうんこ {{ $item->likes_count }}');
        $this.children('i').toggleClass('fas'); //塗りつぶしハート
        //$('#text').html(results);
      }).fail(function (err) {
        // 通信失敗時の処理
        alert('ファイルの取得に失敗しました。');
      });
    }
    );
    });
    </script>
    </head>
    
    
    @endif
</td>
</tr>
@endforeach
</table>
</h3>

@endsection