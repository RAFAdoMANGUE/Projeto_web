let box = document.getElementById("palavra");
let vida = document.getElementById("vidas");
let intPontos = 0;
let tempo = 0;
box.style.position = "absolute"; 
let intVida = 3; 
let gameOver = false;

let boxObjeto = document.getElementById("objetoBomba");
boxObjeto.style.position = "absolute";

let Bomba = {
    posxO : 10,
    posyO : 0,
    speedO : 0.3,
    perguntaO: "",
    palavraCaixaO: "",
    ativo: false,
    spawn: [10,50,100,110,130,160,190,210,240,280,300,340,400,500,550,600,650,700,750,800,850,900,1000],
    respostaO: ""
}

let posx= 10;
let posy= 100;

let speed= 3;
let speeda = true;
let speedb = true;
let speedc = true;
let speede = true;
let speedf = true;

let pergunta;
let start = true;

let pontos = document.getElementById("pontos");
let palavraCaixa = document.getElementById("palavra");

let somCorrect = new Audio("sound/Correct.wav");
let music = new Audio("sound/Music.wav");
let explosion = new Audio("sound/Explosion.wav");

let ultimaPontuacao = 0;

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
  "estrela","estudo","exemplo","experiencia","faca","familia","farol","feira","festa",
  "figura","filme","foco","fogo","folha","fome","fonte","forma","forte","foto",
  "frase","fruta","fumaca","funcao","galo","garrafa","gato","gelado","gelo","girassol",
  "giz","globo","goiaba","gota","grama","vietna","ameixa-seca","tupi","ferro",
  "pau","vulcao","ovo","vina","penal",
  "amarelo","sorte","virgem","pecado","loiras"
];

function StartGame(){
    if(start){
        Bomba.posyO = 0;
        boxObjeto.style.top = Bomba.posyO + "px";

        document.getElementById("palavra-atual").textContent = 
            palavras[Math.floor(Math.random() * palavras.length)];

        document.getElementById("objetoBomba").textContent = 
            palavras[Math.floor(Math.random() * palavras.length)];

        mover();
        music.loop = true;
        music.volume = 0.2;
        music.play();

        start = false;
    }

    setInterval(() => {
        tempo++;
        console.log("Tempo:", tempo);
    }, 1000); 

    setInterval(Objeto, 5000);
}

function mover() { 
    if (gameOver) return;
    
    document.getElementById("tempo").textContent = tempo;

    let resposta = document.getElementById("entrada-palavra").value;
    let palavraAtual = document.getElementById("palavra-atual");
    pergunta = palavraAtual.textContent;

    Bomba.respostaO = document.getElementById("entrada-palavra").value;
    Bomba.perguntaO = document.getElementById("objetoBomba").textContent;

    posx += speed;
    box.style.left = posx + "px";

    if(Bomba.ativo){
        Bomba.posyO += Bomba.speedO;
        boxObjeto.style.top = Bomba.posyO + "px";
    }

    requestAnimationFrame(mover); 

    if(Bomba.posyO + 70 >= window.innerHeight){
        intVida -= 1;
        vida.textContent = intVida;
        Bomba.posyO = 0;
        boxObjeto.style.top = "0px";
        Bomba.ativo = false;
    }

    if(posx + 100 >= window.innerWidth){
        intVida -= 1;
        vida.textContent = intVida;
        posx = 10;
        box.style.left = "10px";
    }

    if (intVida <= 0 && !gameOver) {
        gameOver = true;
        endGame();
        salvarPontos(true);
    }

    if(resposta == pergunta){
         Correct();
    }

    if(resposta == Bomba.perguntaO){
        ObjectCorrect();
    }

}

function Correct(){
    document.getElementById("palavra-atual").textContent = 
        palavras[Math.floor(Math.random() * palavras.length)];

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
            speed = speed + 3;
        }
        speedc = false;
    }
    if(tempo > 40 && tempo <= 50){
        intPontos = intPontos + 8;
        if(speede){
            speed = speed + 1;
        }
        speede  = false;
    }
    if(tempo > 50){
        intPontos = intPontos + 10;
        if(speedf){
            speed = speed + 1;
        }
        speedf = false;
    }
    
    pontos.textContent = intPontos;
    posx = 10;
    box.style.left = "10px";
    document.getElementById("entrada-palavra").value = '';
    somCorrect.play();
}

function ObjectCorrect(){
    document.getElementById("objetoBomba").textContent = 
        palavras[Math.floor(Math.random() * palavras.length)];

    document.getElementById("entrada-palavra").value = '';

    if(tempo <= 10){
        intPontos += 1;
    }
    if(tempo > 10 && tempo <= 20){
        intPontos = intPontos + 2;
    }
    if(tempo > 20 && tempo <= 30){
        intPontos = intPontos + 4;
    }
    if(tempo > 30 && tempo <= 40){
        intPontos = intPontos + 6;
    }
    if(tempo > 40 && tempo <= 50){
        intPontos = intPontos + 8;
    }
    if(tempo > 50){
        intPontos = intPontos + 10;
    }

    pontos.textContent = intPontos;

    Bomba.posyO = 0;
    boxObjeto.style.top = "0px";
    somCorrect.play();
}

function endGame() {
    ultimaPontuacao = intPontos;
    explosion.play();

    alert("Fim de jogo! Você fez " + ultimaPontuacao + " pontos.");

    const btnSalvar = document.getElementById("botao-salvar");
    if (btnSalvar) {
        btnSalvar.disabled = false;
    }
}

function salvarPontos(recarregar = false) {
    if (ultimaPontuacao <= 0) {
        alert("Nenhuma pontuação para salvar. Jogue uma partida primeiro.");
        return;
    }

    const body = new URLSearchParams();
    body.append('pontos', ultimaPontuacao);
    body.append('tempo_restante', tempo);
    body.append('vidas_restantes', intVida);

    fetch('salvarPontos.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: body.toString()
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('HTTP ' + response.status);
        }
        return response.text();
    })
    .then(text => {
        console.log('Resposta salvarPontos:', text);
        alert(text); 
        const btnSalvar = document.getElementById("botao-salvar");
        if (btnSalvar) {
            btnSalvar.disabled = true; 
        }

        // se chamado com salvarPontos(true), recarrega o jogo depois de salvar
        if (recarregar) {
            window.location.href = "jogo.php";
        }
    })
    .catch(error => {
        console.error('Erro ao salvar pontos:', error);
        alert('Não foi possível salvar a pontuação. Tente novamente.');
    });
}


function Objeto(){
    let index = Math.floor(Math.random() * Bomba.spawn.length);
    Bomba.posxO = Bomba.spawn[index];
    boxObjeto.style.left = Bomba.posxO + "px";
    Bomba.ativo = true;
}   
