var Input = {
	init: function(data) {
		document.onkeydown = function(event) {
			Input.pressed= true;
		};
		document.onkeyup = function(event) {			
			Input.pressed=false;
		}
	},
	update: function(data) {
		var bird = data.objects.bird;
		if(Input.pressed) {
			bird.currentState = bird.state.jump;
		}
		else {
			bird.currentState = bird.state.fly;
		}
	},
	pressed: null
};