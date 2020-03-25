var Render = {
	init: function(data) {
		data.canvas.display.style.display = 'block';
		data.canvas.btn.style.display = 'none';
	},
	update: function(data) {
		data.canvas.bgCtx.clearRect(0,0, data.canvas.bgCanvas.width, data.canvas.bgCanvas.height);
		Render.jobs.draw(data.objects.map, data.canvas.bgCtx);		
		data.canvas.fgCtx.clearRect(0,0, data.canvas.fgCanvas.width, data.canvas.fgCanvas.height);
		Render.jobs.draw(data.objects.bird, data.canvas.fgCtx);
		Render.jobs.setScore(data);
	},
	jobs: {
		draw: function(obj, coords) {
			coords.drawImage(obj.img.img, obj.img.x, obj.img.y, obj.img.w, obj.img.h, obj.x, obj.y, obj.w, obj.h);
		},
		setScore: function(data) {
			score.innerHTML=data.frame;
		},
		final: function(data) {
			data.canvas.display.style.display = 'none';
			data.canvas.btn.style.display = 'block';
			data.canvas.btn.addEventListener("click", function() {
				Engine.init();
			});
		}
	}
}