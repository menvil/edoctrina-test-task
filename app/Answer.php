<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $table = 'answers';
	protected $fillable = ['question_id', 'title','correct'];

	public function question()
	{
		return $this->belongsTo('App\Question');
	}

	public function results()
	{
		return $this->hasOne('App\Result');
	}


}
