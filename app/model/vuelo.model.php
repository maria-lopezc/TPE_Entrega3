<?php
class VueloModel{
    private $db;
    public function __construct(){
        $this->db=new PDO('mysql:host=localhost;'.'dbname=aerolinea;charset=utf8', 'root', '');
    }

    public function getAll(){
        $query=$this->db->prepare('SELECT * FROM vuelos');
        $query->execute();
        $vuelos=$query->fetchAll(PDO::FETCH_OBJ);
        return $vuelos; 
    }

    public function getAllOrdenado($orden){
        if($orden=='DESC'){
            $query=$this->db->prepare('SELECT * FROM vuelos ORDER BY `vuelos`.`origen` DESC');
        }else{
            $query=$this->db->prepare('SELECT * FROM vuelos ORDER BY `vuelos`.`origen` ASC');
        }
        $query->execute();
        $vuelos=$query->fetchAll(PDO::FETCH_OBJ);
        return $vuelos; 
    }

    public function addVuelo($id, $origen, $destino, $cant, $duracion){
        $query=$this->db->prepare('INSERT INTO `vuelos` (`id_piloto`, `origen`, `destino`, `cant_pasajeros`, `duracion_vuelo`) VALUES (?,?,?,?,?)');
        $query->execute([$id, $origen, $destino, $cant, $duracion]);
        $vuelo=$query->fetch(PDO::FETCH_OBJ);
        return $vuelo->id_vuelos;
    }
}