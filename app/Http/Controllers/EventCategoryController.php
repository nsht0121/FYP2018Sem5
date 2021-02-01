<?php

namespace App\Http\Controllers;

use App\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
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
        $eventCategories = EventCategory::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('backend.event_categories.index', ['eventCategories' => $eventCategories]);
    }

    public function create()
    {
        return view('backend.event_categories.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|unique:event_categories,name|max:191',
        ]);

        // Create new item
        $eventCategory = EventCategory::create(
            array_merge($request->all(), ['slug' => $this->slug($request->name)])
        );

        return redirect()->route('backend.event_categories.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $eventCategory = EventCategory::findOrFail($id);

        return view('backend.event_categories.edit', ['eventCategory' => $eventCategory]);
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'name' => 'required',
        ]);

        $eventCategory = EventCategory::findOrFail($id);
        $eventCategory->slug = $this->slug($request->name);
        $eventCategory->update($request->all());

        return redirect()->route('backend.event_categories.index');
    }

    public function destroy($id)
    {
        $eventCategory = EventCategory::findOrFail($id);
        $eventCategory->delete();

        return redirect()->route('backend.event_categories.index');
    }
}
