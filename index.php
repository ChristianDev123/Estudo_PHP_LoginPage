<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <style>
        /* Estilização geral */
        *{
            font-family: 'Times New Roman', Times, serif;
        }
        body{
            text-align: center;
            font-family: 'Times New Roman', Times, serif;
            background:whitesmoke;
        }
        .container-fluid{
            width:80vw;
            margin:auto;
            margin-top:50px;
        }
        /* Estilização da div do Carousel */
        #carousel_login{
            padding:10px;
            width:40vw;
            border-top-left-radius:15px;
            border-bottom-left-radius:15px;
            box-shadow: -2px 2px 5px black;
        } 
        /* Estilização imagem Carousel */
        img{
            border-radius:15px;
        }
        /* Estilização da div do formulário */
        #form_login{
            padding:30px;
            width:40vw;
            min-height:50vh;
            border-top-right-radius: 15px;
            border-bottom-right-radius:15px;
            box-shadow: 2px 2px 5px black;
        }
        /* Divs de componentes do form */
        .name-form{
            color:#00ff80;
        }
        .item_form{
            padding:15px;
        }
        /* Estilização dos cards de respostas */
        .card{
            margin-top:20px;
            padding:5px;
            border-radius:10px;
        }
        .mensagem{
            text-align:justify;
            font-size:20px;
        }
        /* Estilização dos compos de textos */
        .input_val{
            border:2px solid #00ff80;
            border-radius:10px;
        }
        /* Estilização dos botões so site */
        .btn_page{
            margin-top:30px;
            border:2px solid #00ff80;
            border-radius:10px;
            background:whitesmoke;
            padding:5px;
            font-size:18px;
        }
        .btn_page:hover{
            background:#00ff80;
            color:white;
            text-shadow:1px 1px 2px black;
            transition:.7s;
        }
        .voltar{
            margin-top:90px;
        }
    </style>
    <title>Pagina Login - PHP</title>
</head>
<body>
    <main>
        <div class="container-fluid">
            <div class="row" id='cont_login'>
                <!-- Coluna do Carrosel -->
                <div class="col-md-6" id='carousel_login'>
                    <div id="carrosel" class="carousel slide" data-bs-ride='carousel' >
                        <ol class="carousel-indicators">
                            <button type="button" data-bs-target="#carrosel" data-bs-slide-to="0"  class='active' aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carrosel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carrosel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="Imagens/imagem1.jpg" alt="Imagem pizzaria 1" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="Imagens/imagem2.jpg" alt="Imagem pizzaria 2" class="d-block w-100">
                            </div>
                            <div class="carousel-item">
                                <img src="Imagens/imagem3.jpg" alt="Imagem pizzaria 3" class="d-block w-100">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Coluna do formulário -->
                <div class="col-md-6" id='form_login'>
                    <form action="index.php" method='post'>
                        <div class="name-form">
                            <h2>Login:</h2>
                        </div>
                        <div class="item_form">
                            <label for="nome">Insira seu nome:</label>
                            <input type="text" name="nome_usuario" id="nome" class='input_val' autocomplete="off" required>
                        </div>    
                        <div class="item_form">
                            <label for="email">Insira seu e-mail:</label>
                            <input type="email" name="email_usuario" id="email" class='input_val' autocomplete="off" required>
                        </div>
                        <div id="btn_sub">
                            <input type="submit" value="Enviar" class='btn_page'>
                        </div>
                    </form>
                    <!--Processamento form-->
                    <hr>
                    <!-- tratamento do recebimento de dados do form -->
                    <?php
                        $nome_usuario = isset($_POST["nome_usuario"])?$_POST["nome_usuario"]:"[ERRO]";
                        $email_usuario = isset($_POST["email_usuario"])?$_POST["email_usuario"]:"[ERRO]";
                    ?>
                    <!-- recebimento dos dados do banco de dados mysql -->
                    <?php
                        // info banco de dados:    
                            // conexão com mysql:
                                $conexao_mysql = mysqli_connect("localhost", "root"); // conecta o php com o mysql, 1ºpar : "hostname - localhost"; 2º "nome do usuario - root";3º "senha do banco de dados - '' " (XAMPP);
                            // selecionando o banco de dados:
                                mysqli_select_db($conexao_mysql,'login_cadastro'); // seleciona o banco de dados, 1ºpar : var banco de dados; 2ºpar : nome do banco de dados;
                            // comando em string para selecionar todos registros no banco de dados:
                                $comando_selecionar_usuarios = "SELECT * FROM info_usuarios WHERE email = '$email_usuario' AND nome = '$nome_usuario'";
                            // retorno de query(acesso) às informações do banco de dados: 
                                $return_query = mysqli_query($conexao_mysql,$comando_selecionar_usuarios);
                            // função que retorna array com as informações apartir do retorno de acesso as informações(query):
                                $array_usuarios_cad = mysqli_fetch_array($return_query);
                    ?>
                    <!-- tratamento dos dados recebidos pelo banco de dados -->
                    <?php
                        if($array_usuarios_cad != ''){ // se o email já tiver cadastrado e o nome do usuario constar nos registros manda info pro js;
                            echo "
                                <div class='card_site'>
                                    <div class='card'>
                                        <div class='card-body'>
                                            <h2 class='card-title mensagem'>Bem vindo de volta!<br> É um prazer te-lo(a) aqui novamente!</h2>
                                        </div>
                                        <a href='#'><button class='btn_page'>próxima página</button></a>
                                    </div>
                                </div>      
                            ";
                        }else{ 
                            echo "
                                <div class='card_site'>
                                    <div class='card'>
                                        <div class='card-body'>
                                            <h2 class='card-title mensagem'>Bem Vindo á Pizzaria ... !<br>Se você ainda não é cadastrado, cadastre-se clicando no botão abaixo:</h2> 
                                            <a href='cadastro.php'><button class='btn_page'>Página de cadastro</button></a>
                                            <a href='prox_pagina.html'><button class='btn_page'>Continuar navegação sem cadastro </button></a>
                                        </div>
                                    </div>
                                </div>
                            ";
                        };
                    ?> 
                </div>
            </div>
        </div>      
    </main>
</body>
</html>

