<?php

namespace App\Infrastructure\Repositories;

use App\Contexts\Context;
use App\Domain\Models\Product\Product;
use App\Domain\Models\Product\ProductRepository;
use App\Domain\Models\TenantRepository;

/**
 * Created by PhpStorm.
 * Product: blue
 * Date: 7/21/2015
 * Time: 3:37 PM
 */
class ProductEloquentRepository extends TenantRepository implements ProductRepository
{

    protected $model;
    /**
     * @var Context
     */
    protected $scope;

    /**
     * @param Product $model
     * @param Context $scope
     */
    public function __construct(Product $model,Context $scope)
    {

        $this->model = $model;
        $this->scope = $scope;
    }
    
    /**
     * Add a new Product
     *
     * @param Product $product
     * @return void
     */
    public function add(Product $product)
    {
       $product->save();
    }

    /**
     * Update an existing Product
     *
     * @param Product $product
     * @return void
     */
    public function update(Product $product)
    {
        $product->save();
    }

    /**
     * Find a product by their id
     *
     * @param Integer $id
     * @return Product
     */
    public function productOfId($id)
    {
        return $this->findThroughColumn($id);
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public function delete(Product $product)
    {
        return $product->delete();
    }

    public function getByPage($page = 1, $limit = 10, $with = array())
    {
        return $this->getByPageThroughColumn($page,$limit,$with);
    }
}