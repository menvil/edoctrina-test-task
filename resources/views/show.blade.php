@extends('layouts.master')
@section('content')
	<form method="POST" action="{{route('tests.update', ['test'=>$test])}}">
		{!! csrf_field() !!}
		{{ method_field('PUT') }}
		@foreach ($test->questions()->get() as $question)
			<div class="row">
				<div class="col-md-2"><h4>{{$question->name}}</h4></div>
				<div class="col-md-8" data-toggle="buttons">
					@foreach($question->answers()->get() as $answer)
						<label class="btn btn-default rounded">
							<input class="form-check-input" type="radio" data-question="question[{{$answer->question_id}}]" id="answer_{{$answer->id}}" value="{{$answer->id}}" name="answers[{{$answer->question_id}}]" autocomplete="off"> {{$answer->title}}
						</label>
					@endforeach
				</div>
			</div>
		@endforeach
		<div class="form-group">
			<input type="submit" class="btn btn-success hidden center-block" value="Finish Quiz" />
		</div>
	</form>
@stop
<script>
	window.onload = function() {
		var socket = io('{{config("socket.node_server_host")}}:{{config("socket.node_server_port")}}');
		$('input[type="radio"]').on('click', function (e) {
			if($(this).hasClass("checked")){
				$(this).parent().removeClass("active");
				$(this).removeClass("checked");
				$('[data-question="'+$(this).attr('data-question')+'"]').prop('checked', false);
			} else {
				$(this).parent().addClass("active");
				$('[data-question="'+$(this).attr('data-question')+'"]').not($(this)).parent().removeClass("active");
				$('[data-question="'+$(this).attr('data-question')+'"]').removeClass("checked");
				$(this).addClass("checked");
			}

			if($("input:radio:checked").length === {{$test->questions()->count()}}){
				$('input:submit').removeClass("hidden");
			} else {
				$('input:submit').addClass("hidden");
			}

			socket.emit('change', JSON.stringify({quiz: {{$test->id}}, data:$('input[id^=answer_]:radio').map(function(i, v){ return {id: v.id, checked:v.checked}; }).get()}));
		});

		$('input:submit').on('click', function (e) {
			e.preventDefault();
			socket.emit('finish', JSON.stringify({quiz: {{$test->id}} }));
			socket.close();
			$('form:first').submit();
		});

		socket.on("quiz-channel{{$test->id}}:change", function(message){

			$('label').removeClass("active");
			$('input:radio').removeClass("checked");
			$('input:radio').prop('checked', false);
			let elements = JSON.parse(message);
			elements.forEach(function(el) {
				if(el.checked === true) {
					$('#'+el.id).parent().addClass("active");
					$('#'+el.id).addClass("checked");
					$('#'+el.id).prop('checked', true);
				}
			});

			if($("input:radio:checked").length === {{$test->questions()->count()}}){
				$('input:submit').removeClass("hidden");
			} else {
				$('input:submit').addClass("hidden");
			}

		});

		socket.on("quiz-channel{{$test->id}}:finish", function(message){
			socket.close();
			$(window).on("change", function(e) {
				e.preventDefault();
			});
			window.setTimeout( function(){
				window.location.replace("{{ route('tests.index')}}");
			}, 300 );
		});

	}
</script>

