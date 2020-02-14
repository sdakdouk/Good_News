<?php
require_once 'clases/conexion/Conexion.php';
require_once 'clases/modelo/Noticia.php';

$modelo=new Conexion();
$id   = $_GET['id'];
$modelo->delete($id);
header("Location: noticias.php?id=$id");

  
