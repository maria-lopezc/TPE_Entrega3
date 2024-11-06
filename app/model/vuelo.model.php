<?php
class VueloModel{
    private $db;
    public function __construct(){
        $this->db=new PDO('mysql:host=localhost;'.'dbname=aerolinea;charset=utf8', 'root', '');
    }

    public function getAll($orden=false){
        $query = 'SELECT * FROM vuelos';
    
        if ($orden) {
            switch ($orden) {
                case 'piloto': 
                    $query .= ' ORDER BY `vuelos`.`id_piloto`';
                    break;
                case 'origen': 
                    $query .= ' ORDER BY `vuelos`.`origen`';
                    break;
                case 'destino': 
                    $query .= ' ORDER BY `vuelos`.`destino`';
                    break;
                case 'pasajeros': 
                    $query .= ' ORDER BY `vuelos`.`cant_pasajeros`';
                    break;
                case 'duracion': 
                    $query .= ' ORDER BY `vuelos`.`duracion_vuelo`'; 
                    break;
            } 
        }
    
        $secuencia = $this->db->prepare($query);
        $secuencia->execute();

        $vuelos = $secuencia->fetchAll(PDO::FETCH_OBJ); 
        return $vuelos;
    }

    public function addVuelo($id, $origen, $destino, $cant, $duracion){
        $query=$this->db->prepare('INSERT INTO `vuelos` (`id_piloto`, `origen`, `destino`, `cant_pasajeros`, `duracion_vuelo`) VALUES (?,?,?,?,?)');
        $query->execute([$id, $origen, $destino, $cant, $duracion]);
        
        $id = $this->db->lastInsertId();
        return $id;
    }

    function updateVuelo($id, $id_piloto, $origen, $destino, $cant, $duracion) {    
        $query = $this->db->prepare('UPDATE tareas SET `id_piloto` = ?, `origen` = ?, `destino` = ?, `cant_pasajeros` = ?, `duracion_vuelo` = ? WHERE id = ?');
        $query->execute([$id_piloto, $origen, $destino, $cant, $duracion, $id]);
    }

}