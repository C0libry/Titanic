@extends('layout')

@section('head')
    <title>Add task page</title>
@endsection

@section('main_content')
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">{{ __('task_manager.Create Task') }}</p>

                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4 error" :errors="$errors" />

                                    <form class="mx-1 mx-md-4" method="POST"
                                        action="{{ route('task.store', $current_chat_id, Auth::user()->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="username" class="form-control block mt-1 w-full" type="text"
                                                    name="username" :value="old('username')" required autofocus />
                                                <label class="form-label">{{ __('task_manager.Team Member Username') }}</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input id="Task" class="form-control block mt-1 w-full" type="text"
                                                    name="Task" :value="old('Task')" required autofocus />
                                                <label class="form-label">{{ __('task_manager.Task') }}</label>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <label for="country" class="form-label">{{ __('task_manager.Priority') }}</label>
                                            <select class="form-select" id="Priority" name="Priority" required="">
                                                <option value="">{{ __('task_manager.Choose...') }}</option>
                                                <option value="High priority">High priority</option>
                                                <option value="Middle priority">Middle priority</option>
                                                <option value="Low priority">Low priority</option>
                                            </select>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <div class="flex items-center justify-end mt-4">
                                                <button class="ml-4 btn btn-primary btn-lg">
                                                    {{ __('task_manager.Create Task') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
