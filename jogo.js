let box = document.getElementById("palavra");
let vida = document.getElementById("vidas");
box.style.position = "absolute"; 
let intVida = 50;
let posx= 10;
let posy= 100;
let speed= 5;
let speeda = true;
let speedb = true;
let speedc = true;
let speede = true;
let speedf = true;
let pergunta;
let start = true;
let intPontos = 0;
let tempo = 0;
let pontos = document.getElementById("pontos");
let palavraCaixa = document.getElementById("palavra");
let somCorrect = new Audio("sound/Correct.wav");
let palavras = [
  "abelha","academia","acender","aceitar","achar",
  "acordo","acucar","adivinha","aguia","alegria","amarelo","amigo","amor",
  "andar","anel","animal","antena","antigo","apagar","aparelho","aprender","arara",
  "areia","arma","arrumar","arte","assunto","atitude","avancar","azedo","azul","bala",
  "banana","barco","barulho","bebida","beijo","beleza","biscoito","bloco","bola",
  "bolacha","bolo","bomba","bonito","borboleta","braço","branco","brilho","cabelo",
  "cafe","caixa","caminho","camisa","caneta","canto","carro","carta","casaco","casamento",
  "castelo","cavalo","celebrar","celular","cereja","ceu","chuva","cinema","circulo","cidade",
  "claro","clima","cobra","coco","codigo","colar","comida","computador","conta","controle",
  "copo","coragem","corda","corredor","coracao","corpo","corrida","corte","crianca","cristal",
  "cuidado","culpa","curioso","danca","dedo","dente","desafio","desenho","deserto","destino",
  "detalhe","dia","doce","dor","duelo","eco","educacao","efeito","energia",
  "enigma","entrada", "escada","escola","escrita","escuro","espada","espelho","esporte",
  "estrela","estudo","exemplo","experiencia","faca","familia","fantasia","farol","feira","festa",
  "figura","filme","foco","fogo","folha","fome","fonte","forma","forte","foto",
  "frase","fruta","fumaca","funcao","galo","garrafa","gato","gelado","gelo","girassol",
  "giz","globo","goiaba","gota","grama","vietna","goiabinha","ameixa-seca","tupi","ferro",
  "pau","vulcao","ovo","vina","penal",
  "amarelo","sorte","virgem","pecado","loiras"
];

function StartGame(){
    if(start){
        document.getElementById("palavra-atual").textContent = 
        palavras[Math.floor(Math.random() * palavras.length)];

        document.getElementById("palavra").textContent = 
        document.getElementById("palavra-atual").textContent;
        mover();
        start = false;
    }
    setInterval(() => {
        tempo++;
        console.log("Tempo:", tempo);
    }, 1000); 
 
}

function mover() {    
    
    document.getElementById("tempo").textContent = tempo;

    let resposta = document.getElementById("entrada-palavra").value;
    let palavraAtual = document.getElementById("palavra-atual");
    pergunta = palavraAtual.textContent;
    posx += speed;
    box.style.left = posx + "px";
    console.log(tempo);
    console.log(speed);

    requestAnimationFrame(mover); 

    if(posx + 100 >= window.innerWidth){
        intVida -= 1;
        vidas.textContent = intVida;
        posx = 10;
        box.style.left = "10px";
    }
    if(intVida <= 0){
        endGame();
        console.log(teste);
    }
    if(resposta == pergunta){
         Correct();
    }
    
}

function Correct(){
    document.getElementById("palavra-atual").textContent = 
    palavras[Math.floor(Math.random() * palavras.length)];
    document.getElementById("palavra").textContent = document.getElementById("palavra-atual").textContent;
    if(tempo <= 10){
        intPontos += 1;
    }
    if(tempo > 10 && tempo <= 20){
        intPontos = intPontos + 2;
        if(speeda){
            speed = speed + 2;
        }
        speeda = false;
    }
     if(tempo > 20 && tempo <= 30){
        intPontos = intPontos + 4;
        if(speedb){
            speed = speed + 3;
        }
        speedb = false;
    }
     if(tempo > 30 && tempo <= 40){
        intPontos = intPontos + 6;
        if(speedc){
            speed = speed + 4;
        }
        speedc = false;
    }
    
     if(tempo > 40 && tempo <= 50){
        intPontos = intPontos + 8;
        if(speede){
            speed = speed + 5;
        }
        speede  = false;
    }
    if(tempo > 50){
        intPontos = intPontos + 10;
        if(speedf){
            speed = speed + 5;
        }
        speedf = false;
    }
    pontos.textContent = intPontos;
    posx = 10;
    box.style.left = "10px";
    document.getElementById("entrada-palavra").value = '';
    somCorrect.play();
}

function endGame(){
    window.location.href = "jogo.php";
}

function Objeto(){

}