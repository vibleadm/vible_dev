<html>
@extends('layouts.layout')

<head>
    <style>
        body {
            font-size: 16pt;
            color: #999;
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


@section('content')
<div class="outer">
    <div class="inner2">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

        <h1>悩み詳細</h1>
        <br>
        <div class="timeline-TweetList-tweet">
            <div class="timeline-Tweet">
                <div class="timeline-Tweet-author">
                    <div class="TweetAuthor">
                        <a class="TweetAuthor-link" href="#channel"> </a>
                        <span class="TweetAuthor-avatar">
                            <div><i class="far fa-user"></i></div>
                        </span>

                        <span class="TweetAuthor-name">{{$nayami_users->find($question->id)->user->name}}</span>
                        <span class="Icon Icon--verified"></span>
                    </div>
                </div>
                <div class="timeline-Tweet-text">
                    <b>
                        タイトル：{{$question->title}}
                    </b>
                    <br><br>
                    本文：
                    {{$question->content}}
                </div>
                <div class="timeline-Tweet-metadata"><span class="timeline-Tweet-timestamp">{{$question->created_at}}</span></div>
                <ul class="timeline-Tweet-actions">
                    @if($likes->where('user_id',Auth::user()->id)->where('question_id',$question->id)->first())
                    <li class="timeline-Tweet-action">
                        <a class="js-like-toggle loved" href="" data-questionid="{{$question->id}}">
                            <i class="fas fa-heart"></i>
                        </a>
                        <span class="likesCount">{{$question->question_likes_count}}</span>
                    </li>
                    @else
                    <li class="timeline-Tweet-action">
                        <a class="js-like-toggle" href="" data-questionid="{{ $question->id }}">
                            <i class="active far fa-heart"></i>
                        </a>
                        <span class="likesCount">{{$question->question_likes_count}}</span>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <br>

        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-example">
            悩める子羊にアドバイス
        </button>
        <!-- 2.モーダルの配置 -->
        <div class="modal" id="modal-example" tabindex="-1">
            <div class="modal-dialog">
                <!-- 3.モーダルのコンテンツ -->
                <div class="modal-content">
                    <!-- 4.モーダルのヘッダ -->
                    <div class="modal-header">
                        <p class="modal-title" id="modal-label">アドバイスしよう</p>
                    </div>
                    <!-- 5.モーダルのボディ -->
                    <div class="modal-body">
                        <form method="post">
                            @csrf
                            <input type="hidden" name="question_id" value="{{$question->id}}">
                            <div><input type="text" name="content" class="form-control" required placeholder="アドバイス入力"></div>
                        </form>
                    </div>
                    <!-- 6.モーダルのフッタ -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary">送信</button>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <h2>アドバイス一覧</h2>
        @foreach($answer_questions as $answer_question)
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
                                <input type="submit" name="id" value="{{$users->find($answer_question->id)->user->name}}">
                                <span class="Icon Icon--verified"></span>
                            </form>
                        </div>
                    </div>
                    <div class="timeline-Tweet-text">
                        {{$answer_question->content}}
                    </div>
                    <div class="timeline-Tweet-metadata"><span class="timeline-Tweet-timestamp">{{$answer_question->created_at}}</span></div>
                    <ul class="timeline-Tweet-actions">

                        @if($likes->where('user_id',Auth::user()->id)->where('answer_question_id',$answer_question->id)->first())
                        <li class="timeline-Tweet-action">
                            <a class="js-like-toggle loved" href="" data-answerquestionid="{{$answer_question->id}}">
                                <i class="fas fa-heart"></i>
                            </a>
                            <span class="likesCount">{{$answer_question->answer_question_likes_count}}</span>
                        </li>
                        @else
                        <li class="timeline-Tweet-action">
                            <a class="js-like-toggle" href="" data-answerquestionid="{{$answer_question->id }}">
                                <i class="active far fa-heart"></i>
                            </a>
                            <span class="likesCount">{{$answer_question->answer_question_likes_count}}</span>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
        @endforeach

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <script src="{{ mix('js/_answerquestionlike.js') }}"></script>
    </div>
</div>

@endsection

</html>