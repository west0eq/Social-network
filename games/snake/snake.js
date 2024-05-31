//document.addEventListener("DOMContentLoaded", ready);
//для поля
var blockSize = 25;
var rows = 20;
var cols = 30;
var board;
var context;
// для змейки
var snakeX;
var snakeY;

var vX = 0;
var vY = 0;

var snakeBody = [];

// еда
var foodX;
var foodY;

var score = 0;

var gameOver = false;


window.onload = function(){
    board = document.getElementById("board");
    board.height = rows * blockSize;
    board.width  = cols * blockSize;

    context = board.getContext("2d");

    placefood();
    placeSnake();
    
    document.addEventListener("keyup", changeDirection);

    setInterval(update, 110
    );
}

function changeDirection(event){
 if(event.code == "KeyW" && vY !=1){
    vX = 0;
    vY = -1;
 }

 else if(event.code == "KeyS" && vY != -1){
    vX = 0;
    vY = 1;
 }

 else if(event.code == "KeyA" && vX !=1){
    vX = -1;
    vY = 0;
 }

 else if(event.code == "KeyD" && vX != -1){
    vX = 1;
    vY = 0;
 }
}

function placefood(){
    foodX = Math.floor(Math.random() * cols) * blockSize;
    foodY = Math.floor(Math.random() * rows) * blockSize;
}
function placeSnake(){
    snakeX = Math.floor(Math.random() * cols) * blockSize;
    snakeY = Math.floor(Math.random() * rows) * blockSize;
 
}



function update(){

    if(gameOver){
        resetGame();
    }
    context.fillStyle = "black";
    context.fillRect(0,0, board.width, board.height);

    context.fillStyle = "red";
    context.fillRect(foodX,foodY,blockSize,blockSize);

    if(snakeX == foodX && snakeY == foodY){
        snakeBody.push([foodX,foodY]);
        score +=1;
        placefood();
    }

    for(let i = snakeBody.length -1; i>0; i--){
        snakeBody[i] = snakeBody[i-1];

    }

    if(snakeBody.length){
        snakeBody[0] = [snakeX,snakeY];
    }

    context.fillStyle="lightblue";
    context.font = "20px sans-serif";
    context.fillText(score,10,25);


    context.fillStyle ="lime";
    snakeX += vX * blockSize;
    snakeY += vY * blockSize;
    context.fillRect(snakeX, snakeY, blockSize, blockSize);

    for(let i = 0; i<snakeBody.length; i++){
        context.fillRect(snakeBody[i][0], snakeBody[i][1], blockSize, blockSize);
    }

    if(snakeX <0 || snakeX > cols*blockSize -25 || snakeY <0 || snakeY > rows*blockSize -25){
        gameOver = true;
        alert("Игра завершена! Ваш счет : " + String(score) + "\n Нажмите кнопку для перезапуска игры");
    }

    for(let i = 0; i<snakeBody.length; i++){
        if(snakeX == snakeBody[i][0] && snakeY == snakeBody[i][1]){
            gameOver = true;
            alert("Игра завершена! Ваш счет : " + String(score) + "\n Нажмите кнопку для перезапуска игры")
        }
    }
}
function resetGame(){
    gameOver = false;
    placeSnake();
    placefood();
    vX = 0;
    vY = 0;
    snakeBody = [];
    score = 0;
}
