$(function () {
    var like = $('.js-like-toggle');
    var likeQuestionId;


    like.on('click', function () {
        var $this = $(this);
        likeQuestionId = $this.data('questionid');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/questionlike',  //routeの記述
            type: 'POST', //受け取り方法の記述（GETもある）
            data: {
                'question_id': likeQuestionId //コントローラーに渡すパラメーター
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
                console.log('エラー');
                console.log(err);
                console.log(xhr);
            });

        return false;
    });
});
