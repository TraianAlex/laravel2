<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = array('body', 'article_id');
	
    public function article() {
		return $this->belongsTo('App\Article');
	}
}
