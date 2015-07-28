<?php

namespace App\Infrastructure\Repositories;

use App\Contexts\Context;
use App\Domain\Models\Photo\Photo;
use App\Domain\Models\Photo\PhotoRepository;
use App\Domain\Models\TenantRepository;

/**
 * Created by PhpStorm.
 * Photo: blue
 * Date: 7/21/2015
 * Time: 3:37 PM
 */
class PhotoEloquentRepository extends TenantRepository implements PhotoRepository
{

    protected $model;
    /**
     * @var Context
     */
    protected $scope;

    /**
     * @param Photo $model
     * @param Context $scope
     */
    public function __construct(Photo $model,Context $scope)
    {

        $this->model = $model;
        $this->scope = $scope;
    }
    
    /**
     * Add a new Photo
     *
     * @param Photo $photo
     * @return void
     */
    public function add(Photo $photo)
    {
       $photo->save();
    }

    /**
     * Update an existing Photo
     *
     * @param Photo $photo
     * @return void
     */
    public function update(Photo $photo)
    {
        $photo->save();
    }

    /**
     * Find a photo by their id
     *
     * @param Integer $id
     * @return Photo
     */
    public function photoOfId($id)
    {
        return $this->findThroughColumn($id);
    }

    /**
     * @param Photo $photo
     * @return mixed
     */
    public function delete(Photo $photo)
    {
        return $photo->delete();
    }
}