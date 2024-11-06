<?php
class PilotoModel{
    private $db;
    public function __construct(){
        $this->db=new PDO('mysql:host=localhost;'.'dbname=aerolinea;charset=utf8', 'root', '');
    }

    public function getPiloto($id){
        $query=$this->db->prepare("SELECT * FROM pilotos WHERE id_piloto=?");
        $query->execute([$id]);
        $vuelo=$query->fetch(PDO::FETCH_OBJ);
        return $vuelo; 
    }
}