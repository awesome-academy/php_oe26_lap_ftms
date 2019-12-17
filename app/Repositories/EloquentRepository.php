<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;

abstract class EloquentRepository implements RepositoryInterface
{
    protected $_model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->_model->all();
    }

    public function getPaginate()
    {
        return $this->_model->latest()->paginate(config('custom.PagePaginate'));
    }

    public function getLatest()
    {
        return $this->_model->latest();
    }

    public function getWith(array $attributes)
    {
        $result = $this->_model->with($attributes)->get();

        return $result;
    }

    public function find($id)
    {
        $result = $this->_model->findOrFail($id);

        return $result;
    }

    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        $result = $this->_model->find($id);
        if ($result) {
            $result->update($attributes);
            
            return $result;
        }

        return false;
    }
    
    public function delete($id)
    {
        $result = $this->_model->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
