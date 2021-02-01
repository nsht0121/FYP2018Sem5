<?php

namespace App\Http\Controllers;

use App\User;
use App\News;
use App\NewsCategory;
use App\Event;
use App\EventCategory;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private $paginateSize = 10;

    /***
     * Misc
     */
    public function pageHome() {
        // get latest 5 news
        $news = News::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('site.home', ['news' => $news]);
    }

    public function pageADHD() {
        return view('site.adhd');
    }

    public function pageTest() {
        return view('site.test');
    }

    public function pageAbout() {
        return view('site.about');
    }

    public function pageBackend(Request $request) {
        // get latest 5 user
        $users = User::orderBy('id', 'desc')
            ->take(5)
            ->get();

        // display counter
        $counter['users'] = User::count();
        $counter['events'] = Event::count();
        $counter['posts'] = News::count();

        return view('backend.dashboard', ['users' => $users, 'counter' => $counter]);
    }


    /***
     * News
     */
    public function pageNews() {
        $news = News::where('is_hidden', 0)
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginateSize);
        
        foreach($news as $n) {
            $n->content = preg_replace('~[\r\n]+~', '', strip_tags($n->content));
            $n->content = str_replace(array( '\xC2\xA0', '&nbsp;' ), ' ', $n->content);
            $n->content = preg_replace('!\s+!', ' ', strip_tags($n->content));
            $n->content = mb_substr($n->content, 0, 150, 'UTF-8') . '...';
            $n->content = trim($n->content);
        }

        return view('site.news', ['news' => $news]);
    }

    public function pageNewsCategory($category) {
        // get news that related to this category
        $news = NewsCategory::where('slug', $category)
            ->firstOrFail()
            ->news()
            ->where('is_hidden', 0)
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginateSize);

        foreach($news as $n) {
            $n->content = preg_replace('~[\r\n]+~', '', strip_tags($n->content));
            $n->content = str_replace(array( '\xC2\xA0', '&nbsp;' ), ' ', $n->content);
            $n->content = preg_replace('!\s+!', ' ', strip_tags($n->content));
            $n->content = mb_substr($n->content, 0, 150, 'UTF-8') . '...';
            $n->content = trim($n->content);
        }

        return view('site.news', ['news' => $news]);
    }

    public function pageNewsDetail($slug) {
        // get specific news by 'slug' key
        $news = News::where('slug', $slug)
            ->firstOrFail();

        return view('site.news_detail', ['news' => $news]);
    }


    /***
     * Events
     */
    public function pageEvents() {
        $events = Event::where('is_hidden', 0)
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginateSize);

        return view('site.events', ['events' => $events]);
    }

    public function pageEventCategory($category) {
        // get events that related to this category
        $events = EventCategory::where('slug', $category)
            ->firstOrFail()
            ->events()
            ->where('is_hidden', 0)
            ->orderBy('created_at', 'desc')
            ->paginate($this->paginateSize);

        return view('site.events', ['events' => $events]);
    }

    public function pageEventDetail($slug) {
        // get specific event by 'slug' key
        $event = Event::where('slug', $slug)
            ->firstOrFail();

        return view('site.event_detail', ['event' => $event]);
    }
}
