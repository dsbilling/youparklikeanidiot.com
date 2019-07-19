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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Auth::user()->hasRole('write'), 403);
        $page               = Page::find($id);
        $page->title        = $request->get('title');
        $page->content      = $request->get('content');
        $page->slug         = Str::slug($request->get('title'), '');
        $page->editor_id    = Auth::id();
        if ($page->save()) {
            return Redirect::route('page.show', $slug);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_unless(Auth::user()->hasRole('write'), 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        abort_unless(Auth::user()->hasRole('write'), 403);
    }
}
