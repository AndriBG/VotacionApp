<?php

 class ServiceDataBasePuesto{

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

        $stmt = $this->context->db->prepare("insert into puesto (Nombre,Descripcion,Estado) values(?,?,?)");
        $stmt->bind_param("ssi", $item->Nombre, $item->Descripcion,$item->Estado);
        $stmt->execute();
        $stmt->close();
    }

    public function Edit($item){      

        $stmt = $this->context->db->prepare("update puesto set Nombre = ?, Descripcion = ?, Estado= ? where Id = ?");
        $stmt->bind_param("ssii", $item->Nombre, $item->Descripcion,$item->Estado,$item->Id);
        $stmt->execute();
        $stmt->close();        
    }

    public function Delete($id){
        $stmt = $this->context->db->prepare("delete from puesto where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function GetById($id){

        $puesto = null;

        $stmt = $this->context->db->prepare("select * from puesto where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
          $row = $result->fetch_object();
          $puesto = new Puesto($row->Id,$row->Nombre,$row->Descripcion,$row->Estado);           
        }

        return $puesto;
    }

    public function GetNameById($id){

        $stmt = $this->context->db->prepare("select Nombre from puesto where Id = ?");
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

        $listadoPuestos = array();

        $stmt = $this->context->db->prepare("select * from puesto");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {

                $puesto = new Puesto($row->Id,$row->Nombre,$row->Descripcion,$row->Estado);
                array_push($listadoPuestos, $puesto);
            }
        }

        return $listadoPuestos;
    }  
   
}
