<?php

namespace App\Http\Controllers;

use App\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    private function slug($title)
    {
        $cleanText = "";

        // Match Emoticons
        $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
        $cleanText = preg_replace($regexEmoticons, '', $title);

        // Match Miscellaneous Symbols and Pictographs
        $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
        $cleanText = preg_replace($regexSymbols, '', $cleanText);

        // Match Transport And Map Symbols
        $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
        $cleanText = preg_replace($regexTransport, '', $cleanText);

        return preg_replace('/[\\\\\/\s]+/u', '-', trim($cleanText));
    }

    public function index()
    {
        $newsCategories = NewsCategory::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('backend.news_categories.index', ['newsCategories' => $newsCategories]);
    }

    public function create()
    {
        return view('backend.news_categories.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|unique:news_categories,name|max:191',
        ]);

        // Create new item
        $newsCategory = NewsCategory::create(
            array_merge($request->all(), ['slug' => $this->slug($request->name)])
        );

        return redirect()->route('backend.news_categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $newsCategory = NewsCategory::findOrFail($id);

        return view('backend.news_categories.edit', ['newsCategory' => $newsCategory]);
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'name' => 'required',
        ]);

        $newsCategory = NewsCategory::findOrFail($id);
        $newsCategory->slug = $this->slug($request->name);
        $newsCategory->update($request->all());

        return redirect()->route('backend.news_categories.index');
    }

    public function destroy($id)
    {
        $newsCategory = NewsCategory::findOrFail($id);
        $newsCategory->delete();

        return redirect()->route('backend.news_categories.index');
    }
}
