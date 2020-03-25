var Physics = {
	update: function(data) {
		Physics.jobs.Gravity(data.objects.bird);
		Physics.jobs.Detection(data);
	},
	jobs: {
		Gravity: function(object) {
			object.currentState = object.state.fly;
			object.g+=0.1;
			object.y+=object.g;
		},
		Detection: function(data) {
			var bird = data.objects.bird			
			data.objects.wallTable.forEach(function(object) {
				
				if(bird.x<object.x+object.w && bird.x + bird.w > object.x && bird.y<object.y+object.h && bird.y+bird.h>object.y) {
					Physics.jobs.Collision(data);
				}
			});
		},
		Collision: function(data) {
			Render.jobs.final(data);
			Engine.stop(data);
		}
	}
}