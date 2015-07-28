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
    protected $fillable = [
        'path',
        'thumb',
        'title',
        'alt',
        'author_id',
        'gallery_id'
    ];

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }

    public function gallery()
    {
        return $this->belongsTo('App\Domain\Models\Gallery\Gallery');
    }

}
