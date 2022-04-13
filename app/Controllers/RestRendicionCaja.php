<?php

namespace App\Controllers;

use MyRestApi;
use CodeIgniter\Controller;
use App\Models\RendicionCajaModel;

class RestRendicionCaja extends MyRestApi
{
	protected $modelName = 'App\Models\RendicionCajaModel';
	protected $format	 = 'json';


	public function index(){
		return $this->genericResponse($this->model->findAll(), null, 200);
	}

  public function create() {
		$rendicionCaja = new RendicionCajaModel();
		$id = $rendicionCaja->insert([
      "fecha"                 => $this->request->getPost("fecha"),
      "rut"                   => $this->request->getPost("rut"),
      "nombre_cliente"        => $this->request->getPost("nombreCliente"),
      "total_folio"           => $this->request->getPost("totalFolio"),
      "saldo_folio"           => $this->request->getPost("saldoFolio"),
      "numero_folio"          => $this->request->getPost("numeroFolio"),
      "numero_boleta"         => $this->request->getPost("numeroBoleta"),
      "numero_operacion_tbk"  => $this->request->getPost("numeroOperacionTbk"),
      "numero_guia_despacho"  => $this->request->getPost("numeroGuiaDespacho"),
      "numero_factura"        => $this->request->getPost("numeroFactura"),
      "efectivo"              => $this->request->getPost("efectivo"),
      "tbk"                   => $this->request->getPost("tbk"),
      "cheques"               => $this->request->getPost("cheques"),
      "webpay"                => $this->request->getPost("webpay"),
      "tf"                    => $this->request->getPost("tf"),
      "oc"                    => $this->request->getPost("oc"),
      "saldo"                 => $this->request->getPost("saldo")
		]);
	}

  public function update($id = null) {
    $rendicionCaja = new RendicionCajaModel();
    $data = $this->request->getRawInput();
    $rendicionCaja->update($id, [
      "fecha"                 => $data['fecha'] !== (null) ? $data['fecha'] : (null),
      "rut"                   => $data['rut'] !== (null) ? $data['rut'] : (null),
      "nombre_cliente"        => $data['nombreCliente'] !== (null) ? $data['nombreCliente'] : (null),
      "total_folio"           => $data['totalFolio'] !== (null) ? $data['totalFolio'] : (null),
      "saldo_folio"           => $data['saldoFolio'] !== (null) ? $data['saldoFolio'] : (null),
      "numero_folio"          => $data['numeroFolio'] !== (null) ? $data['numeroFolio'] : (null),
      "numero_boleta"         => $data['numeroBoleta'] !== (null) ? $data['numeroBoleta'] : (null),
      "numero_operacion_tbk"  => $data['numeroOperacionTbk'] !== (null) ? $data['numeroOperacionTbk'] : (null),
      "numero_guia_despacho"  => $data['numeroGuiaDespacho'] !== (null) ? $data['numeroGuiaDespacho'] : (null),
      "numero_factura"        => $data['numeroFactura'] !== (null) ? $data['numeroFactura'] : (null),
      "efectivo"              => $data['efectivo'] !== (null) ? $data['efectivo'] : (null),
      "tbk"                   => $data['tbk'] !== (null) ? $data['tbk'] : (null),
      "cheques"               => $data['cheques'] !== (null) ? $data['cheques'] : (null),
      "webpay"                => $data['webpay'] !== (null) ? $data['webpay'] : (null),
      "tf"                    => $data['tf'] !== (null) ? $data['tf'] : (null),
      "oc"                    => $data['oc'] !== (null) ? $data['oc'] : (null),
      "saldo"                 => $data['saldo'] !== (null) ? $data['saldo'] : (null)
    ]);
  }

  public function show($id = null) {
		if ($this->model->find($id) == null) return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);
		
		return $this->genericResponse($this->model->find($id), null, 200);
	} // show

  public function delete($id = null) {
		$rendicionCaja = new RendicionCajaModel();

		if ($this->model->find($id) == null) return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);

		$rendicionCaja->delete($id);
		return $this->genericResponse("El registro ha sido eliminado.", null, 200);
	} // delete



  // Consultas
	public function fecha($fecha = null) {
		$db = db_connect();
		$builder =	$db->table('rendicion_caja AS rc');
					$builder->select('rc.*');
					$builder->where('rc.deleted', null);
					$builder->where('rc.fecha', $fecha);
          $builder->orderBy('rc.id_rendicion_caja', 'DESC');
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
	}

}