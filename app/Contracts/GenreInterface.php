<?php declare(strict_types=1);

namespace App\Contracts;

interface GenreInterface
{
    public function getAllData();
    public function updateOrCreate($id = null, $data) : string;
    public function getOne($id);
    public function delete($id) : string;
}