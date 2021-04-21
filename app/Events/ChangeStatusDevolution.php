<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChangeStatusDevolution
{

 	use Dispatchable, InteractsWithSockets, SerializesModels;
	public $data;
	
	function __construct($data)
	{
		$this->data = $data;
	}
	
}