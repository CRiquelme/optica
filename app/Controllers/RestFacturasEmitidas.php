<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\FacturasEmitidasModel;

class RestFacturasEmitidas extends MyRestApi
{
    protected $modelName = 'App\Models\FacturasEmitidasModel';
    protected $format	 = 'json';
    
    public function index()
	{
        $db = db_connect();
		$builder =	$db->table('facturas_emitidas AS fe');
		$builder->select('fe.*, t.nombre_tienda, ce.nombre AS nombre_cliente');
		$builder->join('tiendas as t', 'fe.tienda_id = t.id_tienda');
		$builder->join('clientes_empresas as ce', 'fe.cliente_id = ce.id_cliente_empresa');
        $builder->where('fe.deleted', null);
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
    }

    public function create() 
	{
        $facturasEmitidas = new FacturasEmitidasModel();
        if ($this->validate('facturasEmitidas')) {
            $id = $facturasEmitidas->insert([
				'nc'                        => $this->request->getPost('nc'),
				'anula_factura'             => $this->request->getPost('anula_factura'),
				'numero_factura' 			=> $this->request->getPost('numero_factura'),
				'fecha' 			        => $this->request->getPost('fecha'),
				'cliente_id' 			    => $this->request->getPost('cliente_id'),
				'monto' 			        => $this->request->getPost('monto'),
				'forma_pago' 			    => $this->request->getPost('forma_pago'),
				'numero_documento' 			=> $this->request->getPost('numero_documento'),
				'fecha_emision' 			=> $this->request->getPost('fecha_emision'),
				'fecha_recibo_documento' 	=> $this->request->getPost('fecha_recibo_documento'),
				'comentario' 			    => $this->request->getPost('comentario'),
				'tienda_id' 			    => $this->request->getPost('tienda_id')
            ]);
            
			return $this->genericResponse($this->model->find($id), null, 200);
        }

        $validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
    }

    public function delete($id=null)
	{
		$facturasEmitidas = new FacturasEmitidasModel();

		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Factura emitida no existe."), 500);
		}
		
		$facturasEmitidas->delete($id);
		
		return $this->genericResponse("La factura ha sido eliminada.", null, 200);
    } // delete

    public function show($id=null)
	{
		if($this->model->find($id) == null) {
			return $this->genericResponse(null, array("Mensaje" => "Factura emitida no existe."), 500);
		}
		return $this->genericResponse($this->model->find($id), null, 200);

    } // show

    public function update($id = null) 
	{
		$facturasEmitidas = new FacturasEmitidasModel();

        $data = $this->request->getRawInput();

		if ($this->validate('facturasEmitidasEdit')) {

			$facturasEmitidas->update($id, [
                'nc'                        => empty($data['nc']) ? null : $data['nc'],
                'anula_factura'             => empty($data['anula_factura']) ? null : $data['anula_factura'],
				'numero_factura' 			=> empty($data['numero_factura']) ? null : $data['numero_factura'],
				'fecha' 			        => empty($data['fecha']) ? null : $data['fecha'],
				'cliente_id' 			    => empty($data['cliente_id']) ? null :  $data['cliente_id'],
				'monto' 			        => empty($data['monto']) ? null : $data['monto'],
				'forma_pago' 			    => empty($data['forma_pago']) ? null : $data['forma_pago'],
				'numero_documento' 			=> empty($data['numero_documento']) ? null : $data['numero_documento'],
				'fecha_emision' 			=> empty($data['fecha_emision']) ? null : $data['fecha_emision'],
				'fecha_recibo_documento' 	=> empty($data['fecha_recibo_documento']) ? null : $data['fecha_recibo_documento'],
				'comentario' 			    => empty($data['comentario']) ? null : $data['comentario'],
				'tienda_id' 			    => empty($data['tienda_id']) ? null : $data['tienda_id'],
			]);
			// return $this->respond($this->model->find($id));
			return $this->genericResponse($this->model->find($id), null, 200);
		}

		$validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
	}

}