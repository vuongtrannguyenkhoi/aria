<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 7/22/2015
 * Time: 8:51 AM
 */

namespace App\Contexts;


use Illuminate\Database\Eloquent\Model;

class ClientContext implements Context
{
    /**
     * The current context
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $context;

    /**
     * Set the context
     *
     * @param Model $context
     */
    public function set(Model $context)
    {
        $this->context = $context;
    }

    /**
     * Check to see if the context has been set
     *
     * @return boolean
     */
    public function has()
    {
        if($this->context) return true;

        return false;
    }

    /**
     * Get the context identifier
     *
     * @return integer
     */
    public function id()
    {
        return $this->context->id;
    }

    /**
     * Get the context column
     *
     * @return string
     */
    public function column()
    {
        return 'author_id';
    }

    /**
     * Get the context table name
     *
     * @return string
     */
    public function table()
    {
        return 'users';
    }

    public function context()
    {
        return $this->context;
    }
}