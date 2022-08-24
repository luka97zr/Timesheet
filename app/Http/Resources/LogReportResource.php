<?php

namespace App\Http\Resources;

use App\Models\CategoryProject;
use Illuminate\Http\Resources\Json\JsonResource;

class LogReportResource extends JsonResource
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
            'id' => $this->id,
            'category_project' => CategoryProjectResource::make($this->categoryProject),
            'date'     => $this->date,
            'hours'    => $this->hours
        ];
    }
}
