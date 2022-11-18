<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\ClientesModel;

class RestClientes extends MyRestApi {
  protected $modelName = 'App\Models\ClientesModel';
  protected $format	 = 'json';

  public function index() {
    $db = db_connect();
    $builder = $db->table('clientes');
    $builder->select('*');
    $builder->orderBy('created_at', 'DESC');
    $query = $builder->get();
    return $this->genericResponse($query->getResultArray(), null, 200);
  } // index()

  public function create() {
    $ingresoCliente = new ClientesModel();
    // if($this->validate('clientes')) {
      $id = $ingresoCliente->insert([
        'rut'             => $this->request->getPost('rut'),
        'nombre_cliente'  => $this->request->getPost('nombre_cliente'),
        'telefono'        => $this->request->getPost('telefono'),
        'celular'         => $this->request->getPost('celular'),
        'direccion'       => $this->request->getPost('direccion')
      ]);
      return $this->genericResponse($this->model->find($id), null, 200);
    // }
    // $validation = \Config\Services::validation();
    // return $this->genericResponse(null, $validation->getErrors(), 400);
  } // create()

  public function show ($id = null) {
    // return $this->genericResponse($this->model->find($id), null, 200);
    if ($this->model->find($id) == null) return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);
		
		return $this->genericResponse($this->model->find($id), null, 200);
  } // show()

  // Consulta
  public function fromRut ($rut = null) {
    $db = db_connect();
		$builder =	$db->table('clientes AS c');
      $builder->select('c.*');
      $builder->where('c.deleted', null);
      $builder->where('c.rut', $rut);
		$query = $builder->get();
		return  $this->genericResponse($query->getResultArray(), null, 200);
  } // fromRut()
}
?>