<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Services;

use App\Models\LogsModel;
use App\Models\ColaboradoresModel;
use App\Models\OrganizacoesModel;


use App\Models\@@@uModelName@@@;

class @@@uControlerName@@@ extends BaseController
{
	
    protected $@@@modelName@@@;
    protected $LogsModel;
    protected $ColaboradoresModel;
    protected $OrganizacoesModel;
    protected $organizacao;
    protected $codOrganizacao;
    protected $validation;
	
	public function __construct()
	{
		
		helper(['notificacoes', 'seguranca', 'formularios', 'pdf','alertas']);
        verificaSeguranca($this, session(), base_url());
        $this->LogsModel = new LogsModel();
        $this->ColaboradoresModel = new ColaboradoresModel();
        $this->OrganizacoesModel = new OrganizacoesModel();
	    $this->@@@modelName@@@ = new @@@uModelName@@@();
		
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

		$permissao = pegaPermissao('@@@uControlerName@@@', 'listar');
		if ($permissao == 0) {
			echo mensagemAcessoNegado(session()->organizacoes);
			$this->LogsModel->inserirLog(lang("App.deny-list") . '@@@uControlerName@@@', session()->codColaborador);
			exit();
		}
		
	    $data = [
                'controller'    	=> '@@@controlerName@@@',
                'title'     		=> '@@@crudTitle@@@'				
			];
		
		return view('@@@controlerName@@@', $data);
			
	}

	public function getAll()
	{
 		$response = $data['data'] = array();	

		$result = $this->@@@modelName@@@->pegaTudo();
		
		foreach ($result as $key => $value) {
							
	

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-primary" onclick="save@@@uControlerName@@@(' . $value->@@@primaryKey@@@ . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-placement="top" title="Remover" onclick="remove@@@uControlerName@@@(' . $value->@@@primaryKey@@@ . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				@@@ciDataTable@@@
				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('@@@primaryKey@@@');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->@@@modelName@@@->pegaPorCodigo($id);
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
	{
        $response = array();


		if (pegaPermissao('@@@uControlerName@@@', 'adicionar') == 0) {
			$response['messages'] = lang("App.deny-add");
			return $this->response->setJSON($response);
		}


		@@@ciFields@@@

        $this->validation->setRules([
			@@@ciValidationAdd@@@
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->@@@modelName@@@->insert($fields)) {
												
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


		if (pegaPermissao('@@@uControlerName@@@', 'editar') == 0) {
			$response['messages'] = lang("App.deny-edit");
			return $this->response->setJSON($response);
		}
		
		@@@ciFields@@@

        $this->validation->setRules([
			@@@ciValidationEdit@@@
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->@@@modelName@@@->update($fields['@@@primaryKey@@@'], $fields)) {
				
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


		if (pegaPermissao('@@@uControlerName@@@', 'deletar') == 0) {
			$response['messages'] = lang("App.deny-delete");
			return $this->response->setJSON($response);
		}

		
		$id = $this->request->getPost('@@@primaryKey@@@');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->@@@modelName@@@->where('@@@primaryKey@@@', $id)->delete()) {
								
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
