<?php namespace DPSEI\Http\Controllers\API;

use DPSEI\Http\Requests;
use DPSEI\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DPSEI\News;

class APIController extends Controller {

	public function news($amount)
	{
		$news = News::isPublished()->orderby('published_at', 'desc')->get()->take($amount);
		return \Response::json($news);
	}

	

}
