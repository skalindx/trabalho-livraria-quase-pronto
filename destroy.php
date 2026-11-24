<?php
    require "../../autoload.php";

    //coletar
    $id = $_GET['id'];

    //instanciar
    $dao = new UsuarioDAO();

    //invocar
    $dao->destroy($id);

    //redicionar
    header('Location: index.php');
?>