@extends('layouts.layout')

<!doctype html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="tab.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

@if(isset($access)) 
<h1>{{$access}}さんのマイページ</h1>
@else
<h1>{{$myname}}さんのマイページ</h1>
@endif

@section('content')

  <!-- is-active-btnクラスを追加 -->
  <a class="tab_btn is-active-btn" href="#item1">twitter</a>
  <a class="tab_btn" href="#item2">vible</a>

	<div class="tab_item is-active-item" id="item1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
		<script src="js/app.min.js?171029002" defer></script>
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

		<h2>
		<body>
		<table>
		@foreach($items2 as $item)
			<tr>
				<td><a href="{{action('PostsController@tw_show',$item->tweetID)}}">{{$item->main}}</a></td>
				<td>{{$item->userID}}</td>
			</tr>
		@endforeach
		</table>
		</h2>
		</body>
	</div>

@endsection
