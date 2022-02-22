<?php

namespace App\Http\Requests;

use App\Enum\BlockType;
use App\Models\Block;
use App\Models\Organization;
use App\Models\Page;
use App\Models\Site;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Enum;

class ContentRequest extends FormRequest
{
    protected $siteModel = null;
    protected $pageModel = null;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'site' => 'string|required',
            'page' => 'string|required',
            'blocks' => 'array',
            'blocks.*.id' => 'string|required',
            'blocks.*.type' => ['required', new Enum(BlockType::class)],
        ];
    }

    public function getSite(): Site
    {
        if (!$this->siteModel) {
            $this->siteModel = Site::firstOrCreate([
                'key' => $this->input('site'),
                'organization_id' => $this->organization->id,
            ]);
        }

        return $this->siteModel;
    }

    public function getPage(): Page
    {
        if (!$this->pageModel) {
            $this->pageModel = Page::firstOrCreate([
                'key' => $this->input('page'),
                'site_id' => $this->getSite()->id,
            ]);
        }

        return $this->pageModel;
    }

    public function getBlocks(): Collection
    {
        return collect($this->input('blocks'))->map(function ($block) {
            return Block::firstOrCreate([
                'site_id' => $this->getSite()->id,
                'key' => $block['id'],
                'type' => $block['type'],
            ]);
        });
    }
}
