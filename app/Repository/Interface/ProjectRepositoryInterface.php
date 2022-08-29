<?php

namespace App\Repository\Interface;

interface ProjectRepositoryInterface {

    public function index();
    public function alphabet();
    public function all();
    public function store($request);
    public function show($letter);
    public function update($request, $categoryId);
    public function destroy($categoryId);
}