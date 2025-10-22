<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Services;

use App\Models\LogsModel;
use App\Models\ColaboradoresModel;
use App\Models\OrganizacoesModel;


use App\Models\TesteModel;

class Teste extends BaseController
{
	
    protected $testeModel;
    protected $LogsModel;
    protected $ColaboradoresModel;
    protected $OrganizacoesModel;
    protected $organizacao;
    protected $codOrganizacao;
    protected $validation;
	
	public function __construct()
	{
		
        helper(['seguranca', 'formularios']);
        verificaSeguranca($this, session(), base_url());
        $this->LogsModel = new LogsModel();
        $this->ColaboradoresModel = new ColaboradoresModel();
        $this->OrganizacoesModel = new OrganizacoesModel();
	    $this->testeModel = new TesteModel();
		
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

		$permissao = verificaPermissao('Teste', 'listar');
		if ($permissao == 0) {
			echo mensagemAcessoNegado(session()->organizacoes);
			$this->LogsModel->inserirLog('Acesso indevido ao Módulo Teste', session()->codColaborador);
			exit();
		}
		
	    $data = [
                'controller'    	=> 'teste',
                'title'     		=> 'teste'				
			];
		
		return view('teste', $data);
			
	}

	public function getAll()
	{
 		$response = $data['data'] = array();	

		$result = $this->testeModel->select()->findAll();
		
		foreach ($result as $key => $value) {
							
			$ops = '<div class="btn-group mt-0">';
			$ops .= '<button type="button" class="border btn btn-sm dropdown-toggle text-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			$ops .= '<i class="fa-solid fa-pen-square"></i>  </button>';
			$ops .= '<div class="dropdown-menu">';
			$ops .= '<a class="dropdown-item text-primary" onClick="save('. $value->codTeste .')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '<div class="dropdown-divider"></div>';
			$ops .= '<a class="dropdown-item text-danger" onClick="remove('. $value->codTeste .')"><i class="fa-solid fa-trash"></i>   ' .  lang("App.delete")  . '</a>';
			$ops .= '</div></div>';

			$data['data'][$key] = array(
				$value->codTeste,
$value->descricao,
$value->tipo,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('codTeste');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->testeModel->where('codTeste' ,$id)->first();
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
	{
        $response = array();

		$fields['codTeste'] = $this->request->getPost('codTeste');
$fields['descricao'] = $this->request->getPost('descricao');
$fields['tipo'] = $this->request->getPost('tipo');


        $this->validation->setRules([
			            'descricao' => ['label' => 'Descricao', 'rules' => 'required|min_length[0]|max_length[20]'],
            'tipo' => ['label' => 'Tipo', 'rules' => 'required|numeric|min_length[0]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->testeModel->insert($fields)) {
												
                $response['success'] = true;
                $response['messages'] = lang("App.insert-success") ;	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("App.insert-error") ;
				
            }
        }
		
        return $this->response->setJSON($response);
	}

	public function edit()
	{
        $response = array();
		
		$fields['codTeste'] = $this->request->getPost('codTeste');
$fields['descricao'] = $this->request->getPost('descricao');
$fields['tipo'] = $this->request->getPost('tipo');


        $this->validation->setRules([
			            'descricao' => ['label' => 'Descricao', 'rules' => 'required|min_length[0]|max_length[20]'],
            'tipo' => ['label' => 'Tipo', 'rules' => 'required|numeric|min_length[0]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->testeModel->update($fields['codTeste'], $fields)) {
				
                $response['success'] = true;
                $response['messages'] = lang("App.update-success");	
				
            } else {
				
                $response['success'] = false;
                $response['messages'] = lang("App.update-error");
				
            }
        }
		
        return $this->response->setJSON($response);	
	}
	
	public function remove()
	{
		$response = array();
		
		$id = $this->request->getPost('codTeste');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->testeModel->where('codTeste', $id)->delete()) {
								
				$response['success'] = true;
				$response['messages'] = lang("App.delete-success");	
				
			} else {
				
				$response['success'] = false;
				$response['messages'] = lang("App.delete-error");
				
			}
		}	
	
        return $this->response->setJSON($response);		
	}	
		
}	
