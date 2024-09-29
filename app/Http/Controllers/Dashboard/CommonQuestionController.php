<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CommonQuestion;
use App\Setting;

class CommonQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!auth()->user()->hasAnyPermission(['questions_index'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $setting = Setting::first();
        $questions = CommonQuestion::latest()->paginate($setting->paginate);
        $questions_count = CommonQuestion::count();
        return view('dashboard.common_questions.index', ['questions' => $questions, 'questions_count' => $questions_count]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(!auth()->user()->hasAnyPermission(['questions_create'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        return view('dashboard.common_questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // if(!auth()->user()->hasAnyPermission(['questions_create'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'status' => ['required'],
        ]);

        $question = new CommonQuestion;
        
        $question->question = $r->question;

        $question->answer = $r->answer;

        $question->status = $r->status;

        $question->save();
        return redirect()->route('dashboard.common_questions.index')->with('success', 'تم اضافة السؤال بنجاح'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if(!auth()->user()->hasAnyPermission(['questions_edite'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $question = CommonQuestion::find($id);
        return view('dashboard.common_questions.edit', ['question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        // if(!auth()->user()->hasAnyPermission(['questions_edite'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $r->validate([
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
            'status' => ['required'],
        ]);

        $question = CommonQuestion::find($id);
        
        $question->question = $r->question;
        $question->answer = $r->answer;
        $question->answer = $r->answer;
        $question->status = $r->status;

        $question->save();
        return redirect()->back()->with('success', 'تم تعديل السؤال بنجاح'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if(!auth()->user()->hasAnyPermission(['questions_delete'])){
        //     return redirect()->back()->with('error', 'عفواً لا تملك الصلاحية');
        // }
        $question = CommonQuestion::find($id);
        $question->delete();
        return redirect()->route('dashboard.common_questions.index')->with('success', 'تم حذف السؤال بنجاح');
    }
}
