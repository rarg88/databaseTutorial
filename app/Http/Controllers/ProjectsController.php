<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Events\ProjectCreated;

class ProjectsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        //se puede poner $this->middleware('auth')->only(['store','update']); para pedir auth solo en esos
        //endpoint o $this->middleware('auth')->except(['show']); para pedir auth en todas menos en esas
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // auth()->id() // 4
        // auth()->user() // user
        // auth()->check() // boolean
        
        // if(auth()->guest()) // 
        $projects = auth()->user()->projects; //con esto es mas legible y he creado la funcion projects en el modelo del User

       // $projects = Project::where('owner_id' , auth()->id())->get(); //select * from projects where owner_id=4


        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $attributes = $this->validateProject();

        $attributes['owner_id'] = auth()->id();

        $project = Project::create($attributes);


        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('update',$project);

        return view('projects.show' , compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Project $project)
    {
        
        $project->update($this->validateProject());

        return redirect('/projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/projects');
    }

    protected function validateProject()
    {
        return request()->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'description' =>  ['required', 'min:3']
        ]);
        //Con esto valido aunque modifiquen el HTML
    }

}
