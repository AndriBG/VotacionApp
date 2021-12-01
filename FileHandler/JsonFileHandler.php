<?php

class JsonFileHandler extends FileHandlerBase{

    function __construct($directory,$filename)
    {       
        parent::__construct($directory,$filename);
    }

    function ReadConfiguration(){

        // Este es un directorio estático, o sea, ya creado, por eso no hay que usar el método de la clase base.
       $path = $this->directory . "/". $this->filename . ".json";      

        if(file_exists($path)){

            $file = fopen($path,"r");

            $contents = fread($file,filesize($path));
            fclose($file);
            return json_decode($contents);
          
        }else{
            return false;
        }      
    }
}

?>