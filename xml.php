<?php
require_once 'clases/conexion/Conexion.php';
require_once 'clases/modelo/Noticia.php';
ob_clean();
$con= new Conexion();
$datos=$con->allNews();
$array=[];
header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');
header('Expires: -1');
header("Content-Disposition: attachment; filename=news.xml");
header("Content-Description: File Transfer");
echo "<?xml version='1.0' encoding='utf-8'?>";

echo "<news>";

foreach ($datos as $row){
        echo "<new>";
        echo "<epigrafe>".$row->getEpi()."</epigrafe>";
        echo "<titulo>".$row->getTitulo()."</titulo>";
        echo "<subtitulo>".$row->getSubtitulo()."</subtitulo>";
        echo "<texto>".$row->getBody()."</texto>";
        echo "</new>";
}
echo "</news>";