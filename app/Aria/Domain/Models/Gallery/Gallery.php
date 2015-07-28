<?php

namespace App\Domain\Models\Gallery;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'author_id'];

    public function author()
    {
        return $this->belongsTo('App\User','author_id');
    }

    public function photos()
    {
        return $this->hasMany('App\Domain\Models\Photo\Photo');
    }

    public function createNewPhoto($data)
    {
        $author = $this->author;

        $photo = $this->photos()->create($data);

        $photo->author()->associate($author);

        return $photo;
    }

}
