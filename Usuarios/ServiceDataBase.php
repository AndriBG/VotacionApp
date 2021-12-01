<?php

 class ServiceDataBase{

    private $context;
    private $directory;

    public function __construct($isRoot = false){

        // para acceder a la conexión de la base de datos
        $prefijo = ($isRoot) ? "" : "../";
        $this->directory = "{$prefijo}database";

        // $this->utilities = new Utilities();

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

        $stmt = $this->context->db->prepare("update Candidatos set Nombre = ?, Apellido = ?, Partido = ?, Puesto = ?, Foto = ?, Estado = ? where Id = ?");
        $stmt->bind_param("ssiisi", $item->Name, $item->Apellido,$item->Partido,$item->Puesto,$item->Foto,$item->Estado);
        $stmt->execute();
        $stmt->close();        
    }

    public function Delete($id){
        $stmt = $this->context->db->prepare("delete from Candidatos where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();  
    }

    public function GetById($id){

        $candidato = null;

        $stmt = $this->context->db->prepare("select * from Candidatos where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
          $row = $result->fetch_object();
          $candidato = new Candidato($row->Id,$row->Nombre,$row->Apellido,$row->Partido,$row->Puesto,$row->Foto,$row->Estado);           
        }

        return $candidato;
    }

    public function GetList(){

        $listadoCandidatos = array();

        $stmt = $this->context->db->prepare("select * from Candidatos");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {

                $candidato = new Candidato($row->Id,$row->Nombre,$row->Apellido,$row->Partido,$row->Puesto,$row->Foto,$row->Estado);
                array_push($listadoCandidatos, $candidato);
            }
        }

        return $listadoCandidatos;
    }

    public function Login($user,$contra){

        $usu = null;

        $stmt = $this->context->db->prepare("select * from Usuario where NombreUsuario = ? and Contrasena = ?");
        $stmt->bind_param("ss", $user,$contra);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {
          $row = $result->fetch_object();
          $usu = new Usuario($row->Id,$row->Nombre,$row->Apellido,$row->Email,$row->NombreUsuario,$row->Contrasena,$row->Estado);           
        }

        return $usu;
    }
   
}
