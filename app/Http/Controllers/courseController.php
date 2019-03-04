<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use App\Programme;
use App\Timetable;
use App\Course;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class courseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return view('users.course', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('users.course');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $rules=[
            'title'=>'required|string',
            'code'=>'required|string',
            'lecturer'=>'required|string'
        ];

            $status='added';
        $validator=Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect('course/create')
            ->withErrors($validator)
            ->withInput();
        }else{

            $course = new Course;
            
            $course->coursetitle=$request->input('title');
            $course->coursecode=$request->input('code');
            $course->lecturer=$request->input('lecturer');
            $course->programme_id=Programme::all()->last()->id;

            if($course->save()){
                session()->flash('status', 'course '.$status.'d successfully');
                return redirect(route('course.create'));
            }else{
                $session()->flash('status', 'Unable to '.$status.'d successfully');
                return back()->withInput();
            }

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        //
    }
}
