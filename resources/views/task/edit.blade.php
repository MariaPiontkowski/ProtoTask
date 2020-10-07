@extends('layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('project.index')}}">Projetos</a></li>
    <li class="breadcrumb-item"><a href="{{route('project.show', $task->project_id)}}">Atividades</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar Atividade</li>
@endsection

@section('content')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <h1>Editar Atividade</h1>
    </div>
    <div class="pt-5 pb-5 dark:bg-gray-800 overflow-hidden ">
        <form method="post" action="{{route('task.store', ['id' => $task->id])}}">
            @csrf
            <div class="form-group">
                <label for="name">Nome do Projeto</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{old('name', $task->name)}}">
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="init_at">Data de Início</label>
                    <input type="date" max="2999-12-31" class="form-control" id="init_at" name="init_at" required value="{{old('init_at', $task->init_at->format('Y-m-d'))}}">
                </div>

                <div class="col-md-6">
                    <label for="end_at">Data Final</label>
                    <input type="date" max="2999-12-31" class="form-control" id="end_at" name="end_at" required value="{{old('end_at', $task->end_at->format('Y-m-d'))}}">
                </div>
            </div>
            @if($errors->any())
                {!! implode('', $errors->all('<p class="text-danger">:message</div>')) !!}
            @endif
            <button type="submit" class="btn btn-primary">Atualizar</button>
            <a href="{{route('project.show', $task->project_id)}}" class="btn btn-default">Voltar</a>
            <div class="float-right mt-1">
                <input type="checkbox" id="finished" name="finished" @if($task->finished) checked @endif/>
                <label for="finished">Finalizada</label>
            </div>

        </form>
    </div>

@endsection
