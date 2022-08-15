<?php

namespace App\Repository;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoryRepository {
    
    public function index()
    {
        return CategoryResource::collection(
            Category::orderBy('name')->paginate(3)
        );
    }

    public function alphabet() {

        return Cache::remember('category-alphabet',60*10, function() {
            $letters = DB::table('categories')
            ->selectRaw("SUBSTRING(name, 1,1) AS letter")
            ->groupBy("letter")->get();

            return collect($letters)->map(function($letter) {
                return $letter->letter;
            });
        });
    }

    public function store($request)
    {
        Category::create($request->only('name'));
        return response()->json(['success'=>true]);
    }

    public function show($letter)
    {
        Cache::add('nesto', '1');
        return CategoryResource::collection(
            Category::where('name','LIKE', $letter.'%')->paginate(3)
        );

    }

    public function update($request, $categoryId)
    {
        $data = $request->validate([
            'name' => ['required', 'max:255']
        ]);
        Category::findOrFail($categoryId)->update($data);
    }

    public function destroy($categoryId)
    {
        Category::destroy($categoryId);
    }
}