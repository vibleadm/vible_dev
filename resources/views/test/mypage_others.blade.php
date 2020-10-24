@extends('layouts.layout')

<!doctype html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="tab.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<h1>{{$user->name}}さんのマイページ</h1>

@section('content')

<!-- is-active-btnクラスを追加 -->
<a class="tab_btn is-active-btn" href="#item1">twitter</a>
<a class="tab_btn" href="#item2">vible</a>

<div class="tab_item is-active-item" id="item1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/app.min.js?171029002" defer></script>
	<br>
	<h2>ツイート一覧(クリックで詳細とぶ)</h2>
	<br>

	<h2>

		<body>
			<table>
				@foreach($items2 as $item)
				<tr>
					<td><a href="{{action('PostsController@tw_show',$item->tweetID)}}">{{$item->main}}</a></td>
					<td>{{$item->main}}</td>
					<td>{{$item->userID}}</td>
				</tr>
				@endforeach
			</table>
	</h2>
	</body>
</div>

@endsection