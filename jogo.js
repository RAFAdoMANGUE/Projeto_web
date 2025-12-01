let box = document.getElementById("palavra");
let vida = document.getElementById("vidas");
box.style.position = "absolute"; 
let intVida = 3;
let posx= 10;
let posy= 100;
let speed= 5;
let teste = 'TESTE';
function mover() {     

    let resposta = document.getElementById("entrada-palavra").value;
    posx += speed;
    box.style.left = posx + "px";
    console.log(resposta);
    requestAnimationFrame(mover); 

    if(posx >= window.innerWidth){
        intVida -= 1;
        vidas.textContent = intVida;
        posx = 10;
        box.style.left = "10px";
    }
    if(intVida <= 0){
        endGame();
        console.log(teste);
    }
    if(resposta == teste){
         endGame();
    }
    
}

function endGame(){
    window.location.href = "jogo.php";
}
