<?php
    require "../../autoload.php";

    //Instanciar
    $usuario = new Usuario();

    //definir
    $usuario->setNome($_POST['nome']);
    $usuario->setCpf($_POST['cpf']);
    $usuario->setTelefone($_POST['telefone']);
    $usuario->setEmail($_POST['email']);
    $usuario->setId($_POST['id']);

    //cliente dao
    $dao = new UsuarioDAO();

    //invocar
    $dao->update($usuario);

    //redirecionar
    header('Location: index.php');

?>