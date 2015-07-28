<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 7/21/2015
 * Time: 2:47 PM
 */

namespace App\Domain\Models\Gallery;


interface GalleryRepository
{
    /**
     * Add a new Gallery
     *
     * @param Gallery $gallery
     * @return Gallery $gallery
     */
    public function add(Gallery $gallery);

    /**
     * Update a gallery
     *
     * @param Gallery $gallery
     * @return mixed
     */
    public function update(Gallery $gallery);

    /**
     * @param Gallery $gallery
     * @return mixed
     */
    public function delete(Gallery $gallery);

    /**
     * Find a gallery by its id
     *
     * @param Integer $id
     * @return Gallery
     */
    public function galleryOfId($id);
}