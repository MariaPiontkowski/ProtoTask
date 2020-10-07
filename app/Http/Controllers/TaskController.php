<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        return view('task.create', ['project' => $request->get('project')]);
    }

    /**
     * Store or update a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
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

            $values = $request->except('_token', 'id');
            $values['finished'] = $request->has('finished');

            $task = Task::query()->updateOrCreate(['id' => $request->get('id')], $values);

            return redirect(route('project.show', $task->project->id))->with('success', 'Atividade atualizada com sucesso');

        }catch (\Error $e){
            return redirect(route('project.show', $task->project->id))->with('error', 'Não foi possível atualizar a atividade');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('task.edit', ['task' => Task::query()->find($id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        try {
            if ($task = Task::query()->find($id))
                $task->setAttribute('finished', (bool)$request->get('finished'))->save();
        } catch (\Exception $e) {}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        try{
            Task::query()->find($id)->delete();
            return redirect()->back()->with('success', 'Atividade excluído com sucesso');
        }catch (\Error $e){
            return redirect()->back()->with('error', 'Não foi possível realizar a atividade');
        }
    }
}
