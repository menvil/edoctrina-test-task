<?php

namespace App\Http\Controllers;

use App\Test;
use App\Result;
use Illuminate\Http\Request;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index', ['tests' => Test::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request)
    {
        Test::create(request()->all());
        return redirect()->route('tests.index')->withSuccess('Test has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        if($test->result()->count() > 0 ){
            return redirect()->route('tests.index')->withError('Test was completed');
        }

        return view('show', ['test' => $test]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {

        if($test->result()->count() > 0 ){
            return redirect()->route('tests.index')->withError('Test was completed');
        }

        $answers = request()->get('answers', array());
        $questions = $test->questions()->get();

        foreach($answers as $key=>$answer){
           if($questions->contains('id', $key)){
               $current_question = $questions->find($key)->answers()->pluck('correct','id');
               if(isset($current_question[$answers[$key]]) &&
                   $current_question[$answers[$key]] == 1
               ){
                   Result::create([
                       'test_id'=>$test->id,
                       'question_id'=>$key,
                       'answer_id'=>$answers[$key],
                       'correct' => 1
                   ]);
               } elseif(!isset($current_question[$answers[$key]]) || $current_question[$answers[$key]] == 0){
                   Result::create([
                       'test_id'=>$test->id,
                       'question_id'=>$key,
                       'answer_id'=>$answers[$key],
                       'correct' => 0
                   ]);
               }
           }
        }
        return redirect()->route('tests.index')->withSuccess('Test has been completed');
    }
}
