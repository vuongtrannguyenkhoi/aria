<?php

namespace App\Http\Controllers\App\Api\Auth;

use App\Domain\Models\Gallery\Gallery;
use App\Domain\Models\Gallery\GalleryRepository;
use App\Domain\Models\Identity\UserRepository;
use App\Domain\Models\Photo\Photo;
use App\Domain\Models\Photo\PhotoRepository;
use App\Domain\Services\GalleryServices;
use App\Domain\Services\PhotoServices;
use App\Http\Controllers\App\Api\ApiController;

use App\Http\Requests;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class PhotosController extends ApiController
{
    /**
     * @var PhotoRepository
     */
    private $photoRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var PhotoServices
     */
    private $photoServices;
    /**
     * @var GalleryServices
     */
    private $galleryServices;
    /**
     * @var GalleryRepository
     */
    private $galleryRepository;

    /**
     * @param PhotoRepository $photoRepository
     * @param PhotoServices $photoServices
     * @param GalleryServices $galleryServices
     * @param GalleryRepository $galleryRepository
     */
    public function __construct(PhotoRepository $photoRepository, PhotoServices $photoServices, GalleryServices $galleryServices, GalleryRepository $galleryRepository)
    {

        $this->photoRepository = $photoRepository;
        $this->photoServices = $photoServices;
        $this->galleryServices = $galleryServices;
        $this->galleryRepository = $galleryRepository;
    }

    public function index()
    {
        $photos = $this->photoRepository->all()->toArray();

        return $this->respond([
            "status"=>"success",
            'data' => [
                'data' => $this->transformCollection($photos),
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

        $photo = $this->photoServices->create($input['name']);

        return $this->respond([
            'data' => $this->transform($photo)
        ]);
    }

    public function uploads()
    {
        $files = Input::file('file');
        $photos = [];
        foreach ($files as $file) {

            $photos[] = $this->uploadPhoto($file);

            sleep(1);
        }

        $gallery = $this->galleryServices->create('');

        foreach ($photos as $photo) {

            $newPhoto = $gallery->createNewPhoto([
                'path' => $photo['path'],
                'thumb' => $photo['thumb']
            ]);

            $this->photoRepository->add($newPhoto);
        }

        $this->galleryRepository->update($gallery);

        $photos = $gallery->photos()->get()->toArray();

        return $this->respond([
            'data' => $this->transformCollection($photos)
        ]);
    }

    public function upload()
    {
        $file = Input::file('file');

        $photo = $this->uploadPhoto($file);

        $gallery = $this->galleryServices->create('');

        $newPhoto = $gallery->createNewPhoto([
            'path' => $photo['path'],
            'thumb' => $photo['thumb']
        ]);

        $photo = $this->photoRepository->add($newPhoto);

        $this->galleryRepository->update($gallery);

        return $this->respond([
            'data' => $this->transform($photo)
        ]);
    }

    private function uploadPhoto($file){
        $extension = $file->getClientOriginalExtension();
        $filename = sha1(time().time()).".{$extension}";
        $dir = public_path().'/upload/member/'.$filename;
        $dirThumb = public_path().'/upload/member/thumb_'.$filename;

        $image = Image::make($file)->save($dir);

        $image->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($dirThumb);
        $photo = [
            'thumb' => '/upload/member/thumb_'.$filename,
            'path' => '/upload/member/'.$filename
        ];

        return $photo;
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
            $photo = $this->photoRepository->photoOfId($id)->toArray();
        }catch (ModelNotFoundException $e){
            return $this->respondNotFound('Photo does not exist');
        }
        return $this->respond([
            'data' => $this->transform($photo)
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

        $photo = $this->photoServices->update($input);

        if(!$photo)
            return $this->respondNotFound('Photo does not exist');


        return $this->respond([
            'data' => $this->transform($photo)
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

        $photo = $this->photoRepository->photoOfId($id);

        if(!$photo)
            return $this->respondNotFound('Photo does not exist');

        $this->photoRepository->delete($photo);

        return $this->respond([
            'data' => $this->transform($photo)
        ]);
    }

    private function transformCollection($photos){

        return array_map([$this,'transform'],$photos);
    }

    private function transform($photo)
    {
        return [
            'id' => $photo['id'],
            'path' => $photo['path'],
            'thumb' => $photo['thumb'],
            'title' => $photo['title'],
            'alt' => $photo['alt'],
        ];
    }



}
