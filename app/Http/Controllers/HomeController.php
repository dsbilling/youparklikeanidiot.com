<?php namespace DPSEI\Http\Controllers;

use DPSEI\Page;
use DPSEI\News;

class HomeController extends Controller {

	public function index()
	{
		$news = News::isPublished()->get()->take(3);
		$pagesinmenu = Page::where('active', '=', 1)->where('showinmenu', '=', 1)->get(); // This needs to be included in all the frontend pages
		return view('home')
				  ->withNews($news)
					->with('pagesinmenu', $pagesinmenu);
	}

}
