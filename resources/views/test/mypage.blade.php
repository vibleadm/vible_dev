@extends('layouts.layout')

<!doctype html>
<html>
<head>
  <!-- Bootstrap用CSSの読み込み -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

@if(isset($access)) 
<h1>{{$access}}さんのマイページうんこ</h1>
@else
<h1>{{$myname}}さんのマイページ</h1>
@endif

@section('content')

<ul class="nav nav-tabs">
<li class="nav-item">
	<a class="nav-link active" href="/test/mypage">twitter</a>
</li>
<li class="nav-item">
	<a class="nav-link" href="/test/mypage/vible">vible</a>
</li>
</ul>

<div class="tab-content">
<div class="tab-pane active">
	<body class="bg-light">
	<?php
	var_dump($myname, $access);
	?>
	@if($myname == $access)
	<form action="/test/mypage/tweet" method="post">
	@csrf
	<div class="container-fluid">
		<div class="col-xl-5 mb-2 mb-xl-0">
			<div class="mb-1 small text-danger"><span class="badge badge-danger ml-2"></span></div>
			<div><input type="text" name="main" class="form-control" required placeholder="つぶやいてください"></div>
			
		</div>
	<div class="col-xl row">
		<div class="col-sm-auto col-lg col-xl align-self-center">
			<input type="submit" value="ツイート" class="btn btn-info mb-1">
			<input type="reset" value="クリア" class="btn btn-warning mb-1">
		</div>
	</div>
	</form>
	@else
	<p>私は40歳以上、70歳未満です</p>

	@endif


	</body>

	<br>
	<h2>ツイート一覧(クリックで詳細とぶ)</h2>
	<br>

	<body>
	<h3>
	<table>
	@foreach($items2 as $item)
		<tr>
		<td><a href="{{action('PostsController@tw_show',$item->tweetID)}}">{{$item->main}}</a></td>
		<td>{{$item->userID}}</td>
		<!--
		<td>うんこ{{$item->tweetID}}</td>
		<td>いいね{{$item->likes_count}}</td>
		<td>{{$item->liked}}</td>
		-->
		<td>
		@if($item->liked)
		<!--<p>うんこif</p>-->
		{{ Form::model($item, array('action' => array('TweetLikesController@destroy', $item->tweetID, $item->liked->id))) }}
			<button type="submit">
			<i class="fas fa-heart"></i>
			いいね {{ $item->likes_count }}
			</button>
		{!! Form::close() !!}
		@else
		<!--<p>うんこelse</p>-->
		{{ Form::model($item, array('action' => array('TweetLikesController@store', $item->tweetID))) }}
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
	</body>
</div>
@endsection