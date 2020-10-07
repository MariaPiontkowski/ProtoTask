<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('project.index', ['projects' => Project::all()->sortBy('end_at')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store or update a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->input(), [
                'init_at'    => 'required|date',
                'end_at'      => 'required|date|after:init_at',
            ]);

            if($validator->fails()){
                return redirect()->back()->withInput($request->input())->withErrors($validator);
            }

            Project::query()->updateOrCreate(['id' => $request->get('id')], $request->except('_token', 'id'));

            return redirect(route('project.index'))->with('success', 'Projeto atualizado com sucesso');

        }catch (\Error $e){
            return redirect(route('project.index'))->with('error', 'Não foi possível atualizar o projeto');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('project.show', ['project' => Project::query()->find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('project.edit', ['project' => Project::query()->find($id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        try{
            Project::query()->find($id)->delete();
            return redirect()->back()->with('success', 'Projeto excluído com sucesso');
        }catch (\Error $e){
            return redirect()->back()->with('error', 'Não foi possível realizar a exclusão');
        }

    }
}
