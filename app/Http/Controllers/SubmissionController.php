<?php

namespace DPSEI\Http\Controllers;

use Carbon\Carbon;
use DPSEI\Image;
use DPSEI\LicensePlate;
use DPSEI\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class SubmissionController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('submission.index')->withSubmissions(Submission::orderBy('created_at', 'desc')->paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('submission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'country_code' => 'required',
            'licenseplate' => 'required|alpha_num|max:20',
            'description' => 'nullable',
            'latitude' => 'required|between:0,99.99',
            'longitude' => 'required|between:0,99.99',
            'types' => 'required|array',
            'date' => 'required|date_format:Y-m-d|before:today',
            'time' => 'required|date_format:H:i',
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:5120'
        ])->validate();

        $country_code = $request->country_code;
        $registration = $request->licenseplate;
        $lp = LicensePlate::where('registration', $registration)->where('country_code', $country_code)->first();

        if (!$lp) {
            $lp = LicensePlate::create([
                'country_code' => $country_code,
                'registration' => $registration
            ]);
        }

        $datetime = Carbon::parse($request->input('date').' '.$request->input('time'));

        $submission = Submission::create([
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'licenseplate_id' => $lp->id,
            'user_id' => Auth::id(),
            'parked_at' => $datetime,
        ]);
        $submission->types()->attach($request->input('types'));

        foreach ($request->images as $file) {
            $extension = $file->getClientOriginalExtension();
            $fileName = $submission->id."-".time().'-'.rand().".".$extension;
            $folderpath  = 'image/submissions/';
            $file->move($folderpath, $fileName);
            $image = Image::create(['path' => $folderpath.$fileName]);
            $submission->images()->attach($image);
        }

        return Redirect::route('parking.show', $submission->uuid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $submission = Submission::findByUUID($id);
        return view('submission.show', $submission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
