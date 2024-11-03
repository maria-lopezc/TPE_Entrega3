<?php
require_once './app/model/vuelo.model.php';
require_once './app/model/piloto.model.php';
require_once './app/view/api.view.php';

class VueloController{
    private $vueloModel;
    private $pilotoModel;
    private $view;
    private $data;
    public function __construct(){
        $this->vueloModel=new VueloModel();
        $this->pilotoModel=new PilotoModel();
        $this->view=new ApiView();

        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getVuelos($params=null){
        $vuelos=$this->vueloModel->getAll();
        return $this->view->response($vuelos);
    }

    public function getVuelosOrdenados($params=null){
        if($params[':ORDEN']===''){
            return $this->view->response("Faltan agregar el orden", 400);
        } 
        
        $orden=$params[':ORDEN'];

        $vuelos=$this->vueloModel->getAllOrdenado($orden);
        return $this->view->response($vuelos);
    }

    public function addVuelo($params=null){
        $vuelo=$this->getData();
        /**
         * no carga bien, salta error a pesar de estar todo cargado
         */
        if(empty($vuelo->id_piloto)||empty($vuelo->origen)||empty($vuelo->destino)||empty($vuelo->cant_pasajeros)||empty($vuelo->duracion_vuelo)){
            return $this->view->response('Faltan completar datos', 400);
        }else{
            $id=$vuelo->id_piloto;
            $piloto=$this->pilotoModel->getPiloto($id);
            if($piloto==null){
                return $this->view->response('No existe el piloto', 404);
            } else{
                $origen=$vuelo->origen;
                $destino=$vuelo->destino;
                $cant=$vuelo->cant_pasajeros;
                $duracion=$vuelo->duracion_vuelo;

                $idVuelo=$this->vueloModel->addVuelo($id, $origen, $destino, $cant, $duracion);
                return $this->view->response("Se inserto el vuelo con el id=$idVuelo", 200);
            }
        } 
    }
}