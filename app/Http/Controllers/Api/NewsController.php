<?php

namespace App\Http\Controllers\Api;

use App\News;
use App\NewsCategory;
use App\Http\Controllers\Api\BaseController;

class NewsController extends BaseController
{
    public function getAll()
    {
        $data = News::where('is_hidden', 0)
            ->orderBy('created_at', 'desc')
            ->with('newsCategories')
            ->paginate(10);

        foreach($data as $d) {
            $d->setHidden(['imagepath']);
            $d->content = preg_replace('~[\r\n]+~', '', strip_tags($d->content));
            $d->content = str_replace(array( '\xC2\xA0', '&nbsp;' ), ' ', $d->content);
            $d->content = preg_replace('!\s+!', ' ', strip_tags($d->content));
            $d->content = mb_substr($d->content, 0, 100, 'UTF-8') . '...';
            $d->content = trim($d->content);
            $d->thumbnail = asset($d->thumbnail);
        }
        
        return $this->sendResponse($data);
    }

    public function getBySlug($slug)
    {
        $data = News::where('slug', $slug)->get();
        $data->imagepath = asset($d->imagepath);

        if($data->isEmpty()) {
            return $this->sendError("News not found.");
        } else {
            return $this->sendResponse($data);
        }
    }

    public function getByCategory($category) {
        $data = NewsCategory::where('slug', $category)->first();

        if(!$data) {
            return $this->sendError("Category not found.");
        } else {
            $data = $data->news()->orderBy('updated_at', 'desc')->paginate(5);
            $data->makeHidden('content');
        }

        if($data->isEmpty()) {
            return $this->sendError("News not found.");
        } else {
            return $this->sendResponse($data);
        }
    }
}
