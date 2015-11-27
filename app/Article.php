<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{//extends Eloquent not neccessary
 	// public $title;
	// public $body;

	// public function __construct($title = '', $body = '') {
	// 	$this->title = $title;
	// 	$this->body = $body;
	// }

	protected $fillable = array('title', 'body');

	// override table-naming convention:
	// protected $table = 'notes';

	// disable timestamps in table
	// public $timestamps = false;

	public function comments() {
		return $this->hasMany('App\Comment');
	}
	
	public function dumpInfo() {
		dd($this->title, $this->body);
	}

	public function containsLetter($letter) {
		if (strpos($this->title, $letter) === false) {
			return false;
		}
		return true;
	}

}
