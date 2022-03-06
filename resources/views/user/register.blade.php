@extends('app')
@section('content')
<div class="row">
    <div class="col-md-6">
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
        <form action="{{ route('register.action') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Name <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" />
            </div>
            <div class="mb-3">
                <label>Username <span class="text-danger">*</span></label>
                <input class="form-control" type="username" name="username" value="{{ old('username') }}" />
            </div>
            <div class="mb-3">
                <label>Password <span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="password" />
            </div>
            <div class="mb-3">
                <label>Password Confirmation<span class="text-danger">*</span></label>
                <input class="form-control" type="password" name="password_confirm" />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary">Register</button>
                <a class="btn btn-danger" href="{{ route('home') }}">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection