<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MilkshakeController extends Controller
{
    public function index($flavor = null) {
		
		$availableFlavors = array('banana', 'strawberry', 'chocolate');

		if ($flavor === null) dd($availableFlavors);

		if (in_array($flavor, $availableFlavors)) {
			return 'We got flavor: '.$flavor;
		} else {
			return 'We dont have that flavor. Sorry!';
		}

	}
}
