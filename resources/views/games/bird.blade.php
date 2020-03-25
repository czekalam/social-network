<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My bird</title>
        <link rel="stylesheet" type="text/css" href="{{ URL::to('src/games/bird/css/style.css')}}">
    </head>
    <body>
		<main id="container">
			<section id="score"></section>
			<button id="button">try again</button>
			<section id="display">
				<canvas id="bg-canvas" width="912" height="624"></canvas>
				<canvas id="fg-canvas" width="912" height="624"></canvas>
			</section>
        </main>
        <script src="{{ URL::to('src/games/bird/js/objects.js')}}"></script>
        <script src="{{ URL::to('src/games/bird/js/render.js')}}"></script>
        <script src="{{ URL::to('src/games/bird/js/animations.js')}}"></script>
        <script src="{{ URL::to('src/games/bird/js/input.js')}}"></script>
        <script src="{{ URL::to('src/games/bird/js/movement.js')}}"></script>
        <script src="{{ URL::to('src/games/bird/js/physics.js')}}"></script>
        <script src="{{ URL::to('src/games/bird/js/engine.js')}}"></script>
	</body>
