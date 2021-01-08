<?php

require_once "../Control/conexao.php";
require 'classes/produto_class.php';
$p= new Produto_class();
$p-> ExecutaConexao();

// if(isset($_GET['id'])&& !empty($_GET['id'])){
//   $id=addslashes($_GET['id']);

// }else{
//     // header('location: produtos.php');
// }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Escola IST</title>
    <link rel="shortcut icon" href="../image/logo.png">
    <!-- Favicon-->
    <!-- <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" /> -->
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
        type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/style.css" rel="stylesheet" />
    <style>
   .h-100 {
    height: 0% !important;
}
    </style>
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
        <div class="container">
            <img src="../image/logo.png" alt="" style="float:left;margin-right:10px;width:90px;height:40px;">
            <a class="navbar-brand js-scroll-trigger" href="index.php">Escola IST </a>
            <button
                class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                            href="../config.php?acao=quebra">Sair</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
    <br>
    <br>
    </div>
        
  