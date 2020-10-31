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

<meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@section('content')



<br>
<h2>投稿された悩み一覧(クリックで詳細とぶ)</h2>
<br>
<body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">



@foreach($questions as $question)  
  <div class="tw-block-parent">
      <div class="timeline-TweetList-tweet">
          <div class="timeline-Tweet">
              <div class="timeline-Tweet-author">
                  <div class="TweetAuthor">
                      <a class="TweetAuthor-link" href="#channel"> </a>
                      <span class="TweetAuthor-avatar">
                          <div><i class="far fa-user"></i></div>
                      </span>
                      <form action="/test/mypage" method="post">
                        @csrf
                        <input type="submit" name="id" value="{{$users->find($question->id)->user->name}}">
                      </form>
                      <span class="TweetAuthor-name">{{$users->find($question->id)->user->name}}</span>
                      <span class="Icon Icon--verified"></span>
                  </div>
              </div>
              <div class="timeline-Tweet-text">
                <td><a href="{{ action('QuestionController@detail', $question->id) }}">{{$question->title}}</a></td>
                <td>{{$question->content}}</td>
              </div>
              <div class="timeline-Tweet-metadata"><span class="timeline-Tweet-timestamp">9h</span></div>
              <ul class="timeline-Tweet-actions">
              @auth   
                @if($likes->where('user_id',Auth::user()->id)->where('question_id',$question->id)->first())
                    <li class="timeline-Tweet-action">
                        <a class="js-like-toggle loved" href="" data-questionid="{{$question->id}}">
                            <i class="fas fa-heart"></i>
                        </a>
                        <span class="likesCount">{{$question->question_likes_count}}</span>
                    </li>
                    @else
                    <li class="timeline-Tweet-action">
                        <a class="js-like-toggle" href="" data-questionid="{{$question->id}}">
                            <i class="active far fa-heart"></i>
                        </a>
                        <span class="likesCount">{{$question->question_likes_count}}</span>
                    </li>
                  @endif
                @endauth

                @guest
                  <p class="favorite-marke">
                    <a class="js-like-toggle loved" href="" data-questionid="{{$question->id}}">
                      <i class="fas fa-heart"></i>
                    </a>
                    <span class="likesCount">{{$question->question_likes_count}}</span>
                  </p>
                @endguest
                  
              </ul>
          </div>
      </div>
  </div>
  @auth
  @if((int)$question->user_id == Auth::user()->id)
  <button class="btn btn-primary" data-toggle="modal" data-target="#modal-example{{$question->id }}">
		削除
	</button>
	<!-- 2.モーダルの配置 -->
	<div class="modal" id="modal-example{{$question->id }}" tabindex="-1">
		<div class="modal-dialog">
			<!-- 3.モーダルのコンテンツ -->
			<div class="modal-content">
				<!-- 4.モーダルのヘッダ -->
				<div class="modal-header">
					<p class="modal-title" id="modal-label">削除しますか？</p>
				</div>
        <!-- 6.モーダルのフッタ -->
				<div class="modal-footer">
          <form method="POST" action="{{route('destroy',['id' => $question->id])}}">
            @csrf
            @method('delete')
            <button class="btn btn-danger" data-id="{{ $question->id }}" type="submit">削除する</button>
          </form>
				  <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
				</div>
				
			</div>
		</div>
  </div>
  @endif
  @endauth

@endforeach

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="{{ mix('js/_questionlike.js') }}"></script>
</body>

@endsection