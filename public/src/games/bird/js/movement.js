var Movement = {
	update: function(data) {
		Movement.bird(data);
	},
	
	bird: function(data) {
		data.objects.bird.currentState.move(data);
	}
}