<?php
require_once './app/model/vuelo.model.php';
require_once './app/model/piloto.model.php';
require_once './app/view/api.view.php';

class VueloController{
    private $vueloModel;
    private $pilotoModel;
    private $view;
    public function __construct(){
        $this->vueloModel=new VueloModel();
        $this->pilotoModel=new PilotoModel();
        $this->view=new ApiView();
    }

    public function getAll($req, $res){
        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $vuelos=$this->vueloModel->getAll($orderBy);
        return $this->view->response($vuelos);
    }

    public function create($req, $res){
        var_dump($req->body);  
        if (empty($req->body->id_piloto) || empty($req->body->origen) || empty($req->body->destino) || empty($req->body->cant_pasajeros) || empty($req->body->duracion_vuelo)) {
            return $this->view->response('Faltan completar datos', 400);
        }else{
            $id=$req->body->id_piloto;
            $piloto=$this->pilotoModel->getPiloto($id);

            if($piloto==null){
                return $this->view->response('No existe el piloto', 404);
            } else{
                $origen=$req->body->origen;
                $destino=$req->body->destino;
                $cant=$req->body->cant_pasajeros;
                $duracion=$req->body->duracion_vuelo;

                $idVuelo=$this->vueloModel->addVuelo($id, $origen, $destino, $cant, $duracion);
                return $this->view->response("Se inserto el vuelo con el id=$idVuelo", 200);
            }
        } 
    }

    public function update($req, $res) {
        $id = $req->params->id;

        // verifico que exista
        $vuelo = $this->vueloModel->get($id); //hay q hacer x id
        if (!$vuelo) {
            return $this->view->response("El vuelo con el id=$id no existe", 404);
        }

        if (empty($req->body->id_piloto) || empty($req->body->origen) || empty($req->body->destino) || empty($req->body->cant_pasajeros) || empty($req->body->duracion_vuelo)) {
            return $this->view->response('Faltan completar datos', 400);
        }else{ 
            $id_piloto=$req->body->id_piloto;
            $piloto=$this->pilotoModel->getPiloto($id);

            if($piloto==null){
                return $this->view->response('No existe el piloto', 404);
            } else{
                $origen=$req->body->origen;
                $destino=$req->body->destino;
                $cant=$req->body->cant_pasajeros;
                $duracion=$req->body->duracion_vuelo;

                $this->vueloModel->updateVuelo($id, $id_piloto, $origen, $destino, $cant, $duracion);

                $vuelo = $this->vueloModel->get($id); //hay q hacer x id
                $this->view->response($vuelo, 200);
            }
        }
    }
}