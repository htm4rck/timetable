<?php
class EmployeeC
{
    private $response;
    public function listar()
    {
        $this->response['error']=false;
        $this->response['message']='Solicitud Completada';
        $this->response['content']=EmployeeM::listarM();
        echo json_encode($this->response);
    }
}
$action = $_GET['action']||'listar';
$data = file_get_contents('php://input');
switch ($action) {
    case 'paginate':
        $e = new EmployeeC();
        $e->listar();
        break;

    default:
        # code...
        break;
}
// Los convertimos en un array
//$data = json_decode($data, true);
//echo ($data['idcliente']);
//echo $_GET['x'];
