<?php

namespace DPSEI\Http\Controllers;

use DPSEI\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Redirect::to('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Auth::user()->hasRole('write'), 403);
        return view('page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_unless(Auth::user()->hasRole('write'), 403);

        Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ])->validate();

        $page               = new Page;
        $page->title        = $request->get('title');
        $page->slug         = Str::slug($request->get('title'), '');
        $page->content      = $request->get('content');
        $page->editor_id    = Auth::id();
        $page->author_id    = Auth::id();

        if ($page->save()) {
            return Redirect::route('page.show', $page->slug);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->first();
        abort_unless($page, 404);
        return view('page.show', $page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        abort_unless(Auth::user()->hasRole('write'), 403);
        $page = Page::where('slug', $slug)->first();
        return view('page.edit', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        abort_unless(Auth::user()->hasRole('write'), 403);

        Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ])->validate();
        
        $page               = Page::where('slug', $slug)->first();
        $page->title        = $request->get('title');
        $page->content      = $request->get('content');
        $page->slug         = Str::slug($request->get('title'), '');
        $page->editor_id    = Auth::id();
        if ($page->save()) {
            return Redirect::route('page.show', $slug)->with('message', 'Page updated!')->with('messagetype', 'success');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        abort_unless(Auth::user()->hasRole('write'), 403);
        $page = Page::where('slug', $slug)->first();
        $page->delete();
        return Redirect::route('home')->with('message', 'Page deleted!')->with('messagetype', 'success');
    }
}
