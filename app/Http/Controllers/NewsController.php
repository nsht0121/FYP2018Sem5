<?php

namespace App\Http\Controllers;

use DB;
use App\News;
use App\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{
    private function slug($id, $title)
    {
        $cleanText = "";
        $cleanText = preg_replace('![-?]+!', ' ', trim($title));
        $cleanText = preg_replace('!\s+!', ' ', trim($cleanText));
        return $id . '-' . preg_replace('/[\\\\\/\s]+/u', '-', trim($cleanText));
    }

    public function index()
    {
        $news = News::orderBy('created_at', 'desc')
            ->paginate(10);

        foreach($news as $n) {
            $n->content = preg_replace('~[\r\n]+~', '', strip_tags($n->content));
            $n->content = str_replace(array( '\xC2\xA0', '&nbsp;' ), ' ', $n->content);
            $n->content = preg_replace('!\s+!', ' ', strip_tags($n->content));
            $n->content = mb_substr($n->content, 0, 150, 'UTF-8') . '...';
            $n->content = trim($n->content);
        }

        return view('backend.news.index', ['news' => $news]);
    }

    public function create()
    {
        $categories = NewsCategory::get()
            ->pluck('name', 'id');
        
        return view('backend.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'title' => 'required|max:191',
            'image' => 'image',
        ]);

        // Checkbox value
        $request->request->add([
            'is_hidden' => $request->has('is_hidden'),
        ]);

        // Store item
        $news = News::create($request->all());

        // Attach category to pivot table if input categories[] is not empty
        if($request->has('categories')) {
            $news->newsCategories()
                ->attach($request->categories);
        }

        // Image
        if($request->has('image')) {
            $ext = $request->file('image')->extension();

            // store image
            $path = $request->file('image')->store('images');
            $news->imagepath = Storage::url($path);

            // store thumbnail
            $path = $request->file('image')->store('thumb');
            $news->thumbnail = Storage::url($path);

            $thumb = Image::make(public_path($news->thumbnail))
                ->fit(320, 240, function($constraint) {
                    $constraint->upsize();
                });
            $thumb->save();
        }

        // Make slug
        $news->slug = $this->slug($news->id, $news->title);
        $news->save();

        return redirect()->route('backend.news.index');
    }

    public function show($slug)
    {
        //
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $categories = NewsCategory::get()
            ->pluck('name', 'id');

        return view('backend.news.edit', compact('categories'), ['news' => $news, 'selectedCategories' => $news->newsCategories]);
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'title' => 'required|max:191',
        ]);

        // Update new item
        $news = News::findOrFail($id);
        $news->slug = $this->slug($id, $request->title);
        $news->is_hidden = $request->has('is_hidden');
        $news->update($request->all());

        // Attach/detach category to/from pivot table
        if(!empty($request->categories)) {
            $news->newsCategories()
                ->sync($request->categories);
        } else {
            $news->newsCategories()
                ->detach();
        }

        return redirect()->route('backend.news.index');
    }

    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('backend.news.index');
    }
}
