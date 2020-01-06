<?php

namespace App\Repositories\Category;

interface CategoryRepositoryInterface
{
    public function getParentCategory();

    public function getIdCategorySameKind($id);
}
