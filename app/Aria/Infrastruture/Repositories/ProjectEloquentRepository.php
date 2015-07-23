<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 7/22/2015
 * Time: 9:00 AM
 */

namespace App\Infrastructure\Repositories;


use App\Contexts\Context;
use App\Domain\Models\Project\Project;
use App\Domain\Models\Project\ProjectRepository;
use App\Domain\Models\TenantRepository;

class ProjectEloquentRepository extends TenantRepository implements ProjectRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Context
     */
    protected $scope;

    /**
     * Construct
     *
     * @param Project $model
     * @param Context $scope
     */
    public function __construct(Project $model, Context $scope)
    {
        $this->model = $model;
        $this->scope = $scope;
    }

    /**
     * Return all projects
     *
     * @param array $with
     * @return \App\Domain\Models\Illuminate\Database\Eloquent\Collection
     */
    public function all(array $with = array())
    {
        return $this->allThroughColumn($with);
    }
}