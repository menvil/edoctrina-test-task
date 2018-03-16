@extends('layouts.master')
@section('content')
    <h3>Create New Quiz</h3>
    <hr/>
    <div class="contaier col-xs-8">
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br/>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ route('tests.store') }}">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="name">Quiz Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
            </div>
            <div class="form-group">
                <label for="name">Questions Count</label>
                <input type="text" name="count" class="form-control" value="{{ old('count') }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" value="Create" />
                <a href="{{ route('tests.index') }}" class="btn btn-info" role="button">Cancel</a>
            </div>
        </form>
    </div>

@stop

