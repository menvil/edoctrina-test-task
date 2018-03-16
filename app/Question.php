<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $table = 'questions';
	protected $fillable = ['name', 'test_id'];


	public function answers()
	{
		return $this->hasMany('App\Answer', 'question_id');
	}

	public function test()
	{
		return $this->belongsTo('App\Test');
	}


}
