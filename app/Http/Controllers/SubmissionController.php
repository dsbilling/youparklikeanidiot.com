<?php

namespace DPSEI\Http\Controllers;

use Carbon\Carbon;
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
        return view('submission.index')->withSubmissions(Submission::orderBy('parked_at', 'desc')->paginate(20));
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
            'licenseplate' => 'required|alpha_num',
            'description' => 'nullable',
            'latitude' => 'required|between:0,99.99',
            'longitude' => 'required|between:0,99.99',
            'types' => 'required|array',
        ])->validate();

        $registration = $request->licenseplate;
        $lp = LicensePlate::where('registration', $registration)->first();

        if(!$lp) {
            $lp = LicensePlate::create(['registration' => $registration]);
        }

        $submission = Submission::create([
            'description' => $request->description,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'license_plate_id' => $lp->id,
            'user_id' => Auth::id(),
            'parked_at' => Carbon::now(),
        ]);
        $submission->types()->attach($request->input('types'));

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
