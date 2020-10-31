@extends('layouts.layout')
<html>

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
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

        <h1>ツイート詳細</h1>
        <br>
        <div class="timeline-TweetList-tweet">
            <div class="timeline-Tweet">
                <div class="timeline-Tweet-author">
                    <div class="TweetAuthor">
                        <a class="TweetAuthor-link" href="#channel"> </a>
                        <span class="TweetAuthor-avatar">
                            <div><i class="far fa-user"></i></div>
                        </span>

                        <span class="TweetAuthor-name">{{$tw_users->find($tweet->id)->user->name}}</span>
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
                        <span class="likesCount">{{$tweets->tweet_likes_count}}</span>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <br>

        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-example">
            このツイートへ返信
        </button>
        <!-- 2.モーダルの配置 -->
        <div class="modal" id="modal-example" tabindex="-1">
            <div class="modal-dialog">
                <!-- 3.モーダルのコンテンツ -->
                <div class="modal-content">
                    <!-- 4.モーダルのヘッダ -->
                    <div class="modal-header">
                        <p class="modal-title" id="modal-label">ツイートへ返信</p>
                    </div>
                    <!-- 5.モーダルのボディ -->
                    <div class="modal-body">
                        <form method="post">
                            @csrf
                            <input type="hidden" name="tweet_id" value="{{$tweet->id}}">
                            <div><input type="text" name="content" class="form-control" required placeholder="コメント入力"></div>
                    </div>
                    <!-- 6.モーダルのフッタ -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary">送信</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

        <br>
        <br>
        <h2>コメント一覧</h2>
        <p>{{$answer_tweets}}</p>
        <h2>
            <form action="/test/mypage" method="post">
                @csrf
                @foreach($answer_tweets as $answer_tweet)
                <div class="tw-block-parent">
                    <div class="timeline-TweetList-tweet">
                        <div class="timeline-Tweet">
                            <div class="timeline-Tweet-author">
                                <div class="TweetAuthor">
                                    <a class="TweetAuthor-link" href="#channel"> </a>
                                    <span class="TweetAuthor-avatar">
                                        <div><i class="far fa-user"></i></div>
                                    </span>
                                    <input type="submit" name="id" value="{{$users->find($answer_tweet->id)->user->name}}">
                                    <span class="Icon Icon--verified"></span>
                                </div>
                            </div>
                            <div class="timeline-Tweet-text">
                                {{$answer_tweet->content}}
                            </div>
                            <div class="timeline-Tweet-metadata"><span class="timeline-Tweet-timestamp">{{$answer_tweet->created_at}}</span></div>
                            <ul class="timeline-Tweet-actions">

                                @if($likes->where('user_id',Auth::user()->id)->where('answer_tweet_id',$answer_tweet->id)->first())
                                <li class="timeline-Tweet-action">
                                    <a class="js-like-toggle loved" href="" data-answertweetid="{{$answer_tweet->id}}">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                    <span class="likesCount">{{$answer_tweet->answer_tweet_likes_count}}</span>
                                </li>
                                @else
                                <li class="timeline-Tweet-action">
                                    <a class="js-like-toggle" href="" data-answertweetid="{{$answer_tweet->id}}">
                                        <i class="active far fa-heart"></i>
                                    </a>
                                    <span class="likesCount">{{$answer_tweet->answer_tweet_likes_count}}</span>
                                </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </form>
        </h2><br>

        <script src="{{ mix('js/_answertweetlike.js') }}"></script>
    </div>
</div>
@endsection

</html>