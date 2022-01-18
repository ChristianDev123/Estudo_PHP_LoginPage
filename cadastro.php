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
            background-image: linear-gradient(135deg, #33ffad,#1aff66);
        }
        .container-fluid{
            text-align: center;
            margin-top:80px;
        }
        /* Estilização da div do formulário */
        .form_cadastro{
            margin:auto;
            padding:30px;
            background:whitesmoke;
            width:40vw;
            min-height: 30vh;
            border-radius:15px;
            box-shadow: 2px 2px 5px black;
        }
        /* Divs de componentes do form */
        .item_form{
            padding:15px;
        }
        /* Estilização dos cards de respostas */
        .card{
            margin-top:20px;
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
            <div class="form_cadastro">
                <form action="cadastro.php" method='post'>
                    <div class="item_form">
                        <label for="nome">Insira seu nome:</label>
                        <input type="text" class='input_val' name="nome_usuario" id="nome" autocomplete="off" required>
                    </div>
                    <div class="item_form">
                        <label for="email">Insira seu email:</label>
                        <input type="email" class='input_val' name="email_usuario" id="email" autocomplete="off" required>
                    </div>
                    <div class="sub_btn">
                        <input type="submit" value="Cadastrar" class='btn_page'>
                    </div>
                </form>
                <?php
                    $nome_usuario = isset($_POST['nome_usuario'])?$_POST['nome_usuario']:'';
                    $email_usuario = isset($_POST['email_usuario'])?$_POST['email_usuario']:'';
                    if($nome_usuario != '' && $email_usuario != ''){
                        // conexão com banco de dados:
                        $conexao_mysql = mysqli_connect("localhost", "root"); 
                        mysqli_select_db($conexao_mysql,'login_cadastro');
                        
                        // Verificação de e-mail:
                        $array_retorno_usuario = '';
                        $comando_select_email = "SELECT * FROM info_usuarios where email = '$email_usuario'";
                        $retorno_select = mysqli_query($conexao_mysql,$comando_select_email);
                        $array_retorno_usuario = mysqli_fetch_array($retorno_select);
                        if($array_retorno_usuario != ''){
                            echo "
                                <div class='card'>
                                    <div class='card-body'>
                                        <h3 class='mensagem'>O email $email_usuario já está cadastrado.<br>Por favor volte a página inicial.</h3>
                                    </div>
                                </div>
                            ";
                        }else{
                            // query para adicionar o usuário:
                            $comando_cadastro = "INSERT INTO info_usuarios VALUE (default,'$nome_usuario','$email_usuario')";
                            mysqli_query($conexao_mysql,$comando_cadastro);
                            $retorno_select = mysqli_query($conexao_mysql,$comando_select_email);
                            $array_retorno_usuario = mysqli_fetch_array($retorno_select);
                            if(count($array_retorno_usuario) != ''){
                                echo "
                                    <div class='card'>
                                        <div class='card-body'>
                                            <h3 'mensagem'>O seu cadastro foi concluido com sucesso! <br>Por favor volte á página inicial para continuar a navegação.</h3>
                                        </div>
                                    </div>
                                ";
                            }
                        };
                     };
                ?>
            </div>
            <div class="voltar">
                <a href="index.php"><input type="button" value="Voltar" class='btn_page'></a>
            </div>
        </div>
    </main>
</body>