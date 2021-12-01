<?php

 class ServiceDataBase{

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

        $stmt = $this->context->db->prepare("insert into ciudadanos (cedula,nombre,apellido,email,estado) values(?,?,?,?,?)");
        $stmt->bind_param("ssssi", $item->DocId, $item->Nombre,$item->Apellido,$item->Email,$item->Estado);
        $stmt->execute();
        $stmt->close();
    }

    public function Edit($item){      

        $stmt = $this->context->db->prepare("update ciudadanos set nombre = ?, apellido = ?, email = ?, estado = ? where cedula = ?");
        $stmt->bind_param("sssis", $item->Nombre, $item->Apellido,$item->Email,$item->Estado,$item->DocId);
        $stmt->execute();
        $stmt->close();        
    }

    // public function Delete($id){
    //     $stmt = $this->context->db->prepare("delete from Candidatos where Id = ?");
    //     $stmt->bind_param("i", $id);
    //     $stmt->execute();
    //     $stmt->close();  
    // }

    public function GetById($cedula){

        $ciudadano = null;

        $stmt = $this->context->db->prepare("select * from ciudadanos where cedula = ?");
        $stmt->bind_param("s", $cedula);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
          $row = $result->fetch_object();
          $ciudadano = new Ciudadano($row->cedula,$row->nombre,$row->apellido,$row->email,$row->estado);
        }

        return $ciudadano;
    }

    public function GetList(){

        $listadoCiudadanos = array();

        $stmt = $this->context->db->prepare("select * from ciudadanos");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {
            while ($row = $result->fetch_object()) {
                // row: es el objeto que representa la tabla en la bd
                $ciudadano = new Ciudadano($row->cedula,$row->nombre,$row->apellido,$row->email,$row->estado);
                array_push($listadoCiudadanos, $ciudadano);
            }
        }
        return $listadoCiudadanos;
    }
   
}
