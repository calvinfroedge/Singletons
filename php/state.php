<?php

//Shows how a singleton can be used to keep state for the duration of a request

class State 
{
	private static $state = null;

	private function __construct(){
	}

	public static function current($state = null){
		if(!is_null($state)) self::$state = $state;

		return self::$state;
	}
}

class A
{
	public $state;

	public function __construct(){
		$this->state = State::current('active');
	}

	public function __toString(){
		return $this->state;
	}
}

class B
{
	public function __construct(){
	}

	public function __toString(){
		return State::current();
	}
}

//Class A sets the state to 'active'
$a = new A;
echo "Current state after being set by class A: $a \n \n";

//Class B simply returns the state set by class A
$b = new B;
echo "Current state after being returned by class B: $b \n \n";
