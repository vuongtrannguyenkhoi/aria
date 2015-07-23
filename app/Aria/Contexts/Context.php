<?php
/**
 * Created by PhpStorm.
 * User: blue
 * Date: 7/22/2015
 * Time: 8:50 AM
 */

namespace App\Contexts;


use Illuminate\Database\Eloquent\Model;

interface Context
{
    /**
     * Set the context
     * @param Model $context
     * @return
     */
    public function set(Model $context);

    /**
     * Check to see if the context has been set
     *
     * @return boolean
     */
    public function has();

    /**
     * Get the context identifier
     *
     * @return integer
     */
    public function id();

    /**
     * Get the context column
     *
     * @return string
     */
    public function column();

    /**
     * Get the context table name
     *
     * @return string
     */
    public function table();
}