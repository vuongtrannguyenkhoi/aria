<?php

namespace App\Domain\Services;
use App\Contexts\Context;
use App\Domain\Models\Product\Product;
use App\Domain\Models\Product\ProductRepository;
use Assert\Assertion;
use Illuminate\Support\Str;

/**
 * Created by PhpStorm.
 * Product: blue
 * Date: 7/21/2015
 * Time: 3:53 PM
 */
class ProductServices
{

    /**
     * @var ProductRepository $products
     */
    private $products;
    /**
     * @var Context
     */
    private $context;

    /**
     * @param ProductRepository $products
     * @param Context $context
     */
    public function __construct(ProductRepository $products, Context $context)
    {
        $this->products = $products;
        $this->context = $context;
    }

    public function create($name, $price, $active, $thumb, $content)
    {
        Assertion::string($name);
        Assertion::boolean($active);

        $product = new Product([
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => $price,
            'active' => $active,
            'content' => $content,
            'thumb' => $thumb
        ]);

        $product->author()->associate($this->context->context());

        $this->products->add($product);

        return $product;

    }

    public function update($id, $name, $price, $active, $thumb, $content)
    {
        Assertion::string($name);
        Assertion::boolean($active);

        $product = $this->products->productOfId($id);

        $product->name = $name;
        $product->slug = Str::slug($name);
        $product->price = $price;
        $product->active = $active;
        if($thumb)
            $product->thumb = $thumb;
        $product->content = $content;

        $this->products->update($product);

        return $product;
    }

}