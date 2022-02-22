<?php

namespace App\Http\Resources;

use App\Enum\BlockType;
use Illuminate\Http\Resources\Json\JsonResource;

class BlockResource extends JsonResource
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
            'id' => $this->key,
            'type' => $this->type,
            'content' => $this->getContent(),
        ];
    }

    protected function getContent()
    {
        if ($this->content) return $this->content;

        return match ($this->type) {
            BlockType::Markdown => '# Markdown',
            default => '',
        };
    }
}
