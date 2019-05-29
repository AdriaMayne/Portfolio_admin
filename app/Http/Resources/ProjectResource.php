<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\TagResource;

class ProjectResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "logo" => $this->logo,
            "mockup" => $this->mockup,
            "visible" => $this->visible,
            "tags" => TagResource::collection($this->tags)
        ];
    }
}
