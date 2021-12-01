<?php

 class ServiceDataBaseEleccion{

    private $context;
    private $directory;

    public function __construct($isRoot = false){

        // para acceder a la conexión de la base de datos
        $prefijo = ($isRoot) ? "" : "../";
        $this->directory = "{$prefijo}database";

        // Instancia objeto que maneja la base de datos
        $this->context = new EleccionesContext($this->directory);
    }

    public function Add($item){
        $stmt = $this->context->db->prepare("insert into eleccion (Nombre,FechaRealizacion,Estado) values(?,?,?)");
        $stmt->bind_param("ssi", $item->Nombre, $item->FechaRealizacion,$item->Estado);
        $stmt->execute();
        $stmt->close();
    }

    public function Edit($item){      
        $stmt = $this->context->db->prepare("update eleccion set Nombre = ?, FechaRealizacion = ?, Estado = ? where Id = ?");
        $stmt->bind_param("ssii", $item->Nombre, $item->FechaRealizacion,$item->Estado,$item->Id);
        $stmt->execute();
        $stmt->close();        
    }

    // public function Delete($id){
    //     $stmt = $this->context->db->prepare("delete from Candidatos where Id = ?");
    //     $stmt->bind_param("i", $id);
    //     $stmt->execute();
    //     $stmt->close();  
    // }

    public function Change($id){
        $a = 0;
        $stmt = $this->context->db->prepare("update eleccion set Estado = ? where Id = ?");
        $stmt->bind_param("ii", $a ,$id);
        $stmt->execute();
        $stmt->close();  
    }

    public function GetById($id){

        $eleccion = null;

        $stmt = $this->context->db->prepare("select * from eleccion where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
          $row = $result->fetch_object();
          $eleccion = new Eleccion($row->Id,$row->Nombre,$row->FechaRealizacion,$row->Estado);           
        }
        $stmt->close();   
        return $eleccion;
    }

    public function GetList(){

        $listadoElecciones = array();

        $stmt = $this->context->db->prepare("select * from eleccion");
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {
            while ($row = $result->fetch_object()) {
                $eleccion = new Eleccion($row->Id,$row->Nombre,$row->FechaRealizacion,$row->Estado);
                array_push($listadoElecciones, $eleccion);
            }
        }
        $stmt->close();   
        return $listadoElecciones;
    }
}
