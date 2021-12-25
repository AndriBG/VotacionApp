<?php

    // clase para el manejo de la creacion de los archivos
    class FileHandlerBase {

        // protected, para que estas variables sean visibles en las clases que heredan esta
        protected $directory; // rote
        protected $filename; // name of the file

        // recibe el directorio y el nombre del archivo, ambos tipo cadena
        function __construct(String $directory, string $filename)
        {
            $this->directory = $directory;
            $this->filename = $filename;
        }

        function CreateDirectory($path){

            if(!file_exists($path)){
                mkdir($path,0777,true);
            }
    
        }

    }
