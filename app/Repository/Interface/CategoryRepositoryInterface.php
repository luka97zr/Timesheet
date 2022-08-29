<?php

namespace App\Repository\Interface;

interface CategoryRepositoryInterface {

    public function index();
    public function alphabet();
    public function store($request);
    public function show($letter);
    public function update($request, $categoryId);
    public function destroy($categoryId);
}