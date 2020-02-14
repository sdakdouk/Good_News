<?php

class Noticia
{

    private $epi;
    private $titulo;
    private $subtitulo;
    private $tipo;
    private $body;
    private $id;

    public function __construct($epi = "", $titulo = "", $subtitulo = "", $tipo = "", $body = "", $id = "")
    {

        $this->epi = $epi;
        $this->titulo = $titulo;
        $this->subtitulo = $subtitulo;
        $this->tipo = $tipo;
        $this->body = $body;
        $this->id = $id;
    }


    public function getEpi()
    {
        return $this->epi;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }
    public function getTipo()
    {
        return $this->tipo;
    }
    public function getBody()
    {
        return $this->body;
    }
    public function getNum()
    {
        return $this->num;
    }
    public function getId()
    {
        return $this->id;
    }
    // SETTERS
    public function setNum($num)
    {
        $this->num = $num;
    }
    public function setEpi($epi)
    {
        $this->epi = $epi;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function setSubtitulo($subtitulo)
    {
        $this->subtitulo = $subtitulo;
    }
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
    public function setBody($body)
    {
        $this->body = $body;
    }


    public function obtenerTodas()
    {
    }


    public function descargar()
    {
    }


    public function insertar()
    {

        Conexion::getInstance()->insertNews($this);
    }

    public function delete()
    {

        Conexion::getInstance()->delete($this->id);
    }
    public function obtenerID($id)
    {
        Conexion::getInstance()->obtenerID($id);
    }
    public function update($id, $noticia)
    {

        Conexion::getInstance()->update($id, $noticia);
    }

    public function toString()
    {
        return $this->getId();
    }
}

class ListaNoticias
{
    private $lista = [];

    public function __construct($lista = [])
    {
        $this->lista = $lista;
    }

    public static function getInstance()
    {
        return new ListaNoticias();
    }
    public function getList()
    {
        return $this->list;
    }

    public function setList($list)
    {
        $this->list = $list;
    }
    public function listarNoticias()
    {
        $noticias = Conexion::getInstance()->allNews();
        $txt = "";
        $txt .= "<tr>";

        foreach ($noticias as $r) {
            $txt .= "<td>" . $r->getEpi() . "</td>" .
                "<td>" . $r->getTipo() . "</td>" .

                "<td>" .
                "<form action='#' method='post'>" .
                " <input class='container' type='checkbox' name='noticias[]' value=
                '" .
                "Epi= " . $r->getEpi() . " " .
                "titulo= " . $r->getTitulo() . " " .
                "subtitulo= " . $r->getSubtitulo() . " " .
                "tipo= " . $r->getTipo() . " " .
                "body= " . $r->getBody() . " " .
                "'>" .
                "</form" .
                "</td> " .

                "<td>" . "<a class='container btn btn-secondary btn-sm' href='index.php?id=" . $r->getId() .  "'>Edit</a>" . "</td> " .
                "<td>" . "<a  class='container btn btn-secondary btn-sm' href='eliminar.php?id=" . $r->getId() . "'>Borrar</a>" . "</td> " . "</tr>";
        }
        return $txt;
    }
    public function descarga($arrNoticias = [], $formato)
    {
        $data = [];
        $arrayString = [];
        $datosJson = [];

        foreach ($formato as $tipo) {
            if ($formato['json'] == ".JSON") {
                $data = $arrNoticias;
                foreach ($data as $n) {
                    $arrayString = explode("=", $n);
                    $datosJson[]['epi'] = $arrayString[1];
                    $datosJson[]['titulo'] = $arrayString[2];
                    $datosJson[]['subtitulo'] = $arrayString[3];
                    $datosJson[]['tipo'] = $arrayString[4];
                    $datosJson[]['body'] = $arrayString[5];
                }
                $fp = fopen('results.json', 'w');
                fwrite($fp, json_encode($datosJson, JSON_PRETTY_PRINT));
                fclose($fp);
            } else if ($formato['xml'] == ".XML") {
                $this->generarXML($arrNoticias);
            }
        }
    }

    public function generarXML($arr = [])
    {
        ob_clean();      
        $datos = $arr;
        $array = [];
        header('Content-type: text/xml');
        header('Pragma: public');
        header('Cache-control: private');
        header('Expires: -1');
        header("Content-Disposition: attachment; filename=news.xml");
        header("Content-Description: File Transfer");
        $txt="";
        $txt.= "<?xml version='1.0' encoding='utf-8'?>";

       $txt.= "<news>";
        foreach ($datos as $n) {
            $arrayString = explode("=", $n);
            $txt.= "<epigrafe>" . $arrayString[1] . "</epigrafe>";
            $txt.= "<titulo>" . $arrayString[2] . "</titulo>";
            $txt.= "<subtitulo>" . $arrayString[3] . "</subtitulo>";
            $txt.= "<tipo>" . $arrayString[4] . "</tipo>";
            $txt.= "<texto>" . $arrayString[5] . "</texto>";
        }
        $txt.= "</news>";
        print_r($txt);die;    
    }
}
