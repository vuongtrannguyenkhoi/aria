<?php

namespace App\Infrastructure\Repositories;

use App\Contexts\Context;
use App\Domain\Models\Tag\Tag;
use App\Domain\Models\Tag\TagRepository;
use App\Domain\Models\TenantRepository;

/**
 * Created by PhpStorm.
 * Tag: blue
 * Date: 7/21/2015
 * Time: 3:37 PM
 */
class TagEloquentRepository extends TenantRepository implements TagRepository
{

    protected $model;
    /**
     * @var Context
     */
    protected $scope;

    /**
     * @param Tag $model
     * @param Context $scope
     */
    public function __construct(Tag $model,Context $scope)
    {

        $this->model = $model;
        $this->scope = $scope;
    }
    
    /**
     * Add a new Tag
     *
     * @param Tag $tag
     * @return void
     */
    public function add(Tag $tag)
    {
       $tag->save();
    }

    /**
     * Update an existing Tag
     *
     * @param Tag $tag
     * @return void
     */
    public function update(Tag $tag)
    {
        $tag->save();
    }

    /**
     * Find a tag by their id
     *
     * @param Integer $id
     * @return Tag
     */
    public function tagOfId($id)
    {
        return $this->findThroughColumn($id);
    }

    /**
     * @param Tag $tag
     * @return mixed
     */
    public function delete(Tag $tag)
    {
        return $tag->delete();
    }

    public function all()
    {
        return $this->allThroughColumn();
    }
}