<?php

namespace App\Infrastructure\Repositories;

use App\Contexts\Context;
use App\Domain\Models\Gallery\Gallery;
use App\Domain\Models\Gallery\GalleryRepository;
use App\Domain\Models\TenantRepository;

/**
 * Created by PhpStorm.
 * Gallery: blue
 * Date: 7/21/2015
 * Time: 3:37 PM
 */
class GalleryEloquentRepository extends TenantRepository implements GalleryRepository
{

    protected $model;
    /**
     * @var Context
     */
    protected $scope;

    /**
     * @param Gallery $model
     * @param Context $scope
     */
    public function __construct(Gallery $model,Context $scope)
    {

        $this->model = $model;
        $this->scope = $scope;
    }

    /**
     * Add a new Gallery
     *
     * @param Gallery $gallery
     * @return bool|Gallery $gallery
     */
    public function add(Gallery $gallery)
    {
        $b = $gallery->save();
        if($b)
            return $gallery;
        return $b;
    }

    /**
     * Update an existing Gallery
     *
     * @param Gallery $gallery
     * @return bool|mixed
     */
    public function update(Gallery $gallery)
    {
         $b = $gallery->save();
        if($b)
            return $gallery;
        return $b;
    }

    /**
     * Find a gallery by their id
     *
     * @param Integer $id
     * @return Gallery
     */
    public function galleryOfId($id)
    {
        return $this->findThroughColumn($id);
    }

    /**
     * @param Gallery $gallery
     * @return mixed
     */
    public function delete(Gallery $gallery)
    {
        return $gallery->delete();
    }
}