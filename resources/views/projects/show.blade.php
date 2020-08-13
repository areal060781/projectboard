@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-500 text-sm font-normal">
                <a href="/projects" class="text-gray-500 text-sm font-normal no-underline">My Projects</a>
                / {{$project->title}}
            </p>

            <a href="/projects/create" class="button py-2 px-4">Create New Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-8">
                <div class="mb-6">
                    <h2 class="text-lg text-gray-500 font-normal mb-3">Tasks</h2>

                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <form action="{{$task->path()}}" method="post">
                                @method('patch')
                                @csrf
                                <div class="flex">
                                    <input type="text" name="body" id="body" value="{{$task->body}}" class="w-full {{$task->completed ? 'text-gray-500' : ''}}">
                                    <input type="checkbox" name="completed" id="completed" onChange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{$project->path().'/tasks'}}" method="post">
                            @csrf
                            <input type="text" name="body" class="w-full" placeholder="Add a new task...">
                        </form>
                    </div>

                </div>

                <div>
                    <h2 class="text-lg text-gray-500 font-normal mb-3">General Notes</h2>
                    <textarea class="card w-full" style="min-height: 200px">Loremp Ipsum.</textarea>
                </div>
            </div>

            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>


@endsection
