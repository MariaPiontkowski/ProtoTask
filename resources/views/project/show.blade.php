@extends('layout')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('project.index')}}">Projetos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Atividades</li>
@endsection

@section('content')
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 mb-3">
        <h1>Atividades do Projeto {{$project->name}}</h1>

        <a href="{{route('task.create', ['project' => $project->id])}}" class="btn btn-primary font-weight-bold ml-3 mt-2 btn-new">+</a>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    <div class="p-4 dark:bg-gray-800 overflow-hidden ">
        <div class="row">
            @foreach($project->tasks()->orderBy('end_at')->get() as $task)
                <div class="col-md-4">
                    <div class="bg-white p-3 mb-3 shadow sm:rounded-lg">
                        <div class="flex items-center">
                            <div class="text-lg leading-7 font-semibold w-100">
                                <a href="{{route('task.edit', $task->id)}}" class="float-left mr-2 mt-1">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>
                                <a href="{{route('task.edit', $task->id)}}" class="text-gray-900 dark:text-white">
                                    {{$task->name}}
                                </a>
                            </div>
                        </div>
                        <div class="mt-2 mb-2">
                            <input type="checkbox" class="finish" id="finished{{$task->id}}" data-id="{{$task->id}}" @if($task->finished) checked @endif/>
                            <label for="finished{{$task->id}}">Finalizada</label>

                            <div class="float-md-right text-gray-600 dark:text-gray-400 text-sm position-relative">
                                <small class="mr-4"> {{$task->init_at->format('d/m/Y')}}</small>
                                <small class="badge badge-{{ !$task->finished && Carbon\Carbon::today()->gt($task->end_at) ? 'danger' : 'info' }}">
                                    {{$task->end_at->format('d/m/Y')}}
                                </small>
                            </div>
                        </div>

                        <div class="w-100 mt-1">
                            <div class="text-right text-gray-600 delete" data-toggle="modal" data-id="{{$task->id}}" data-target="#deleteModal">
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach()
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Excluir Atividade</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir essa atividade?
                </div>
                <div class="modal-footer">
                    <form method="post">
                        @csrf
                        <input type="hidden" name="_method" value="delete" />
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{asset("js/bootstrap.min.js")}}"></script>
    <script>
        $(function(){
            /** Update the finished attribute of task as true or false **/
            $('.finish').on('change', function(){
                const finished = $(this).is(':checked')

                $.ajax({
                    method: 'post',
                    data: {finished: +finished, _token: '{{csrf_token()}}', _method: 'put'},
                    url: `/task/${$(this).data('id')}`
                })
            })

            const form = $('form')

            $('.delete').on('click', function(){
                form.attr('action', `/task/${$(this).data('id')}`)
            })
        })
    </script>
@endpush
