# Jogo da Explosão – README

Bem-vindo ao **Joguinho da Explosão**!  
Este é um jogo de digitação em que você precisa escrever as palavras corretas o mais rápido possível para marcar pontos antes que a bomba alcance o final da tela e exploda.

---

## 1. Acesso e cadastro

1. Abrir o projeto em um servidor PHP (ex.: XAMPP, Wamp, Laragon ou servidor embutido do PHP).
2. No navegador, acesse o endereço configurado para o projeto (por exemplo:  
   `http://localhost/Projeto_web/`).
3. Rodar `http://localhost/Projeto_web/criar_db_tabelas.php/` para criar o banco de dados requerido pelo jogo.
4. Na tela inicial você pode:
   - **Fazer login**, se já tiver cadastro.
   - **Criar uma conta**, clicando em *Cadastrar*:
     - Informe **email**, **senha** e um **nickname**.
     - Depois volte para a tela de login, entre com seus dados e você será redirecionado para a **Home**.

---

## 2. Navegação básica

Depois de logado, você verá a **Home**, com algumas opções principais (os nomes podem variar um pouco):

- **Jogar** – abre o jogo.
- **Pontuação Geral** – mostra o ranking de todos os jogadores com suas maiores pontuações.
- **Ligas** – permite ver ligas existentes, entrar em uma ou criar uma nova.
- **Histórico** – mostra as suas partidas anteriores.
- **Sair** – encerra a sessão.

Para **apenas jogar**, basta clicar em **Jogar**.

---

## 3. Tela do jogo

Ao entrar em **Jogar**, você verá:

- Uma **palavra** se movendo horizontalmente na tela e outra palavra se movendo.
- Uma **bomba** descendo do topo.
- Um contador de **Pontos**.
- Um contador de **Vidas** (você começa com 3).
- A **palavra atual** que você precisa digitar.
- Um campo de texto para digitar a palavra.
- Botões:
  - **Iniciar** – começa a partida.
  - **Sair** – volta para a Home.

---

## 4. Como jogar

1. Clique em **Iniciar**.
2. Observe a **palavra atual** mostrada na tela.
3. Digite essa palavra exatamente igual no campo de texto e pressione **Enter**:
   - Se estiver correta, você ganha pontos.
   - Uma nova palavra será escolhida.
4. A **bomba que desce do topo** também possui uma palavra associada:
   - Se você digitar a palavra da bomba corretamente, também ganha pontos e a bomba é “desarmada” (reinicia a queda).
5. Enquanto isso:
   - A palavra continua se movendo na horizontal.
   - A bomba continua caindo.
6. Se a bomba chegar ao fim da tela:
   - Você **perde 1 vida**.
   - A bomba volta ao topo.
7. Quando as **vidas chegarem a zero**, o jogo termina.
8. Um detalhe: a velocidade da bomba horizontal vai aumentando conforme o tempo vai passando.

---

## 5. Pontuação

A pontuação é baseada em:

- Quantas palavras você acerta (tanto a palavra principal quanto a da bomba).
- O **tempo de jogo**: quanto mais tempo você consegue se manter vivo, maior a pontuação dada por cada acerto.

De forma simplificada:

- No começo, cada acerto vale menos pontos.
- À medida que o tempo passa:
  - Os pontos por acerto aumentam.
  - A velocidade/ dificuldade também pode aumentar.
- No final da partida, sua pontuação é exibida e pode ser **salva**.
- Ao fim do jogo, o sistema envia sua pontuação para o servidor.
- Sua melhor pontuação geral é armazenada e usada no **ranking geral**.
- Cada partida também entra no **histórico**, com data, pontos e outras informações.

---

## 6. Ligas e rankings (modo competitivo)

O jogo também possui um modo de competição em **ligas**.

### 6.1. Entrar em uma liga

1. Na **Home**, clique em **Tabela de Ligas**.
2. Você verá uma lista de ligas com:
   - Nome da liga.
   - Quantidade de jogadores.
   - Melhor pontuação da liga.
3. Escolha uma liga e clique em **Entrar**.
4. A partir desse momento:
   - Você passa a participar dessa liga.
   - Suas partidas contam para o ranking daquela liga (a partir da data de entrada).

### 6.2. Pontuação na liga

Na tela da liga você verá:

- **Pontuação geral na liga** – soma das suas partidas desde que você entrou na liga.
- **Pontuação semanal** – soma das partidas realizadas nos últimos dias (por exemplo, últimos 7 dias), também desde a entrada na liga.

O ranking da liga é montado comparando os jogadores que pertencem a essa liga, ordenando pelos pontos.

### 6.3. Sair de uma liga

Se quiser deixar a liga:

1. Abra a tela da liga em que você está.
2. Clique em **Sair da liga**.
3. Você deixará de aparecer no ranking dessa liga, mas:
   - Seu histórico de partidas continua existindo.
   - Sua pontuação geral continua valendo no **ranking global**.

---

## 7. Histórico de partidas

Na opção **Histórico**, você pode:

- Ver todas as partidas que já jogou.
- Ver pontuação, data e outras informações de cada partida.

---

Prezado e honradíssimo professor Alex Kutzke, bom jogo! <3 Feito com amor pelos seus alunos queridos.
Divirta-se treinando sua digitação e disputando as ligas!  
