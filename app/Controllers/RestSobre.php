<?php

namespace App\Controllers;

use MyRestApi;
use CodeIgniter\Controller;
use App\Models\SobreModel;
use App\Models\LibrosModel;
use App\Models\SalidaProductosModel;
use App\Models\InventarioModel;

class RestSobre extends MyRestApi
{
	protected $modelName = 'App\Models\SobreModel';
	protected $format	 = 'json';


	public function index()
	{
		return $this->genericResponse($this->model->findAll(), null, 200);
	}

	public function create() {
		$sobre = new SobreModel();
		$idSobre = $sobre->insert([
			'rut' 										=> $this->request->getPost('rut'),
			"cliente_id" 							=> $this->request->getPost('cliente_id'),
			"nombre" 									=> $this->request->getPost('nombre'),
			"tipo_de_lente" 					=> $this->request->getPost('tipo_de_lente'),
			"numero_pedido" 					=> $this->request->getPost('numero_pedido'),
			"fono" 										=> $this->request->getPost('fono'),
			"email" 									=> $this->request->getPost('email'),
			"lejos_od" 								=> $this->request->getPost('lejos_od'),
			"lejos_esf1" 							=> $this->request->getPost('lejos_esf1'),
			"lejos_cil1" 							=> $this->request->getPost('lejos_cil1'),
			"lejos_oi" 								=> $this->request->getPost('lejos_oi'),
			"lejos_esf2" 							=> $this->request->getPost('lejos_esf2'),
			"lejos_cil2" 							=> $this->request->getPost('lejos_cil2'),
			"cerca_od" 								=> $this->request->getPost('cerca_od'),
			"cerca_esf1" 							=> $this->request->getPost('cerca_esf1'),
			"cerca_cil1" 							=> $this->request->getPost('cerca_cil1'),
			"cerca_oi" 								=> $this->request->getPost('cerca_oi'),
			"cerca_esf2" 							=> $this->request->getPost('cerca_esf2'),
			"cerca_cil2" 							=> $this->request->getPost('cerca_cil2'),
			"cerca_add" 							=> $this->request->getPost('cerca_add'),
			"cerca_dp" 								=> $this->request->getPost('cerca_dp'),
			"cerca_h" 								=> $this->request->getPost('cerca_h'),
			"tipo_de_cristal" 				=> $this->request->getPost('tipo_de_cristal'),
			"lejos" 									=> $this->request->getPost('lejos'),
			"cerca" 									=> $this->request->getPost('cerca'),
			"profesional" 						=> $this->request->getPost('profesional'),
			"fecha_de_receta" 				=> $this->request->getPost('fecha_de_receta'),
			"armazon_lejos" 					=> $this->request->getPost('armazon_lejos'),
			"armazon_lejos_id" 				=> $this->request->getPost('armazon_lejos_id'),
			"armazon_lejos_cantidad" 	=> $this->request->getPost('armazon_lejos_cantidad'),
			"armazon_cerca" 					=> $this->request->getPost('armazon_cerca'),
			"armazon_cerca_id" 				=> $this->request->getPost('armazon_cerca_id'),
			"armazon_cerca_cantidad" 	=> $this->request->getPost('armazon_cerca_cantidad'),
			"total" 									=> $this->request->getPost('total'),
			"abono" 									=> $this->request->getPost('abono_pagar'),
			"saldo" 									=> $this->request->getPost('saldo_diferencia'),
			"observaciones" 					=> $this->request->getPost('observaciones'),
			"forma_de_pago" 					=> $this->request->getPost('forma_de_pago'),
		]);

		// Crear libro de óptica
		$ingresoLibro = new LibrosModel();
		$id = $ingresoLibro->insert([
			'cliente_id'        => $this->request->getPost('cliente_id'),
			'lejosODEsferico'   => $this->request->getPost('lejos_esf1'),
			'lejosODCilindrico' => $this->request->getPost('lejos_cil1'),
			'lejosODEje'        => $this->request->getPost(''),
			'lejosODTriangulo'  => $this->request->getPost(''),
			'lejosODBase'       => $this->request->getPost(''),
			'lejosODDp'         => $this->request->getPost(''),
			'cercaODEsferico'   => $this->request->getPost('cerca_esf1'),
			'cercaODCilindrico' => $this->request->getPost('cerca_cil1'),
			'cercaODEje'        => $this->request->getPost(''),
			'cercaODTriangulo'  => $this->request->getPost(''),
			'cercaODBase'       => $this->request->getPost(''),
			'cercaODDp'         => $this->request->getPost(''),
			'lejosOIEsferico'   => $this->request->getPost(''),
			'lejosOICilindrico' => $this->request->getPost(''),
			'lejosOIEje'        => $this->request->getPost(''),
			'lejosOITriangulo'  => $this->request->getPost(''),
			'lejosOIBase'       => $this->request->getPost(''),
			'lejosOIDp'         => $this->request->getPost(''),
			'cercaOIEsferico'   => $this->request->getPost(''),
			'cercaOICilindrico' => $this->request->getPost(''),
			'cercaOIEje'        => $this->request->getPost(''),
			'cercaOITriangulo'  => $this->request->getPost(''),
			'cercaOIBase'       => $this->request->getPost(''),
			'cercaOIDp'         => $this->request->getPost(''),
			'doctor'            => $this->request->getPost('profesional'),
			'armazon'           => $this->request->getPost('armazon_lejos') ?  $this->request->getPost('armazon_lejos') :  $this->request->getPost('armazon_cerca'),
			'cristales'         => $this->request->getPost(''),
			'observaciones'     => $this->request->getPost('observaciones')
		]);
		return $this->genericResponse($this->model->find($idSobre), null, 200);
	}

	public function delete($id = null) {
		$sobre 						= new SobreModel();
		$salidaProductos 	= new salidaProductosModel();
		$inventario 			= new InventarioModel();

		if ($this->model->find($id) == null) return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);

		$sobre->delete($id);

		$salidaProductos->where('sobre_id', $id);
		$salidaProductos->delete();

		$db = db_connect();
		$builder = $db->table('productos_salida AS ps');
		$builder->select('ps.id_producto_salida');
		$builder->where('ps.sobre_id', $id);
		$id_producto_salida = $builder->get()->getResultArray();

		$inventario->where('salida_id', $id_producto_salida[0]);
		$inventario->delete();


		return $this->genericResponse("El producto ingresado ha sido eliminado.", null, 200);
	} // delete

	public function show($id = null) {
		if ($this->model->find($id) == null) return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);
		
		return $this->genericResponse($this->model->find($id), null, 200);
	} // show

	public function update($id = null){
		$sobre = new SobreModel();
		$data = $this->request->getRawInput();
		$sobre->update($id, [
			'rut' 										=> $data['rut'] !== (null) ? $data['rut'] : (null),
			"cliente_id" 							=> $data['cliente_id'] !== (null) ? $data['cliente_id'] : (null),
			"nombre" 									=> $data['nombre'] !== (null) ? $data['nombre'] : (null),
			"tipo_de_lente" 					=> $data['tipo_de_lente'] !== (null) ? $data['tipo_de_lente'] : (null),
			"numero_pedido" 					=> $data['numero_pedido'] !== (null) ? $data['numero_pedido'] : (null),
			"fono" 										=> $data['fono'] !== (null) ? $data['fono'] : (null),
			"email" 									=> $data['email'] !== (null) ? $data['email'] : (null),
			"lejos_od" 								=> $data['lejos_od'] !== (null) ? $data['lejos_od'] : (null),
			"lejos_esf1" 							=> $data['lejos_esf1'] !== (null) ? $data['lejos_esf1'] : (null),
			"lejos_cil1" 							=> $data['lejos_cil1'] !== (null) ? $data['lejos_cil1'] : (null),
			"lejos_oi" 								=> $data['lejos_oi'] !== (null) ? $data['lejos_oi'] : (null),
			"lejos_esf2" 							=> $data['lejos_esf2'] !== (null) ? $data['lejos_esf2'] : (null),
			"lejos_cil2" 							=> $data['lejos_cil2'] !== (null) ? $data['lejos_cil2'] : (null),
			"cerca_od" 								=> $data['cerca_od'] !== (null) ? $data['cerca_od'] : (null),
			"cerca_esf1" 							=> $data['cerca_esf1'] !== (null) ? $data['cerca_esf1'] : (null),
			"cerca_cil1" 							=> $data['cerca_cil1'] !== (null) ? $data['cerca_cil1'] : (null),
			"cerca_oi" 								=> $data['cerca_oi'] !== (null) ? $data['cerca_oi'] : (null),
			"cerca_esf2" 							=> $data['cerca_esf2'] !== (null) ? $data['cerca_esf2'] : (null),
			"cerca_cil2" 							=> $data['cerca_cil2'] !== (null) ? $data['cerca_cil2'] : (null),
			"cerca_add" 							=> $data['cerca_add'] !== (null) ? $data['cerca_add'] : (null),
			"cerca_dp" 								=> $data['cerca_dp'] !== (null) ? $data['cerca_dp'] : (null),
			"cerca_h" 								=> $data['cerca_h'] !== (null) ? $data['cerca_h'] : (null),
			"tipo_de_cristal" 				=> $data['tipo_de_cristal'] !== (null) ? $data['tipo_de_cristal'] : (null),
			"lejos" 									=> $data['lejos'] !== (null) ? $data['lejos'] : (null),
			"cerca" 									=> $data['cerca'] !== (null) ? $data['cerca'] : (null),
			"profesional" 						=> $data['profesional'] !== (null) ? $data['profesional'] : (null),
			"fecha_de_receta" 				=> $data['fecha_de_receta'] !== (null) ? $data['fecha_de_receta'] : (null),
			"armazon_lejos" 					=> $data['armazon_lejos'] !== (null) ? $data['armazon_lejos'] : (null),
			"armazon_lejos_id" 				=> $data['armazon_lejos_id'] !== (null) ? $data['armazon_lejos_id'] : (null),
			"armazon_lejos_cantidad" 	=> $data['armazon_lejos_cantidad'] !== (null) ? $data['armazon_lejos_cantidad'] : (null),
			"armazon_cerca" 					=> $data['armazon_cerca'] !== (null) ? $data['armazon_cerca'] : (null),
			"armazon_cerca_id" 				=> $data['armazon_cerca_id'] !== (null) ? $data['armazon_cerca_id'] : (null),
			"armazon_cerca_cantidad" 	=> $data['armazon_cerca_cantidad'] !== (null) ? $data['armazon_cerca_cantidad'] : (null),
			"total" 									=> $data['total'] !== (null) ? $data['total'] : (null),
			"abono" 									=> $data['abono_pagar'] !== (null) ? $data['abono_pagar'] : (null),
			"saldo" 									=> $data['saldo_diferencia'] !== (null) ? $data['saldo_diferencia'] : (null),
			"observaciones" 					=> $data['observaciones'] !== (null) ? $data['observaciones'] : (null),
			"forma_de_pago" 					=> $data['forma_de_pago'] !== (null) ? $data['forma_de_pago'] : (null)
		]);
		return $this->genericResponse($this->model->find($id), null, 200);
	}

	public function cliente($id = null) {
		// Get all sobres from a specific client
		$db = db_connect();
		$builder = $db->table('sobre AS s');
		$builder->select('s.*');
		$builder->join('clientes AS c', 'c.id_cliente = s.cliente_id');
		$builder->where('s.cliente_id', $id);
		$builder->where('s.deleted', null);
		$builder->orderBy('s.id_sobre', 'desc');
		$sobres = $builder->get();
		return
			$this->genericResponse($sobres->getResultArray(), null, 200);
	}
}