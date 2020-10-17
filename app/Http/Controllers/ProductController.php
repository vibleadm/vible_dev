<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\LikeProduct;
use App\Review;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if (auth()->user()) {
            $query->with(['like_products'=>function ($query) {
                $query->where('user_id', '=', auth()->user()->id);
            }]);
        }   
        $query->orderby('id','ASC');
        $products = $query->paginate(15)->appends( $request->Query() );
        return view('product.index',compact('products'));
    }

    //いいねボタン機能
    public function like_product(Request $request)
    {
         if ( $request->input('like_product') == 0) {
             //ステータスが1のときは
             LikeProduct::create([
                 'product_id' => $request->input('product_id'),
                  'user_id' => auth()->user()->id,
             ]);
         } elseif ( $request->input('like_product')  == 1 ) {
             LikeProduct::where('product_id', "=", $request->input('product_id'))
                ->where('user_id', "=", auth()->user()->id)
                ->delete();
        }
         return  $request->input('like_product');
    }  
    
}
