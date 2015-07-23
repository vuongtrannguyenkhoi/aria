<?php

namespace App\Http\Controllers\App\Api\Auth;

use App\Domain\Models\Identity\UserRepository;
use App\Domain\Models\Tag\Tag;
use App\Domain\Models\Tag\TagRepository;
use App\Domain\Services\TagServices;
use App\Http\Controllers\App\Api\ApiController;

use App\Http\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class TagsController extends ApiController
{
    /**
     * @var TagRepository
     */
    private $tagRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var TagServices
     */
    private $tagServices;

    /**
     * @param TagRepository $tagRepository
     * @param UserRepository $userRepository
     * @param TagServices $tagServices
     */
    public function __construct(TagRepository $tagRepository, UserRepository $userRepository,TagServices $tagServices)
    {

        $this->tagRepository = $tagRepository;
        $this->userRepository = $userRepository;
        $this->tagServices = $tagServices;
    }

    public function index()
    {
        $tags = $this->tagRepository->all()->toArray();

        return $this->respond([
            "status"=>"success",
            'data' => [
                'data' => $this->transformCollection($tags),
                'meta' =>[]
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $input = Input::all();

        $tag = $this->tagServices->create($input['name']);

        return $this->respond([
            'data' => $this->transform($tag)
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
            $tag = $this->tagRepository->tagOfId($id);
        }catch (ModelNotFoundException $e){
            return $this->respondNotFound('Tag does not exist');
        }
        return $this->respond([
            'data' => $this->transform($tag)
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
            $tag = $this->tagRepository->tagOfId($id);
        }catch (ModelNotFoundException $e){
            return $this->respondNotFound('Tag does not exist');
        }
        return $this->respond([
            'data' => $this->transform($tag)
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

        $tag = $this->tagServices->update($id,$input['name'], $input['price'],$input['active'],$thumb,$input['content']);

        if(!$tag)
            return $this->respondNotFound('Tag does not exist');

        $this->tagRepository->update($tag);

        return $this->respond([
            'data' => $this->transform($tag)
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

        $tag = $this->tagRepository->tagOfId($id);

        if(!$tag)
            return $this->respondNotFound('Tag does not exist');

        $this->tagRepository->delete($tag);

        return $this->respond([
           'data' => $this->transform($tag)
        ]);
    }

    public function getDataTables()
    {
        $tags = $this->tagRepository->getByPage(Input::get('start') , Input::get('length'));

        return $this->respond([
            'draw' => Input::get('raw'),
            "recordsTotal" => 7,
            'data' => $this->transformCollection($tags->items),
        ]);
    }

    private function transformCollection($tags){

        return array_map([$this,'transform'],$tags);
    }

    private function transform($tag)
    {
        return [
            'id' => $tag['id'],
            'name' => $tag['name'],
            'slug' => $tag['slug'],
        ];
    }



}
