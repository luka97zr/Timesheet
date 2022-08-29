<?php


namespace App\Repository\Interface;

interface ClientRepositoryInterface {

    public function index();
    public function alphabet();
    public function all();
    public function store($request);
    public function show($letter);
    public function update($request, $categoryId);
    public function destroy($categoryId);
}