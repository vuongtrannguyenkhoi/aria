<?php

namespace App\Domain\Models\Tag;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'author_id'];

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }

}
