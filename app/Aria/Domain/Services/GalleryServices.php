<?php

namespace App\Domain\Services;
use App\Contexts\Context;
use App\Domain\Models\Gallery\Gallery;
use App\Domain\Models\Gallery\GalleryRepository;
use Assert\Assertion;
use Illuminate\Support\Str;

/**
 * Created by PhpStorm.
 * Gallery: blue
 * Date: 7/21/2015
 * Time: 3:53 PM
 */
class GalleryServices
{

    /**
     * @var GalleryRepository $galleries
     */
    private $galleries;
    /**
     * @var Context
     */
    private $context;

    /**
     * @param GalleryRepository $galleries
     * @param Context $context
     */
    public function __construct(GalleryRepository $galleries, Context $context)
    {
        $this->galleries = $galleries;
        $this->context = $context;
    }

    public function create($name)
    {
        Assertion::string($name);

        $gallery = new Gallery([
            'name' => $name,
        ]);

        $gallery->author()->associate($this->context->context());

        return $this->galleries->add($gallery);

    }

    public function update($id, $name)
    {
        Assertion::string($name);

        $gallery = $this->galleries->galleryOfId($id);

        $gallery->name = $name;

        $this->galleries->update($gallery);

        return $gallery;
    }

}