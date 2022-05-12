<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Job;
use App\Models\JobsUsers;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();
        return response()->json($jobs,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $job = Job::find($request->id);
        return response()->json($job,201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( auth()->user()->role == 'U' ){
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'status' => 'required|integer|min:1',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $job = Job::create($validator->validate());

        return response()->json([
            'message' => '¡Oferta de trabajo creada exitosamente!',
            'job' => $job
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Apply for a job.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function apply(Request $request)
    {
        if( auth()->user()->role == 'A' ){
            return response()->json(['error' => 'Unauthorized.'], 401);
        }

        $job = Job::find($request->id);
        if( !$job ){
            return response()->json(['error' => 'Oferta laboral no encontrada.'],404);
        }

        $apply = JobsUsers::select('id')
                            ->where([
                                ['user_id', '=', auth()->user()->id],
                                ['job_id', '=', $request->id],
                            ])->get();
        
        if( count($apply) != 0 ){
            return response()->json(['error' => 'Ya usted ha aplicado para esta oferta.'],201);
        }

        $jobuser = new JobsUsers();
        $jobuser->user_id = auth()->user()->id;
        $jobuser->job_id = $request->id;

        if( !$jobuser->save() ){
            return response()->json(['error' => 'Hubo un error aplicado a esta oferta.'],500);
        }
        
        $job = Job::find($request->id);

        return response()->json([
            'message' => '¡Aplicó exitosamente a esta oferta laboral!',
            'job' => $job
        ], 201);

    }
}
