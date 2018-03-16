<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
	protected $table = 'tests';
	protected $fillable = ['name'];


	protected static function boot()
	{
		parent::boot();
		static::created(function($test)
		{
			for($i = 1; $i <= (int)request()->count; $i++){
				$question = Question::create([
					'name' => "Question $i",
					'test_id' => $test->id
				]);

				$num = rand(2,5);
				$correct_answer = rand(1,$num);

				for($j=1;$j<=$num;$j++){
					Answer::create([
						'title' => $j,
						'question_id' => $question->id,
						'correct' => ($j === $correct_answer) ? 1 : 0
					]);
				}
			}
		});
	}

	public function questions()
	{
		return $this->hasMany('App\Question', 'test_id');
	}

	public function result()
	{
		return $this->hasMany('App\Result', 'test_id');
	}


	public function correctResults()
	{
		return $this->hasMany('App\Result', 'test_id')->where('correct',1)->count();
	}

}
