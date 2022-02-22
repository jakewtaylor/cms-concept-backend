<?php

namespace App\Http\Resources;

use App\Models\Page;
use App\Models\Site;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ContentResource extends JsonResource
{
    protected $site;

    protected $page;

    protected $blocks;

    public function __construct(Site $site, Page $page, Collection $blocks)
    {
        $this->site = $site;
        $this->page = $page;
        $this->blocks = $blocks;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'site' => $this->site,
            'page' => $this->page,
            'blocks' => BlockResource::collection($this->blocks),
        ];
    }
}
