<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Scissors Paper Stone</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="/src/games/scissors/reset.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css">
	    <link rel="stylesheet" href="/src/games/scissors/style.css">
    </head>
	<body>
		<main>
			<h1>Scissors Paper Stone</h1>
			<section class="score-wrapper">
				<p class="score"><span id="player-name"></span> <span id="player-score">0</span></p>
				<p class="score">Computer: <span id="computer-score">0</span></p>
			</section>
			<p id="winner" class="winner"></p>
			<section class="button-wrapper">
				<button id="start">Start</button>
				<button id="scissors"><i class="fas fa-hand-scissors"></i></button>
				<button id="paper"><i class="fas fa-hand-paper"></i></button>
				<button id="stone"><i class="fas fa-hand-rock"></i></button>
			</section>
		</main>	
		<script type="text/javascript" src="/src/games/scissors/script.js"></script>
	</body>
</html>
