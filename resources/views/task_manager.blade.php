@extends('layout')

@section('head')
    <title>Task manager</title>
    <link rel="stylesheet" href="{{ asset('css/Task manager.css') }}" />
@endsection

@section('main_content')
    <section class="vh-100" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-12 col-xl-10">

                    <div class="card">
                        <div class="card-header p-3">
                            <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>{{ __('task_manager.Task List') }}</h5>
                        </div>
                        <div class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative; height: 400px">

                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('task_manager.Team Member') }}</th>
                                        <th scope="col">{{ __('task_manager.Task') }}</th>
                                        <th scope="col">{{ __('task_manager.Priority') }}</th>
                                        <th scope="col">{{ __('task_manager.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr class="fw-normal">
                                            <th>
                                                <img class="ms-2"
                                                    src="
                          {{ $task->user->profile_picture }}
                              "style="width: 55px; height: auto; border-radius: 50%;">
                                                <span class="ms-2">
                                                    {{ $task->user->username }}</span>
                                            </th>
                                            <td class="align-middle">
                                                <span>{{ $task->content }}</span>
                                            </td>
                                            <td class="align-middle">
                                                @switch ($task->task_priority)
                                                    @case('High priority')
                                                        <h6 class="mb-0"><span
                                                                class="badge bg-danger">{{ $task->task_priority }}</span></h6>
                                                    @break

                                                    @case('Middle priority')
                                                        <h6 class="mb-0"><span
                                                                class="badge bg-warning">{{ $task->task_priority }}</span></h6>
                                                    @break

                                                    @case('Low priority')
                                                        <h6 class="mb-0"><span
                                                                class="badge bg-success">{{ $task->task_priority }}</span></h6>
                                                    @break

                                                    @default
                                                @endswitch
                                            </td>
                                            <td class="align-middle">
                                                @if ($current_chat->creator_user_id == Auth::user()->id)
                                                    <form method="POST" action="{{ route('task.destroy', $task->id) }}">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="clear-btn">
                                                            <ion-icon name="trash-outline"></ion-icon>
                                                        </button>
                                                    </form>
                                                @else
                                                    @if ($task->task_to_user_id == Auth::user()->id)
                                                        <form method="POST"
                                                            action="{{ route('task.done_task', $task->id) }}">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button class="clear-btn">
                                                                <ion-icon name="checkmark-done-outline"></ion-icon>
                                                            </button>
                                                        </form>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                        <div class="card-footer text-end p-3">
                            <!-- <button class="me-2 btn btn-link">Cancel</button> -->
                            <a href="{{ route('task.create', $current_chat->id) }}"
                                class="btn btn-primary">{{ __('task_manager.Add Task') }}</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
