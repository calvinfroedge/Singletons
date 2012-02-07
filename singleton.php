<?php

//Shows how a singleton can be used to keep state for the duration of a request
class Singleton
{
	private static $instance = 0;

	private static $member = null;

	/*
	 * Private constructor prevents object initialization ith new keyword
	*/
	private function __construct(){}

	/*
	 * Creates an instance - accesed statically since constructor is private
	*/
	public static function instance(){
		if(self::$instance) 
		{
			return self::$instance;
		}

		//Return a new instance if one does not exist
		return new Singleton;
	}

	public function setMember($v){
		self::$member = $v;
	}

	public function getMember(){
		return self::$member;
	}

	/*
	 * Prevents cloning (ie copying the instance or using the clone keyword)
	*/
	public function __clone(){
		trigger_error('Singleton instance cannot be cloned.', E_USER_ERROR);
	}

	/*
	 * Prevents Unserializing of Object
	*/
	public function __wakeup(){
		trigger_error('Singleton instance cannot be unserialized.', E_USER_ERROR);
	}
}

class A
{
	public function __construct(){
		Singleton::instance()->setMember('active');
	}

	public function __toString(){
		return Singleton::instance()->getMember();
	}
}

class B
{
	public function __construct(){
	}

	public function __toString(){
		return Singleton::instance()->getMember();
	}
}

//Class A sets the member's value to 'active'
$a = new A;
echo "Member after being set by class A: $a \n \n";

//Class B simply returns the member value set by class A
$b = new B;
echo "Member after being returned by class B: $b \n \n";
