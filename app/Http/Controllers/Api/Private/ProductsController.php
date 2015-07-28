<?php

namespace App\Http\Controllers\App\Api\Auth;

use App\Domain\Models\Identity\UserRepository;
use App\Domain\Models\Product\Product;
use App\Domain\Models\Product\ProductRepository;
use App\Domain\Services\ProductServices;
use App\Http\Controllers\App\Api\ApiController;

use App\Http\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class ProductsController extends ApiController
{
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductServices
     */
    private $productServices;

    /**
     * @param ProductRepository $productRepository
     * @param UserRepository $userRepository
     * @param ProductServices $productServices
     */
    public function __construct(ProductRepository $productRepository, UserRepository $userRepository,ProductServices $productServices)
    {

        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->productServices = $productServices;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        $product = $this->productServices->create($input['name'],$input['price'],true,$input['fileUrl'],$input['content']);

        return $this->respond([
            'data' => $this->transform($product)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return Response
     */
    public function show($id)
    {

        try{
            $product = $this->productRepository->productOfId($id);
        }catch (ModelNotFoundException $e){
            return $this->respondNotFound('Product does not exist');
        }
        return $this->respond([
            'data' => $this->transform($product)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try{
            $product = $this->productRepository->productOfId($id);
        }catch (ModelNotFoundException $e){
            return $this->respondNotFound('Product does not exist');
        }
        return $this->respond([
            'data' => $this->transform($product)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        $input = Input::all();

        $thumb = '';
        if( isset($input['thumb'])){
            $thumb = $input['thumb'];
        }

        $product = $this->productServices->update($id,$input['name'], $input['price'],$input['active'],$thumb,$input['content']);

        if(!$product)
            return $this->respondNotFound('Product does not exist');

        return $this->respond([
            'data' => $this->transform($product)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

        $product = $this->productRepository->productOfId($id);

        if(!$product)
            return $this->respondNotFound('Product does not exist');

        $this->productRepository->delete($product);

        return $this->respond([
           'data' => $this->transform($product)
        ]);
    }

    public function getDataTables()
    {
        $products = $this->productRepository->getByPage(Input::get('start') , Input::get('length'));

        return $this->respond([
            'draw' => Input::get('raw'),
            "recordsTotal" => 7,
            'data' => $this->transformCollection($products->items),
        ]);
    }


    public function postUpload()
    {
        //upload photo
        $files = Input::file('file');
        $photos = [];
        foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = sha1(time().time()).".{$extension}";
                $dir = public_path().'/upload/member/'.$filename;
                Image::make($file)->resize(300, 200)->save($dir);
                $photos[] = '/upload/member/'.$filename;
        }

        return $this->respond([
           'data' => $photos
        ]);
    }

    private function transformCollection($products){

        return array_map([$this,'transform'],$products);
    }

    private function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'thumb' => $product->thumb,
            'name' => $product->name,
            'price' => $product->price,
            'active' => $product->active ? true: false,
            'content' => $product->content,
        ];
    }



}
