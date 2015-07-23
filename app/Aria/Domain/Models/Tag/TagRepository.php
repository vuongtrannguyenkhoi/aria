<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 7/21/2015
 * Time: 2:47 PM
 */

namespace App\Domain\Models\Tag;


interface TagRepository
{

    public function all();

    /**
     * Add a new Tag
     *
     * @param Tag $Tag
     * @return void
     */
    public function add(Tag $Tag);

    /**
     * Update a Tag
     *
     * @param Tag $Tag
     * @return mixed
     */
    public function update(Tag $Tag);

    /**
     * @param Tag $Tag
     * @return mixed
     */
    public function delete(Tag $Tag);

    /**
     * Find a Tag by its id
     *
     * @param Integer $id
     * @return Tag
     */
    public function TagOfId($id);
}