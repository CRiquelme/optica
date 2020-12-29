<?php

use CodeIgniter\RESTful\ResourceController;

class MyRestApi extends ResourceController {

    public function genericResponse($data, $msj, $code) {
        if($code == 200) {
            return $this->respond(array(
                "data" => $data,
                "code" => $code
            )); //, 404, "Sin datos");
        } else {
            return $this->respond(array(
                "msj"   => $msj,
                "code"  => $code
            ));
        }
    }

}

?>