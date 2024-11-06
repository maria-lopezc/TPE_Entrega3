<?php

class ApiView {
  public function response($data, $status = 200) {
    header("Content-Type: application/json");
    $statusText = $this->_requestStatus($status);
    header("HTTP/1.1 $status $statusText");
    echo json_encode($data);
  }


  private function _requestStatus($code){
    $status = array(
      200 => "OK",
      201 => "Created",
      400 => "Bad request",
      404 => "Not found",
      500 => "Internal Server Error"
    );

    if(!isset($status[$code])) {
      $code = 500;
    }

    return $status[$code];  
  } 
}