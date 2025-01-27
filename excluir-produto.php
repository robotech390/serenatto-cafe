<?php

require "src/conexao-bd.php";
require "src/Modelo/Produto.php";
require "src/Repositorio/ProdutoRepositorio.php";

$repositorio = new ProdutoRepositorio($pdo);
$repositorio->deletar($_POST['id']);

header('location: admin.php');