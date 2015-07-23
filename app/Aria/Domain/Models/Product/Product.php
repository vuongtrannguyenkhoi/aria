<?php

namespace App\Domain\Models\Product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'price', 'active', 'thumb', 'content', 'author_id'];

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }

    public function tags()
    {
    }

}
