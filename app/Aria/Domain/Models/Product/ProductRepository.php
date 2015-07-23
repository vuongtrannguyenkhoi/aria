<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 7/21/2015
 * Time: 2:47 PM
 */

namespace App\Domain\Models\Product;


interface ProductRepository
{
    /**
     * Add a new Product
     *
     * @param Product $product
     * @return void
     */
    public function add(Product $product);

    /**
     * Update a product
     *
     * @param Product $product
     * @return mixed
     */
    public function update(Product $product);

    /**
     * @param Product $product
     * @return mixed
     */
    public function delete(Product $product);

    /**
     * Find a product by its id
     *
     * @param Integer $id
     * @return Product
     */
    public function productOfId($id);

    public function getByPage($page = 1, $limit = 10, $with = array());
}