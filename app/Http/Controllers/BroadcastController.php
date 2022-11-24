<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\OrderShipmentStatusUpdated;

class BroadcastController extends Controller
{
	public function __invoke($id)
	{
		OrderShipmentStatusUpdated::dispatch($id);
    }
}
