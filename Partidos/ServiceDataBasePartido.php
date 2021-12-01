<?php

 class ServiceDataBasePartido{

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

        $stmt = $this->context->db->prepare("insert into partido (Nombre,Descripcion,Logo,Estado) values(?,?,?,?)");
        $stmt->bind_param("sssi", $item->Nombre, $item->Descripcion,$item->Logo,$item->Estado);
        $stmt->execute();
        $stmt->close();
    }

    public function Edit($item){      

        $stmt = $this->context->db->prepare("update partido set Nombre = ?, Descripcion = ?, Logo = ?, Estado = ? where Id = ?");
        $stmt->bind_param("sssii", $item->Nombre, $item->Descripcion,$item->Logo,$item->Estado,$item->Id);
        $stmt->execute();
        $stmt->close();        
    }

    // public function Delete($id){
    //     $stmt = $this->context->db->prepare("delete from Candidatos where Id = ?");
    //     $stmt->bind_param("i", $id);
    //     $stmt->execute();
    //     $stmt->close();  
    // }

    public function GetById($id){

        $partido = null;

        $stmt = $this->context->db->prepare("select * from partido where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
          $row = $result->fetch_object();
          $partido = new Partido($row->Id,$row->Nombre,$row->Descripcion,$row->Logo,$row->Estado);           
        }

        return $partido;
    }

    public function GetNameById($id){

        $stmt = $this->context->db->prepare("select Nombre from partido where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
            $row = $result->fetch_object();
            return $row->Nombre;
        }
    }

    public function GetList(){

        $listadoPartidos = array();

        $stmt = $this->context->db->prepare("select * from partido");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {

                $partido = new Partido($row->Id,$row->Nombre,$row->Descripcion,$row->Logo,$row->Estado);
                array_push($listadoPartidos, $partido);
            }
        }

        return $listadoPartidos;
    }  
   
}
