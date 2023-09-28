@extends('layout')
@section('title', 'Todo List - Atualizar Tarefa')
@section('content')
<h2 class="text-center py-4">@lang('task.edit_task')</h2>


    <form class="text-start row g-3 justify-content-center" method="POST" action="{{ route('tarefa.update',$tarefa->id) }}">
        @method('PUT')
        @csrf
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">@lang('task.title')</label>
                <input type="text" class="form-control" name="titulo" value="{{$tarefa['titulo']}}" placeholder="@lang('task.title')">
            </div>
            <div class="mb-3">
                <label class="form-label">@lang('task.description')</label>
                <textarea class="form-control" name="descricao" placeholder="@lang('task.description')" cols=2 rows=5>{{$tarefa['descricao']}}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">@lang('task.status')</label>
                <select name="concluido" id="" class="form-control">
                    <option value="1" @if($tarefa->concluido == 1) selected @endif>@lang('task.uncompleted')
                    </option>
                    <option value="0" @if($tarefa->concluido == 0) selected @endif>@lang('task.completed')
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">@lang('task.edit')</button>
            </div>
        </div>
    </form>
@endsection