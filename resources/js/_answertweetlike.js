$(function () {
    var like = $('.js-like-toggle');
    var likeAnswerTweetId;
    
    
    like.on('click', function () {
        var $this = $(this);
        likeAnswerTweetId = $this.data('answertweetid');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/answertweetlike',  //routeの記述
                type: 'POST', //受け取り方法の記述（GETもある）
                data: {
                    'answer_tweet_id': likeAnswerTweetId //コントローラーに渡すパラメーター
                },
            })
    
            // Ajaxリクエストが成功した場合
            .done(function (data) {
    //lovedクラスを追加
                $this.toggleClass('loved'); 
                $this.children('i').toggleClass('fas');
                $this.children('i').toggleClass('far');
                console.log('sucesssss');
    
    //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
                $this.next('.likesCount').html(data); 
    
            })
            // Ajaxリクエストが失敗した場合
            .fail(function (data, xhr, err) {
    //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
    //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
                console.log('エラー');
                console.log(err);
                console.log(xhr);
            });
        
        return false;
    });
    });