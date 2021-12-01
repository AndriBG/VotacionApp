<?php

 class ServiceFile{   

    public $fileHandler;
    public $directory;
    public $filename;
    private $utilities;

    public function __construct($isRoot = false){

        $prefijo = ($isRoot) ? "Candidatos/" : "";
        $this->directory = "{$prefijo}data";
        $this->filename = "eleccion";
        // $this->utilities = new Utilities();

        // Aquí debe cambiar la instancia para el manejo de los archivos.
        $this->fileHandler = new CsvFileHandler($this->directory,$this->filename);
    }

    public function Add($item){

        $Elecciones = $this->GetList();

        array_push($Elecciones, $item);

        $this->fileHandler->SaveFile($Elecciones);
    }

    // public function Edit($item){      

    //     $transacciones = $this->GetList();
        
    //     $index = $this->utilities->getIndexElement($transacciones,"Id",$item->Id);

    //     if($index !== null){
    //         $transacciones[$index] = $item;
    //         $this->FileLog->SaveFile($item,"Edit");
    //         $this->fileHandler->SaveFile($transacciones);
    //     }             
    // }

    // public function Delete($id){
    //     $transacciones = $this->GetList();

    //     $index = $this->utilities->getIndexElement($transacciones,"Id",$id);

    //     if(count($transacciones) > 0){
    //         $this->FileLog->SaveFile($transacciones[$index],"Delete");
    //         unset($transacciones[$index]);
    //         $this->fileHandler->SaveFile($transacciones);
    //     }
    // }

    // public function GetById($id){

    //     $transacciones = $this->GetList();

    //     $tran = $this->utilities->searchProperty($transacciones,"Id",$id);     
        
    //     return $tran[0];
    // }

    public function GetList(){

        $Elecciones = $this->fileHandler->ReadFile();
        
        if ($Elecciones == false) {         
            return array();
        }
        return (array)$Elecciones;
    }
}

?>
