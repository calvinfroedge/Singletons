var Singleton = (function()
{
	var instance = false;

	/*
	* Because this is in a closure, it cannot be accessed
	*/
	var member = 'test';

	function Constructor(){
		
		this.getMember = function(){
			return member;
		}

		this.setMember = function(v){
			member = v;
		}

	}

	/*
	* This is what's actually returned by the closure
	*/
	return new function(){
		
		this.getInstance = function() {	

			/*
			* Private member functions are accessible once the constructor has been called
			*/
			if(instance == false){
				instance = new Constructor();
				instance.constructor = null;
			}

			return instance;
		}

	}

}
)();

//print(Singleton.getInstance().getRand());
Singleton.getInstance().setMember('whatuppppp');

print(Singleton.getInstance().getMember());