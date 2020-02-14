
  
<?php

class Conexion
{

    private $conexion;
    private $bulk;

    public function __construct()
    {
        $this->conexion = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $this->bulk = new MongoDB\Driver\BulkWrite;
    }
    public static function getInstance()
    {
        return new Conexion();
    }

    public function insertNews(Noticia $news)
    {
        $bulk = new MongoDB\Driver\BulkWrite;
        $arr = array(
            'epi' => $news->getEpi(),
            'titulo' => $news->getTitulo(),
            'subtitulo' => $news->getSubtitulo(),
            'tipo' => $news->getTipo(),
            'body' => $news->getBody()
        );
        $aumenta = 0;
        $aumenta++;
        $news->setNum($aumenta);
        $bulk->insert($arr);

        $this->conexion->executeBulkWrite('news.new', $bulk);
    }

    public static function allNews()
    {

        try {
            $conexion = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $query = new MongoDB\Driver\Query([], []);
            $rows = $conexion->executeQuery("news.new", $query);
            $arr = [];
            foreach ($rows as $row) {

                $noticia = new Noticia($row->epi, $row->titulo, $row->subtitulo, $row->tipo, $row->body, $row->_id);
                array_push($arr, $noticia);
            }
            $l = new ListaNoticias($arr);
            return $arr;
        } catch (MongoDB\Driver\Exception\Exception $e) {

            $filename = basename(__FILE__);

            echo "The $filename script has experienced an error.\n";
            echo "It failed with the following exception:\n";

            echo "Exception:", $e->getMessage(), "\n";
            echo "In file:", $e->getFile(), "\n";
            echo "On line:", $e->getLine(), "\n";
        }
    }

    public function delete($id)
    {
        $flag = 0;
        if ($id) {
            $this->bulk->delete(['_id' => new MongoDB\BSON\ObjectID($id)], ['limit' => 1]);
            $writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);
            $result = $this->conexion->executeBulkWrite('news.new', $this->bulk, $writeConcern);

            if ($result->getDeletedCount()) {
                $flag = 1;
            } else {
                $flag = 2;
            }
        }
    }

    public function obtenerID($id)
    {

        try {
            $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $query = new MongoDB\Driver\Query([], ["_id" => $id]);

            $rows =  $mng->executeQuery("news.new", $query);
            $con = 0;
            foreach ($rows as $row) {

                $noticia = new Noticia($row->epi, $row->titulo, $row->subtitulo, $row->tipo, $row->body, $row->_id);
            }

            return $noticia;
        } catch (MongoDB\Driver\Exception\Exception $e) {
            $filename = basename(__FILE__);

            echo "The $filename script has experienced an error.\n";
            echo "It failed with the following exception:\n";

            echo "Exception:", $e->getMessage(), "\n";
            echo "In file:", $e->getFile(), "\n";
            echo "On line:", $e->getLine(), "\n";
        }
    }

    public function update($noticia, $new)
    {
        $filtro = [
            '_id' => $noticia->getId()
        ];
        $nuevo = [
            '$set' =>
            [
                'epi' => $new['epi'],
                'titulo' => $new['titulo'],
                'subtitulo' => $new['subtitulo'],
                'tipo' => $new['tipo'],
                'body' => $new['body']
            ]
        ];

        $mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update($filtro, $nuevo);
        $mng->executeBulkWrite('news.new', $bulk);
    }


    public static function numeroNoticias()
    {
        try {
            $conexion = new MongoDB\Driver\Manager("mongodb://localhost:27017");
            $query = new MongoDB\Driver\Query([], []);
            $rows = $conexion->executeQuery("news.new", $query);
            $contador = 0;
            foreach ($rows as $row) {
                $contador++;
            }
            return $contador;
        } catch (MongoDB\Driver\Exception\Exception $e) {

            $filename = basename(__FILE__);

            echo "The $filename script has experienced an error.\n";
            echo "It failed with the following exception:\n";

            echo "Exception:", $e->getMessage(), "\n";
            echo "In file:", $e->getFile(), "\n";
            echo "On line:", $e->getLine(), "\n";
        }
    }
}
