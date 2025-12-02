let box = document.getElementById("palavra");
let vida = document.getElementById("vidas");
box.style.position = "absolute"; 
let intVida = 3;
let posx= 10;
let posy= 100;
let speed= 5;
let pergunta;
let start = true;
let intPontos = 0;
let pontos = document.getElementById("pontos");
let palavraCaixa = document.getElementById("palavra");
let palavras = [
  "abacaxi","abacate","abelha","abobora","absoluto","acabamento","academia","acender","aceitar","achar",
  "acordo","acucar","adivinha","advogado","aeronave","aguia","alegria","amarelo","amigo","amor",
  "andar","anel","animal","anoitecer","antena","antigo","apagar","aparelho","aprender","arara",
  "areia","arma","arrumar","arte","assunto","atitude","avancar","azedo","azul","bala",
  "banana","barco","barulho","bebida","beijo","beleza","bicicleta","biscoito","bloco","bola",
  "bolacha","bolo","bomba","bonito","borboleta","braço","branco","brilho","brinquedo","cabelo",
  "cafe","caixa","caminho","camisa","caneta","canto","carro","carta","casaco","casamento",
  "castelo","cavalo","celebrar","celular","cereja","ceu","chuva","cinema","circulo","cidade",
  "claro","clima","cobra","coco","codigo","colar","comida","computador","conta","controle",
  "copo","coragem","corda","corredor","coracao","corpo","corrida","corte","crianca","cristal",
  "cuidado","culpa","curioso","danca","dedo","dente","desafio","desenho","deserto","destino",
  "detalhe","dia","dinheiro","doce","dor","duelo","eco","educacao","efeito","energia",
  "enigma","entrada","equipamento","escada","escola","escrita","escuro","espada","espelho","esporte",
  "estrela","estudo","exemplo","experiencia","faca","familia","fantasia","farol","feira","festa",
  "figura","filme","foco","fogo","folha","fome","fonte","forma","forte","foto",
  "frase","fruta","fumaca","funcao","galo","garrafa","gato","gelado","gelo","girassol",
  "giz","globo","goiaba","gota","grama"
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
 
}

function mover() {    

    let resposta = document.getElementById("entrada-palavra").value;
    let palavraAtual = document.getElementById("palavra-atual");
    pergunta = palavraAtual.textContent;
    posx += speed;
    box.style.left = posx + "px";
    console.log(resposta);
    console.log(palavraAtual);
    requestAnimationFrame(mover); 

    if(posx + 85 >= window.innerWidth){
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
    intPontos += 1;
    pontos.textContent = intPontos;
    posx = 10;
    box.style.left = "10px";
    document.getElementById("entrada-palavra").value = '';
    speed = speed*1.1;
}

function endGame(){
    window.location.href = "jogo.php";
}

