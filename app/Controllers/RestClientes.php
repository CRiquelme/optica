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
    $builder->orderBy('id_cliente', 'DESC');
    $query = $builder->get();
    return $this->genericResponse($query->getResultArray(), null, 200);
  } // index()

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