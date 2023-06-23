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
                                    @foreach ($tasks as $element)
                                        <tr class="fw-normal">
                                            <th>
                                                <img class="ms-2"
                                                    src="
                          {{ DB::table('users')->where('users.id', '=', $element->task_to_user_id)->select('users.profile_picture')->get()[0]->profile_picture }}
                              "style="width: 55px; height: auto; border-radius: 50%;">
                                                <span class="ms-2">
                                                    {{ DB::table('users')->where('users.id', '=', $element->task_to_user_id)->select('users.username')->get()[0]->username }}</span>
                                            </th>
                                            <td class="align-middle">
                                                <span>{{ $element->content }}</span>
                                            </td>
                                            <td class="align-middle">
                                                @switch ($element->task_priority)
                                                    @case('High priority')
                                                        <h6 class="mb-0"><span
                                                                class="badge bg-danger">{{ $element->task_priority }}</span></h6>
                                                    @break

                                                    @case('Middle priority')
                                                        <h6 class="mb-0"><span
                                                                class="badge bg-warning">{{ $element->task_priority }}</span></h6>
                                                    @break

                                                    @case('Low priority')
                                                        <h6 class="mb-0"><span
                                                                class="badge bg-success">{{ $element->task_priority }}</span></h6>
                                                    @break

                                                    @default
                                                @endswitch
                                            </td>
                                            <td class="align-middle">
                                                @if ($current_chat->creator_user_id == Auth::user()->id)
                                                    <a href="{{ route('delete_task', $element->id) }}"
                                                        data-mdb-toggle="tooltip" title="Remove" class="icon delete">
                                                        <ion-icon name="trash-outline"></ion-icon>
                                                    </a>
                                                @else
                                                    @if ($element->task_to_user_id == Auth::user()->id)
                                                        <a href="{{ route('done_task', $element->id) }}"
                                                            data-mdb-toggle="tooltip" title="Done" class="icon">
                                                            <ion-icon name="checkmark-done-outline"></ion-icon>
                                                        </a>
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
                            <a href="{{ route('add_task_page', $current_chat->id) }}" class="btn btn-primary">{{ __('task_manager.Add Task') }}</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
