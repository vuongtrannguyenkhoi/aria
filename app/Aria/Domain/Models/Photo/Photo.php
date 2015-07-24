<?php

namespace App\Domain\Models\Photo;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['path', 'author_id', 'product_id'];

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }

}
