<?php

namespace App\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'project' => ProjectResource::make($this->project),
            'category'=> CategoryResource::make($this->category)
        ];
    }
}
