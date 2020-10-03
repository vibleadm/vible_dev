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
    <!--
    {{ Form::model($item, array('action' => array('LikesController@destroy', $item->qid, $item->liked->id))) }}
    <button id="destroy">
    <i class="fas fa-heart"></i>
    <span class="likesCount">
    いいね {{ $item->likes_count }}
    </span>
    </button>
    {!! Form::close() !!}
    -->
    <button class="{{$item->qid}}">
    <i class="fas fa-heart"></i>
    <span class="likesCount">
    いいね {{ $item->likes_count }}
    </span>
    </button>

    <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>sample</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script>
    
    //console.log(liked);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function(){ // 遅延処理
    $('.{{$item->qid}}').click(
    function() {
      var liked = '{{$item->liked->id}}';
      var post = '{{$item->qid}}';
      var $this = $(this);
      console.log(post);
      console.log(liked);
      console.log('うんこ！');

      $.ajax({
        type: 'POST',
        url: '/posts/'+ post + '/likes/'+ liked, // url: は読み込むURLを表す
        //url: action('PostsController@show2'),
        dataType: 'html', // 読み込むデータの種類を記入
        data : {'qid':post},
        //success: function() {
          //console.log('成功');
          //console.log(this);
        //},
      }).done(function (data) {
        // 通信成功時の処理
        //console.log(this);
        console.log('{{$item->qid}}');
        console.log('うんこ成功');
        console.log(data);
        //$this.children('.likesCount').html('data.postLikesCount');
        $this.children('span').html('いいね {{ $item->likes_count - 1}}');
        $this.children('i').toggleClass('far'); //塗りつぶしハート
      }).fail(function (err) {
        // 通信失敗時の処理
        alert('ファイルの取得に失敗しました。');
      });
    }
    );
    });

    </script>

    







    @else
    <p>うんこelse</p>
    <button class="{{$item->qid}}">
    <i class="far fa-heart"></i>
    <span class="likesCount">
    いいね {{ $item->likes_count }}
    </span>
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
      
      var post = '{{$item->qid}}';
      var $this = $(this);
      console.log(post);
      console.log('うんこ！');

      $.ajax({
        type: 'POST',
        url: '/posts/'+ post + '/likes', // url: は読み込むURLを表す
        //url: action('PostsController@show2'),
        dataType: 'html', // 読み込むデータの種類を記入
        data : {'qid':post},
        //success: function() {
          //console.log('成功');
          //console.log(this);
        //},
      }).done(function (data) {
        // 通信成功時の処理
        //console.log(this);
        console.log('{{$item->qid}}');
        console.log('うんこ成功');
        //console.log(data);
        //$this.children('.likesCount').html('data.postLikesCount');
        $this.children('span').html('いいね {{ $item->likes_count + 1}}');
        $this.children('i').toggleClass('fas'); //塗りつぶしハート
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