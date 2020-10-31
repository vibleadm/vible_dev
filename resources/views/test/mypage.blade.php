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
<div class="outer">
	<div class="inner1">
		<br>
		@if(isset($access))
		<h1>{{$access}}さんのツイート一覧</h1>
		@else
		<h1>{{$myname}}さんのツイート一覧</h1>
		@endif
		<br>

		<!-- 1.モーダル表示のためのボタン -->
		@if($myname == $access)
		<div class="button1">
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
						<form action="/test/mypage/tweet" method="post">
							<div class="modal-body">
								@csrf
								<div><input type="text" name="content" class="form-control" required placeholder="つぶやいてください"></div>
							</div>
							<!-- 6.モーダルのフッタ -->
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
								<button type="submit" class="btn btn-primary">ツイート</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		@endif
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	</div>

	<div class="inner2">
		@foreach($tweets as $tweet)
		<div class="tw-block-parent">
			@auth
			@if((int)$tweet->user_id == Auth::user()->id)
			<div class="button2">
				<button class="btn btn-primary" data-toggle="modal" data-target="#modal-example{{$tweet->id}}">
					削除
				</button>
				<!-- 2.モーダルの配置 -->

				<div class="modal" id="modal-example{{$tweet->id}}" tabindex="-1">
					<div class="modal-dialog">
						<!-- 3.モーダルのコンテンツ -->
						<div class="modal-content">
							<!-- 4.モーダルのヘッダ -->
							<div class="modal-header">
								<p class="modal-title" id="modal-label">削除しますか？</p>
							</div>

							<!-- 6.モーダルのフッタ -->
							<div class="modal-footer">
								<form method="POST" action="{{route('tweet.destroy',['id' => $tweet->id])}}">

									@csrf
									@method('delete')
									<p>{{$tweet->id}}</p>
									<button class="btn btn-danger" data-id="{{ $tweet->id }}" type="submit">削除する</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endif
			@endauth

			<div class="timeline-TweetList-tweet">
				<div class="timeline-Tweet">
					<div class="timeline-Tweet-author">
						<div class="TweetAuthor">
							<a class="TweetAuthor-link" href="#channel"> </a>
							<span class="TweetAuthor-avatar">
								<div><i class="far fa-user"></i></div>
							</span>

							<span class="TweetAuthor-name">{{$access}}</span>
							<span class="Icon Icon--verified"></span>
						</div>
					</div>
					<div class="timeline-Tweet-text">
						<a href="{{action('TweetController@detail',$tweet->id)}}">{{$tweet->content}}</a>
					</div>
					<div class="timeline-Tweet-metadata"><span class="timeline-Tweet-timestamp">{{$tweet->created_at}}</span></div>
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
		<br>
		@endforeach

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="{{ mix('js/_tweetlike.js') }}"></script>
	</div>
</div>
@endsection