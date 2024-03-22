<?php

namespace App\Services;

use Illuminate\Support\Collection;

abstract class BaseService
{

     /**
     * @var boolean
     */
    protected $collectsData = false;

    /**
     * @var App\Repositories\RepositoryInterface
     */
    public $repository;

    /**
     * Set the handler
     *
     * @param 
     * @return self
     */
    public function all()
    {
        $this->repository->all();
    }

     /**
     * @var mixed
     */
    protected $data;

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $handler;

    /**
     * Set the data
     *
     * @param mixed $data
     * @return self
     */
    public function setData($data)
    {
        $this->data = ($data instanceof Collection || ! $this->collectsData) ? $data : new Collection($data);

        return $this;
    }
}