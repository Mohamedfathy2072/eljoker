<?php

namespace App\Interfaces;

interface SavedSearchInterface
{
public function store(array $data);
public function getByUser($userId, $limit);
public function delete($id);
}