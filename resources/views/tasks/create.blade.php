@extends('layouts.app')

@section('task', 'active')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new task</div>

                <div class="card-body">
                    <form action="{{ route('tasks.store') }}" method="post">
                    @csrf
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" class="form-control{{ $errors->has('statusName') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <label for="description">Description:</label>
                        <div class="input-group mb-1">
                            <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="AssignTo">Assign to</label>
                            </div>
                            <select class="custom-select" id="AssignTo" name="AssignedTo">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == Auth::id() ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                          </select>
                        </div>
                        <div class="d-flex justify-content-center"><button type="submit" class="btn btn-outline-success">Create</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
