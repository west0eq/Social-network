// стрелочная функция let func = (a1, a2, ....aN) => follow;
//let func = (a1, a2, ....aN){
//return follow;    
//}
//
let board;
let bWidth = 500;
let bHeight = 500;
let context;

let pWidth = 80;
let pHeight = 10;

let pX = 20;

let player = {
    x:210,
    y:490,
    width: pWidth,
    height: pHeight,
    vX: pX
};

// мячик
let ballWidth = 10;
let ballHeight = 10;
let ballVX = 1;
let ballVY = 1;

let ball = {
    x:250,
    y:250,
    width: ballWidth,
    height: ballHeight,
    vX: ballVX,
    vY: ballVY
};

/// Для препятствий
let blockArray = [];
let blockWidth = 50;
let blockHeight = 10;
let blockColums = 8;
let blockRows = 3;
let blockMaxRows = 10;
let blockCount =0;
let blockX = 15;
let blockY = 45;

//очки и завершение игры
let score = 0;
let gameOver = false;





window.onload = function(){
    board = document.getElementById("board");

    board.height = bHeight;
    board.width = bWidth;

    context = board.getContext("2d");
    context.fillStyle = "black";
    context.fillRect(0,0, board.width, board.height);

    context.fillStyle = "blueviolet";
    context.fillRect(player.x, player.y,player.width, player.height);

    requestAnimationFrame(update);
    document.addEventListener("keydown", movePlayer);

    createBlocks();
}

function createBlocks(){
    blockArray = [];

    for(let c = 0; c < blockColums; c++){
        for(let r = 0; r<blockRows; r++){
            let block = {
                x : blockX + c*blockWidth + c*10,
                y :  blockY + r*blockHeight + r*10,
                width : blockWidth,
                height: blockHeight,

                break : false
            }
            blockArray.push(block);
        }
    }
    blockCount = blockArray.length;
}
function outBoard(xPos){
    return (xPos < 0 || xPos + pWidth > bWidth);
}

function movePlayer(e){
if(gameOver){
    if(e.code == "Space"){
        resetGame();
    }
}

if(e.code == "KeyA"){
    let nextX = player.x - player.vX;
    if(!outBoard(nextX)){
        player.x = nextX;
    }
    }
else if (e.code == "KeyD"){
    let nextX = player.x + player.vX;
    if(!outBoard(nextX)){
        player.x = nextX;
    }
    
}
}

function resetGame(){
    gameOver = false;
    player = {
        x:210,
        y:490,
        width: pWidth,
        height: pHeight,
        vX: pX
    }

    ball = {
        x:250,
        y:250,
        width: ballWidth,
        height: ballHeight,
        vX: ballVX,
        vY: ballVY
    }

    blockArray = [];
    blockRows =3;
    score = 0;
    createBlocks();
}


function update(){
    requestAnimationFrame(update);

    if(gameOver){
        return;
    }

    context.clearRect(0, 0, board.width, board.height);

    context.fillStyle ="black";
    context.fillRect(0,0, board.width, board.height);

    context.fillStyle = "blueviolet";
    context.fillRect(player.x, player.y,player.width, player.height);

    context.fillStyle = "white";

    ball.x += ball.vX;
    ball.y += ball.vY;
    console.log(`Ball position: (${ball.x}, ${ball.y})`);
    context.fillRect(ball.x,ball.y,ball.width,ball.height);

    if(tCollision(ball, player)|| bCollision(ball,player)){
        ball.vY *= -1;
    }
    else if(lCollision(ball,player)|| rCollision(ball,player)){
        ball.vX *= -1;
    }


    if(blockCount == 0){
        blockRows = Math.min(blockRows + 1, blockMaxRows);
        createBlocks();
    }

    //Для препятствий
    context.fillStyle = "orange";
    for(let i = 0; i<blockArray.length; i++){
        let block = blockArray[i];
        if(!block.break){
            if(tCollision(ball,block) || bCollision(ball, block)){
                block.break = true;
                ball.vY *= -1;
                blockCount -= 1;
                score +=1;
            }
            else if(lCollision(ball,block) || rCollision(ball,block)){
                block.break = true;
                ball.vX *= -1;
                blockCount -= 1;
                score += 1;
            }
            context.fillRect(block.x, block.y, block.width, block.height);
        }
    }

    context.fillStyle = "red";
    context.font ="20px sans-serif";
    context.fillText(score,10,25);

//1.Проверка координат на касание нижней границы
//2.Выполнить рестарт по кнопку space, создать функцию рестарта



    if(ball.y <= 0){
        ball.vY *= -1; //change
    }else if(ball.x <= 0 || (ball.x + ball.width >= bWidth)){
        ball.vX *= -1; //change 
    }else if(ball.y + ball.height >= bHeight){
        sendScoreToServer(score);
       //console.log("Game over");
       context.font ="20px sans-serif";
       context.fillText("Game over: Press `Space` to restart", 80 , 400);
       gameOver = true;
       return;

    //    ball.x = 250;
    //    ball.y = 250;
    //    ball.vX = ballVX;
    //    ball.vY = ballVY;
    //    return;
    }

}

function sendScoreToServer(score){
    let formData = new FormData();
    formData.append('score', score);

    fetch('save_score.php', {
        method: 'POST',
        body: formData
    })
    .then(response =>{
        if(!response.ok){
            throw new Error('Сервер выдал ошибку');
        }
        return response.text();
    })
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Выполнить запрос не получилось', error);
    });
}

function Collision(a,b){
    return a.x < b.x + b.width && a.x + a.width > b.x && a.y < b.y + b.height && a.y + a.height > b.y;
}

function tCollision(ball, block){
    return Collision(ball, block) && (ball.y + ball.height) >= block.y;
}
function bCollision(ball, block){
    return Collision(ball, block)&&(block.y + block.height) >= ball.y;
}
function lCollision(ball, block){
    return Collision(ball, block) && (ball.x + ball.width) >= block.x;
}
function rCollision(ball, block){
    return Collision(ball, block) && (block.x + block.width) >= ball.x;
}
