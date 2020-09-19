<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LoginUserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        //ログインユーザーIDを取得
        $loginId = Auth::id();
        //カート情報のユーザーIDを取得
        $requestId = $request->userID;

        //ログイン者とカート情報作成者が一致しなければ別のページにリダイレクト
        if ($loginId != $requestId) {
           return redirect(route('/test/mypage_others'));
        }

     //チェックに合格し次の処理に進むことができる
     return $next($request);
     }
}
