var Objects = {
	init: function(data) {
		var map = {
			img: new Objects.jobs.Image(data.graphics,0,0,1665,208),
			x:0,
			y:0,
			w:4995,
			h:624
		};
		var bird = new Objects.jobs.Bird(data.graphics,100,200,48,48);
		var wall = [[0,579,4320,48],
					[0,0,4320,-3],
					[294,0,48,192],
					[294,327,48,297],
					[663,0,48,264],
					[663,435,48,189],
					[1041,0,48,156],
					[1041,315,48,309],
					[1422,0,48,246],
					[1422,435,48,189],
					[1845,0,48,249],
					[1845,402,48,222],
					[2136,0,48,195],
					[2136,333,48,291],
					[2376,0,48,297],
					[2376,480,48,144],
					[2568,0,48,216],
					[2568,351,48,273],
					[2883,0,48,252],
					[2883,447,48,177],
					[3177,0,48,165],
					[3177,306,48,318],
					[3453,0,48,282],
					[3453,468,48,156],
					[3780,0,48,165],
					[3780,303,48,321],
					[3894,0,48,189],
					[3894,327,48,246]];
		data.objects = {};
		data.objects.map = map;
		data.objects.bird = bird;		
		data.objects.wallTable = [];		
		
		wall.forEach(function(z) {
			data.objects.wallTable.push(new Objects.jobs.Wall(z[0],z[1],z[2],z[3]));
		});
	},
	jobs: {
		Image: function(img,x,y,w,h) {
			this.img=img;
			this.x=x;
			this.y=y;
			this.w=w;
			this.h=h;
		},
		Bird: function(img, x, y, w, h) {
			this.state = {
				jump: {
					move: function(data) {  
						bird.g -= 0.2;
						bird.y+=bird.g;
						for(var i = 0; i<data.objects.wallTable.length; i++) {
							data.objects.wallTable[i].x -= data.tour;
						}
					},
					animation: function(data) {
					}
				},
				fly: {
					move: function(data) {  
						for(var i = 0; i<data.objects.wallTable.length; i++) {
							data.objects.wallTable[i].x -= data.tour;
						}
					},
					animation: function(data) {
						if(data.frame % 5 === 0) {
							bird.img = bird.animation.fly.frame[bird.animation.fly.currentFrame];
							bird.animation.fly.currentFrame++;
							
							if(bird.animation.fly.currentFrame > 1) {
								bird.animation.fly.currentFrame = 0;
							}								
						}
					}
				}
			};
			var bird=this;
			this.x =x;
			this.y =y;
			this.w =w;
			this.h =h;
			this.g = 1;
			this.img= new Objects.jobs.Image(img, 0, 10, 16, 16);
			this.currentState = this.state.fly;
			this.animation = {
				fly: {
					frame: [new Objects.jobs.Image(img,0,209,16,16),new Objects.jobs.Image(img,17,209,16,16)],
					currentFrame: 0
				}
			};
		},
		Wall: function(x,y,w,h) {
			this.x =x;
			this.y = y;
			this.w = w;
			this.h = h;
			this.typ = "wall";
		}
	}
}