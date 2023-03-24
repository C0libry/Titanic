@extends('layout')

@section('head')
  <title>User</title>
@endsection

@section('main_content')
  <section class="vh-100" style="background-color: #eee;">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">ID</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->id }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->name }} {{ Auth::user()->surname }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->username }}</p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
              </div>
            </div>
          </div>
        </div>
        <a class="d-flex justify-content-center ml-4 btn btn-primary btn-lg" href="{{ route('edit_user_data_page', Auth::user()->id) }}">Edit</a>
      </div>
    </div>
  </section>
@endsection