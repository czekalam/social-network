var startButton = document.getElementById('start');
var scissorsButton = document.getElementById('scissors');
var paperButton = document.getElementById('paper');
var stoneButton = document.getElementById('stone');
var playerScore = document.getElementById('player-score');
var computerScore = document.getElementById('computer-score');
var playerName = document.getElementById('player-name');
var winner = document.getElementById('winner');
var scoreWrappers = document.getElementsByClassName('score');

var player= {
	score: 0,
	name: ''
},
computer= {
	score: 0
};

hideChoiceButtons();
scoreWrappers[0].style.display='none';
scoreWrappers[1].style.display='none';

startButton.addEventListener('click',function() {
	winner.innerHTML='';
	startButton.style.display='none';
	if(player.name==='') {
		player.name = prompt('Tell me your name');
		playerName.innerText = player.name+":";
		scoreWrappers[0].style.display='inline-block';
		scoreWrappers[1].style.display='inline-block';
	}
	showChoiceButtons();
});
scissorsButton.addEventListener('click',function() {
	play('scissors');
});
paperButton.addEventListener('click',function() {
	play('paper');
});
stoneButton.addEventListener('click',function() {
	play('stone');
});
function play(playerChoice) {
	var computerChoice = generateComputerChoice();
	compareChoices(playerChoice,computerChoice);
	checkWinner();
}
function generateComputerChoice() {
	var number = Math.floor(Math.random()*3);
	switch(number){
		case 0:
			return 'scissors';
			break;
		case 1:
			return 'paper';
			break;
		case 2:
			return 'stone';
			break;
		default:
			return 0;
	}
}
function compareChoices(playerChoice,computerChoice) {
	if(computerChoice === playerChoice) {
		return 0;
	}
	else if((computerChoice === 'scissors' && playerChoice === 'paper') || 
		(computerChoice === 'paper' && playerChoice === 'stone') || 
		(computerChoice === 'stone' && playerChoice === 'scissors')) {
		computer.score++;
	}
	else {
		player.score++;
	}
	printScores();
}
function printScores() {
	playerScore.innerHTML=player.score;
	computerScore.innerHTML=computer.score;
}
function checkWinner(){
	if(player.score===10) {
		winner.innerHTML=player.name+' won';
		setInitialValues();
	}
	else if(computer.score===10) {
		winner.innerHTML='Computer won';
		setInitialValues()
	}
}
function setInitialValues() {
	player.score=0;
	computer.score=0;
	hideChoiceButtons();
	startButton.style.display='inline-block';
}
function hideChoiceButtons() {
	paperButton.style.display='none';
	stoneButton.style.display='none';
	scissorsButton.style.display='none';
}
function showChoiceButtons() {
	paperButton.style.display='inline-block';
	stoneButton.style.display='inline-block';
	scissorsButton.style.display='inline-block';
}