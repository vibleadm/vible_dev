<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LikeProduct extends Model
{
    protected $fillable= [
        'product_id',
        'user_id',
    ];

  

    public function products()
    {
        return $this->belongsTo('App\Product', 'product_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
