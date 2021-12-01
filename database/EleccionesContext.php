<?php

class EleccionesContext{

    public $db;
    private $fileHandler;

    public function __construct($directory)
    {
        // instancia un objeto de manejador de json.
        $this->fileHandler = new JsonFileHandler($directory,"configuration");

        // Guarda la configuración del Json.
        $configuration = $this->fileHandler->ReadConfiguration();

        // Crea un objeto para el manejo de la base de datos.
        $this->db = new mysqli($configuration->server,$configuration->user,$configuration->password,$configuration->database);

        // Si hay algún error haciendo la conexión.
        if($this->db->connect_error){
            exit('Error connecting to database');
        }
    }
}

?>