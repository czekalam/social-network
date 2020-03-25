var Engine = {
	init: function() {
		var bgCanvas = document.getElementById('bg-canvas');
		var fgCanvas = document.getElementById("fg-canvas");
		var score = document.getElementById('score');
		var container = document.getElementById('container');
		var display = document.getElementById('display');
		var btn = document.getElementById("button");
		
		var canvas = {
			score: score,
			container: container,
			bgCanvas: bgCanvas,
			fgCanvas: fgCanvas,
			display: display,
			btn: btn,
			bgCtx: bgCanvas.getContext("2d"),
			fgCtx: fgCanvas.getContext("2d")
		};

		var graphics = new Image();
		graphics.src="/src/games/bird/img/sheet.png";
		
		var data = {
			frame:0,
			tour: 1,
			canvas: canvas,
			graphics: graphics,
			stop:false
		};
		Render.init(data);
		Input.init(data);
		Objects.init(data);
		Engine.start(data);
	},
	start: function(data) {
		stop=false;
		var loop = function() {
			Engine.update(data);
			data.frame++;
			if(stop) return;
			window.requestAnimationFrame(loop);
		};
		loop();
	},
	stop: function (data) {
		stop=true;
	},
	update: function(data) {
		Input.update(data);
		Movement.update(data);
		Animations.update(data);
		Physics.update(data);
		Render.update(data);
	}
};
window.onload = Engine.init();