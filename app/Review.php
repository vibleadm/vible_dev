<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable= [
        'user_id',
        'product_id',
        'title',
        'review',
        'review_star',
    ];

    public function products()
    {
        return $this->belongsTo('App\Product', 'product_id');
    }
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
