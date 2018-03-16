<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
	protected $table = 'results';
	protected $fillable = ['test_id', 'question_id', 'answer_id', 'correct'];

	public function answer()
	{
		return $this->belongsTo('App\Test');
	}

}
