@extends('layouts.master')
@section('content')

	@if(session('success'))
	<div class="alert alert-success alert-dismissible">
		{{session('success')}}
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	</div>
	@endif

	@if(session('error'))
	<div class="alert alert-danger alert-dismissible">
		{{session('error')}}
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	</div>
	@endif
	@if (count($tests) > 0)
		<a href="{{ route('tests.create') }}" class="btn btn-success" role="button">Create Quiz</a>
		<div class="clearfix">&nbsp;</div>
		<table class="table table-bordered table-striped">
			<thead>
				<th>
					#
				</th>
				<th>
					Name
				</th>
				<th>
					Question count
				</th>
				<th>
					Score
				</th>
			</thead>
			<tbody>
	@endif
	@forelse ($tests as $test)
		<tr>
			<td>
				{{$loop->index+1}}
			</td>
			<td>
				{{$test->name}}
			</td>
			<td>
				{{$test->questions()->count()}}
			</td>
			<td>
				@if($test->result()->count() > 0)
					{{$test->correctResults()}} / {{$test->questions()->count()}} ({{number_format($test->correctResults()*100/$test->questions()->count(), 2)}}%)
				@else
					<a href="{{ route('tests.show', $test->id) }}">Take a Quiz</a>
				@endif
			</td>

		</tr>
	@empty
		<h3>Please <a href="{{ route('tests.create') }}">create your first quiz</a></h3>
	@endforelse
	@if (count($tests) > 0)
		</tbody>
		</table>
	@endif
@stop


