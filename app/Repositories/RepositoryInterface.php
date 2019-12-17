<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function getAll();

    public function getWith(array $attributes);

    public function getPaginate();

    public function getLatest();

    public function find($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);

}
