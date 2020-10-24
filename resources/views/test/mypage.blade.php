@extends('layouts.layout')
<!doctype html>
<html>

<head>
	<!-- Bootstrap用CSSの読み込み -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@section('content')
@if(isset($access))
<h1>{{$access}}さんのマイページ</h1>
@else
<h1>{{$myname}}さんのマイページ</h1>
@endif

<body class="bg-light">
	<!--
    @if($myname == $access)
        <form action="/test/mypage/tweet" method="post">
            @csrf
            <div class="container-fluid">
                <div class="col-xl-5 mb-2 mb-xl-0">
                    <div class="mb-1 small text-danger"><span class="badge badge-danger ml-2"></span></div>
                    <div><input type="text" name="content" class="form-control" required placeholder="つぶやいてください"></div>
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
    -->
	<!-- 1.モーダル表示のためのボタン -->
	@if($myname == $access)
	<button class="btn btn-primary" data-toggle="modal" data-target="#modal-example">
		ツイートする
	</button>
	<!-- 2.モーダルの配置 -->
	<div class="modal" id="modal-example" tabindex="-1">
		<div class="modal-dialog">
			<!-- 3.モーダルのコンテンツ -->
			<div class="modal-content">
				<!-- 4.モーダルのヘッダ -->
				<div class="modal-header">
					<p class="modal-title" id="modal-label">今の気持ちを投稿しよう</p>
				</div>
				<!-- 5.モーダルのボディ -->
				<div class="modal-body">
					<form action="/test/mypage/tweet" method="post">
						@csrf
						<div><input type="text" name="content" class="form-control" required placeholder="つぶやいてください"></div>
				</div>
				<!-- 6.モーダルのフッタ -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
					<button type="submit" class="btn btn-primary">ツイート</button>
				</div>
			</div>
		</div>
	</div>
	@endif
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	@foreach($tweets as $tweet)
	<div class="tw-block-parent">
		<div class="timeline-TweetList-tweet">
			<div class="timeline-Tweet">
				<div class="timeline-Tweet-author">
					<div class="TweetAuthor">
						<a class="TweetAuthor-link" href="#channel"> </a>
						<span class="TweetAuthor-avatar">
							<div><i class="far fa-user"></i></div>
						</span>
						<span class="TweetAuthor-name">{{$myname}}</span>
						<span class="Icon Icon--verified"></span>
					</div>
				</div>
				<div class="timeline-Tweet-text">
					<a href="{{action('TweetController@detail',$tweet->id)}}">{{$tweet->content}}</a>
				</div>
				<div class="timeline-Tweet-metadata"><span class="timeline-Tweet-timestamp">9h</span></div>
				<ul class="timeline-Tweet-actions">
					@if($likes->where('user_id',Auth::user()->id)->where('tweet_id',$tweet->id)->first())
					<li class="timeline-Tweet-action">
						<a class="js-like-toggle loved" href="" data-tweetid="{{$tweet->id}}">
							<i class="fas fa-heart"></i>
						</a>
						<span class="likesCount">{{$tweet->tweet_likes_count}}</span>
					</li>
					@else
					<li class="timeline-Tweet-action">
						<a class="js-like-toggle" href="" data-tweetid="{{ $tweet->id }}">
							<i class="active far fa-heart"></i>
						</a>
						<span class="likesCount">{{$tweet->question_likes_count}}</span>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
	@endforeach
	<!--テーブル表示してたときのやつ
    <br>
    <h2>ツイート一覧(クリックで詳細とぶ)</h2>
    <br>
    <h3>
    <table>
    @foreach($tweets as $tweet)
        <tr>
        <td><a href="{{action('TweetController@detail',$tweet->id)}}">{{$tweet->content}}</a></td>
        <td>
            @if($likes->where('user_id',Auth::user()->id)->where('tweet_id',$tweet->id)->first())
            <p class="favorite-marke">
                <a class="js-like-toggle loved" href="" data-tweetid="{{$tweet->id}}">
                    <i class="fas fa-heart"></i>
                </a>
                <span class="likesCount">{{$tweet->tweet_likes_count}}</span>
            </p>
            @else
            <p class="favorite-marke">
                <a class="js-like-toggle" href="" data-tweetid="{{ $tweet->id }}">
                    <i class="active far fa-heart"></i>
                </a>
                <span class="likesCount">{{$tweet->question_likes_count}}</span>
            </p>
            @endif
        </td>
        </tr>
    @endforeach
    </table>
    </h3>
    -->
	<script src="{{ mix('js/_tweetlike.js') }}"></script>
</body>
@endsection