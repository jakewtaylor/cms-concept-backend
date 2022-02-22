<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentRequest;
use App\Http\Resources\ContentResource;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ContentRequest $request)
    {
        $site = $request->getSite();
        $page = $request->getPage();
        $blocks = $request->getBlocks();

        return ContentResource::make($site, $page, $blocks);
    }
}
