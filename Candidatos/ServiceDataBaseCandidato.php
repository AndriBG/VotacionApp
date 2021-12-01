<?php

 class ServiceDataBaseCandidato{

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

        $stmt = $this->context->db->prepare("insert into candidato (Nombre,Apellido,Partido,Puesto,Foto,Estado) values(?,?,?,?,?,?)");
        $stmt->bind_param("ssiisi", $item->Nombre, $item->Apellido,$item->Partido,$item->Puesto,$item->Foto,$item->Estado);
        $stmt->execute();
        $stmt->close();
    }

    public function Edit($item){      

        $stmt = $this->context->db->prepare("update candidato set Nombre = ?, Apellido = ?, Partido = ?, Puesto = ?, Foto = ?, Estado = ? where Id = ?");
        $stmt->bind_param("ssiisii", $item->Nombre, $item->Apellido,$item->Partido,$item->Puesto,$item->Foto,$item->Estado,$item->Id);
        $stmt->execute();
        $stmt->close();        
    }


    public function Change($id){
        $a = 0;
        $stmt = $this->context->db->prepare("update candidato set Estado = ? where Puesto = ?");
        $stmt->bind_param("ii", $a ,$id);
        $stmt->execute();
        $stmt->close();  
    }

    // public function Delete($id){
    //     $stmt = $this->context->db->prepare("delete from Candidato where Id = ?");
    //     $stmt->bind_param("i", $id);
    //     $stmt->execute();
    //     $stmt->close();  
    // }

    public function GetById($id){

        $candidato = null;

        $stmt = $this->context->db->prepare("select * from candidato where Id = ?");
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

        $stmt = $this->context->db->prepare("select * from candidato");
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

    public function GetListCandPuesto($id){

        $listadoCandidatos = array();

        $stmt = $this->context->db->prepare("select * from candidato where Puesto = ? and Estado = 1");
        $stmt->bind_param("i", $id);
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
   
}
