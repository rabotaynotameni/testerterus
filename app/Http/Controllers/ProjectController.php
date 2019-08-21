<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();
        $catch = null;
        if ($project->count() == 0) {
            $catch = false;
            return view('project.index',compact('catch'));
        }else {
            $catch = true;
            return view('project.index',compact('catch','project'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|unique:projects',
            'description' => 'required'
        ]);

        Project::create([
            'title' => request('title'),
            'description' => request('description'),
            'slug' => str_slug(request('title'))
        ]);

        return redirect('/project')->with(['successcreate' => 'Data Berhasil Terbuat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        
        return view('project.detail',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        // return view('project.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        Project::where('id',$project->id)
        ->update([
            'title' => request('title'),
            'description' => request('description'),
            'slug' => str_slug(request('title'))
        ]);

        return redirect('/project')->with(['successupdate' => 'Data Berhasil Terupdate']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

            $project->delete();
            $project->tasks()->delete();
            return $this->hapus();

        
    }

    public function hapus(){
        return redirect('/project')->with(['successdel' => 'Data Berhasil Terhapus']);
    }
}
