<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller
{
    public function getIndex() {
		return 'This is the index page of my portfolio';
	}

	// This only gets executed when we request /portfolio/paintings using GET
	public function getPaintings() {
		return 'This is a list of my paintings';
	}

	public function getMusic() {
		return 'This is a list of my music';
	}

	public function postProcess() {
		return 'The form was succesfully POST-ed!';
	}
}