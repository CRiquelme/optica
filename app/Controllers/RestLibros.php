<?php
namespace App\Controllers;
use MyRestApi;
use CodeIgniter\Controller;
use App\Models\LibrosModel;

class RestLibros extends MyRestApi {
  protected $modelName = 'App\Models\LibrosModel';
  protected $format	 = 'json';

  public function index() {
    $db = db_connect();
    $builder = $db->table('libros');
    $builder->select('*');
    $builder->orderBy('id_libro', 'DESC');
    $query = $builder->get();
    return $this->genericResponse($query->getResultArray(), null, 200);
  } // index()

  public function create() {
    $ingresoLibro = new LibrosModel();
    if($this->validate('libros')) {
      $id = $ingresoLibro->insert([
        'cliente_id'        => $this->request->getPost('cliente_id'),
        'lejosODEsferico'   => $this->request->getPost('lejosODEsferico'),
        'lejosODCilindrico' => $this->request->getPost('lejosODCilindrico'),
        'lejosODEje'        => $this->request->getPost('lejosODEje'),
        'lejosODTriangulo'  => $this->request->getPost('lejosODTriangulo'),
        'lejosODBase'       => $this->request->getPost('lejosODBase'),
        'lejosODDp'         => $this->request->getPost('lejosODDp'),
        'cercaODEsferico'   => $this->request->getPost('cercaODEsferico'),
        'cercaODCilindrico' => $this->request->getPost('cercaODCilindrico'),
        'cercaODEje'        => $this->request->getPost('cercaODEje'),
        'cercaODTriangulo'  => $this->request->getPost('cercaODTriangulo'),
        'cercaODBase'       => $this->request->getPost('cercaODBase'),
        'cercaODDp'         => $this->request->getPost('cercaODDp'),
        'lejosOIEsferico'   => $this->request->getPost('lejosOIEsferico'),
        'lejosOICilindrico' => $this->request->getPost('lejosOICilindrico'),
        'lejosOIEje'        => $this->request->getPost('lejosOIEje'),
        'lejosOITriangulo'  => $this->request->getPost('lejosOITriangulo'),
        'lejosOIBase'       => $this->request->getPost('lejosOIBase'),
        'lejosOIDp'         => $this->request->getPost('lejosOIDp'),
        'cercaOIEsferico'   => $this->request->getPost('cercaOIEsferico'),
        'cercaOICilindrico' => $this->request->getPost('cercaOICilindrico'),
        'cercaOIEje'        => $this->request->getPost('cercaOIEje'),
        'cercaOITriangulo'  => $this->request->getPost('cercaOITriangulo'),
        'cercaOIBase'       => $this->request->getPost('cercaOIBase'),
        'cercaOIDp'         => $this->request->getPost('cercaOIDp'),
        'doctor'            => $this->request->getPost('doctor'),
        'armazon'           => $this->request->getPost('armazon'),
        'cristales'         => $this->request->getPost('cristales'),
        'observaciones'     => $this->request->getPost('observaciones')
      ]);
      return $this->genericResponse($this->model->find($id), null, 200);
    }
    $validation = \Config\Services::validation();
		return $this->genericResponse(null, $validation->getErrors(), 500);
  } // create()

  public function update($id = null) {
    $ingresoLibro = new LibrosModel();

    $data = $this->request->getRawInput();
    
    if($this->validate('libro_editar')) {
      $ingresoLibro->update($id, [
        'lejosODEsferico'   => $data['lejosODEsferico'] ? $data['lejosODEsferico'] : (null),
        'lejosODCilindrico' => $data['lejosODCilindrico'] ? $data['lejosODCilindrico'] : (null),
        'lejosODEje'        => $data['lejosODEje'] ? $data['lejosODEje'] : (null),
        'lejosODTriangulo'  => $data['lejosODTriangulo'] ? $data['lejosODTriangulo'] : (null),
        'lejosODBase'       => $data['lejosODBase'] ? $data['lejosODBase'] : (null),
        'lejosODDp'         => $data['lejosODDp'] ? $data['lejosODDp'] : (null),
        'cercaODEsferico'   => $data['cercaODEsferico'] ? $data['cercaODEsferico'] : (null),
        'cercaODCilindrico' => $data['cercaODCilindrico'] ? $data['cercaODCilindrico'] : (null),
        'cercaODEje'        => $data['cercaODEje'] ? $data['cercaODEje'] : (null),
        'cercaODTriangulo'  => $data['cercaODTriangulo'] ? $data['cercaODTriangulo'] : (null),
        'cercaODBase'       => $data['cercaODBase'] ? $data['cercaODBase'] : (null),
        'cercaODDp'         => $data['cercaODDp'] ? $data['cercaODDp'] : (null),
        'lejosOIEsferico'   => $data['lejosOIEsferico'] ? $data['lejosOIEsferico'] : (null),
        'lejosOICilindrico' => $data['lejosOICilindrico'] ? $data['lejosOICilindrico'] : (null),
        'lejosOIEje'        => $data['lejosOIEje'] ? $data['lejosOIEje'] : (null),
        'lejosOITriangulo'  => $data['lejosOITriangulo'] ? $data['lejosOITriangulo'] : (null),
        'lejosOIBase'       => $data['lejosOIBase'] ? $data['lejosOIBase'] : (null),
        'lejosOIDp'         => $data['lejosOIDp'] ? $data['lejosOIDp'] : (null),
        'cercaOIEsferico'   => $data['cercaOIEsferico'] ? $data['cercaOIEsferico'] : (null),
        'cercaOICilindrico' => $data['cercaOICilindrico'] ? $data['cercaOICilindrico'] : (null),
        'cercaOIEje'        => $data['cercaOIEje'] ? $data['cercaOIEje'] : (null),
        'cercaOITriangulo'  => $data['cercaOITriangulo'] ? $data['cercaOITriangulo'] : (null),
        'cercaOIBase'       => $data['cercaOIBase'] ? $data['cercaOIBase'] : (null),
        'cercaOIDp'         => $data['cercaOIDp'] ? $data['cercaOIDp'] : (null),
        'doctor'            => $data['doctor'],
        'armazon'           => $data['armazon'],
        'cristales'         => $data['cristales'],
        'observaciones'     => $data['observaciones']
      ]);
      return $this->genericResponse($this->model->find($id), null, 200);
    }
    $validation = \Config\Services::validation();
    return $this->genericResponse(null, $validation->getErrors(), 500);
  } // update()

  public function show ($id = null) {
    return $this->genericResponse($this->model->find($id), null, 200);
  } // show()

  public function delete($id=null) {
    $ingresoLibro = new LibrosModel();
    if ($this->model->find($id) === null) return $this->genericResponse(null, array("Mensaje" => "Ingreso no existe."), 500);
    $ingresoLibro->delete($id);
    return $this->genericResponse('El registro fue eliminado.', null, 200);
  } // delete()

  public function cliente($id=null) {
    // Get all books from a specific cliente
    $db = db_connect();
    $builder = $db->table('libros');
      $builder->select('*');
      $builder->where('cliente_id', $id);
      $builder->where('deleted', null);
      $builder->orderBy('id_libro', 'DESC');
    $query = $builder->get();
    return $this->genericResponse($query->getResultArray(), null, 200);
  } // cliente()

  public function fecha($fecha=null) {
    $db = db_connect();
    $builder = $db->table('libros AS l');
      $builder->select('l.*, c.nombre_cliente, c.rut');
      $builder->join('clientes AS c', 'l.cliente_id = c.id_cliente');
      $builder->where('DATE(l.created_at)', $fecha);
      $builder->where('l.deleted', null);
      $builder->orderBy('l.id_libro', 'DESC');
    $query = $builder->get();
    return $this->genericResponse($query->getResultArray(), null, 200);
  } // fecha()
  
}
?>