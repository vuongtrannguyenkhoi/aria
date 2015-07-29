<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 7/21/2015
 * Time: 2:47 PM
 */

namespace App\Domain\Models\Photo;


interface PhotoRepository
{
    /**
     * Add a new Photo
     *
     * @param Photo $photo
     * @return Photo $photo|bool
     */
    public function add(Photo $photo);

    /**
     * Update a photo
     *
     * @param Photo $photo
     * @return mixed
     */
    public function update(Photo $photo);

    /**
     * @param Photo $photo
     * @return mixed
     */
    public function delete(Photo $photo);

    /**
     * Find a photo by its id
     *
     * @param Integer $id
     * @return Photo
     */
    public function photoOfId($id);
}