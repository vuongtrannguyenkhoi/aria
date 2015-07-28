<?php

namespace App\Domain\Services;
use App\Contexts\Context;
use App\Domain\Models\Photo\Photo;
use App\Domain\Models\Photo\PhotoRepository;
use Assert\Assertion;
use Illuminate\Support\Str;

/**
 * Created by PhpStorm.
 * Photo: blue
 * Date: 7/21/2015
 * Time: 3:53 PM
 */
class PhotoServices
{

    /**
     * @var PhotoRepository $photos
     */
    private $photos;
    /**
     * @var Context
     */
    private $context;

    /**
     * @param PhotoRepository $photos
     * @param Context $context
     */
    public function __construct(PhotoRepository $photos, Context $context)
    {
        $this->photos = $photos;
        $this->context = $context;
    }

    public function create($data)
    {

        $photo = new Photo($data);

        $photo->author()->associate($this->context->context());

        $this->photos->add($photo);

        return $photo;

    }

    public function update($data)
    {

        $photo = $this->photos->photoOfId($data['id']);

        $photo->title = $data['title'];
        $photo->alt = $data['alt'];
        $this->photos->update($photo);

        return $photo;
    }

}