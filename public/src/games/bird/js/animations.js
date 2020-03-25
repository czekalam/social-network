var Animations = {
	update: function(data) {
		Animations.jobs.Map(data);
		Animations.jobs.Bird(data);
	},
	jobs: {
		Map: function(data) {
			data.objects.map.x -=data.tour;
			if(data.objects.map.x < -3900) {
				for(var i = 0; i<data.objects.wallTable.length; i++) {
					data.objects.wallTable[i].x += 3600;
				}
				data.tour++;
				data.objects.map.x = -300;
			}
		},
		Bird: function(data) {
			data.objects.bird.currentState.animation(data);
		}
	}
}  