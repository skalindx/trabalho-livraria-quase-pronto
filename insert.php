<?php
    //autoload
    require "../../autoload.php";
    //bean
    $usuario = new usuario();

    //definir valores dos atributos form
    $usuario->setNome($_POST['nome']);
    $usuario->setCpf($_POST['cpf']);
    $usuario->setTelefone($_POST['telefone']);
    $usuario->setEmail($_POST['email']);

    //dao
    $dao = new UsuarioDAO();

    //invocar
    $dao->create($usuario);

    //redirecionar index(comentar quando não funcionar)
     header('Location: index.php');
