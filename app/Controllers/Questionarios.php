<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Services;

use App\Models\LogsModel;
use App\Models\ColaboradoresModel;
use App\Models\OrganizacoesModel;


use App\Models\QuestionariosModel;

class Questionarios extends BaseController
{
	
    protected $questionariosModel;
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
	    $this->questionariosModel = new QuestionariosModel();
		
       	$this->validation =  \Config\Services::validation();
		
	}
	
	public function index()
	{

		$permissao = pegaPermissao('Questionarios', 'listar');
		if ($permissao == 0) {
			echo mensagemAcessoNegado(session()->organizacoes);
			$this->LogsModel->inserirLog(lang("App.deny-list") . 'Questionarios', session()->codColaborador);
			exit();
		}
		
	    $data = [
                'controller'    	=> 'questionarios',
                'title'     		=> 'Questionários'				
			];
		
		return view('questionarios', $data);
			
	}

	public function getAll()
	{
 		$response = $data['data'] = array();	

		$result = $this->questionariosModel->pegaTudo();
		
		foreach ($result as $key => $value) {
							
	

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-primary" onclick="saveQuestionarios(' . $value->codQuestionario . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-placement="top" title="Remover" onclick="removeQuestionarios(' . $value->codQuestionario . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
								$value->codQuestionario,
				$value->titulo,
				$value->resumo,
				$value->codOrganizacao,
				$value->dataCriacao,
				$value->dataAtualizacao,
				$value->dataInicio,
				$value->dataEncerramento,
				$value->termoAceite,
				$value->instrucoes,
				$value->codAutor,
				$value->ativo,
				$value->codVisibilidade,

				$ops				
			);
		} 

		return $this->response->setJSON($data);		
	}
	
	public function getOne()
	{
 		$response = array();
		
		$id = $this->request->getPost('codQuestionario');
		
		if ($this->validation->check($id, 'required|numeric')) {
			
			$data = $this->questionariosModel->pegaPorCodigo($id);
			
			return $this->response->setJSON($data);	
				
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}	
		
	}	

	public function add()
	{
        $response = array();


		if (pegaPermissao('Questionarios', 'adicionar') == 0) {
			$response['messages'] = lang("App.deny-add");
			return $this->response->setJSON($response);
		}


				$fields['codQuestionario'] = $this->request->getPost('codQuestionario');
		$fields['titulo'] = $this->request->getPost('titulo');
		$fields['resumo'] = $this->request->getPost('resumo');
		$fields['codOrganizacao'] = $this->request->getPost('codOrganizacao');
		$fields['dataCriacao'] = $this->request->getPost('dataCriacao');
		$fields['dataAtualizacao'] = $this->request->getPost('dataAtualizacao');
		$fields['dataInicio'] = $this->request->getPost('dataInicio');
		$fields['dataEncerramento'] = $this->request->getPost('dataEncerramento');
		$fields['termoAceite'] = $this->request->getPost('termoAceite');
		$fields['instrucoes'] = $this->request->getPost('instrucoes');
		$fields['codAutor'] = $this->request->getPost('codAutor');
		$fields['ativo'] = $this->request->getPost('ativo');
		$fields['codVisibilidade'] = $this->request->getPost('codVisibilidade');


        $this->validation->setRules([
			            'codQuestionario' => ['label' => 'Código', 'rules' => 'permit_empty'],
            'titulo' => ['label' => 'Titulo', 'rules' => 'required|min_length[0]|max_length[150]'],
            'resumo' => ['label' => 'Resumo', 'rules' => 'permit_empty|min_length[0]'],
            'codOrganizacao' => ['label' => 'CodOrganizacao', 'rules' => 'required|numeric|min_length[0]|max_length[11]'],
            'dataCriacao' => ['label' => 'DataCriacao', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'dataAtualizacao' => ['label' => 'DataAtualizacao', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'dataInicio' => ['label' => 'DataInicio', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'dataEncerramento' => ['label' => 'DataEncerramento', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'termoAceite' => ['label' => 'TermoAceite', 'rules' => 'permit_empty|min_length[0]'],
            'instrucoes' => ['label' => 'Instrucoes', 'rules' => 'permit_empty|min_length[0]'],
            'codAutor' => ['label' => 'CodAutor', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'ativo' => ['label' => 'Ativo', 'rules' => 'permit_empty|min_length[0]|max_length[11]'],
            'codVisibilidade' => ['label' => 'Visibilidade', 'rules' => 'permit_empty|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {

            if ($this->questionariosModel->insert($fields)) {
												
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


		if (pegaPermissao('Questionarios', 'editar') == 0) {
			$response['messages'] = lang("App.deny-edit");
			return $this->response->setJSON($response);
		}
		
				$fields['codQuestionario'] = $this->request->getPost('codQuestionario');
		$fields['titulo'] = $this->request->getPost('titulo');
		$fields['resumo'] = $this->request->getPost('resumo');
		$fields['codOrganizacao'] = $this->request->getPost('codOrganizacao');
		$fields['dataCriacao'] = $this->request->getPost('dataCriacao');
		$fields['dataAtualizacao'] = $this->request->getPost('dataAtualizacao');
		$fields['dataInicio'] = $this->request->getPost('dataInicio');
		$fields['dataEncerramento'] = $this->request->getPost('dataEncerramento');
		$fields['termoAceite'] = $this->request->getPost('termoAceite');
		$fields['instrucoes'] = $this->request->getPost('instrucoes');
		$fields['codAutor'] = $this->request->getPost('codAutor');
		$fields['ativo'] = $this->request->getPost('ativo');
		$fields['codVisibilidade'] = $this->request->getPost('codVisibilidade');


        $this->validation->setRules([
			            'codQuestionario' => ['label' => 'Código', 'rules' => 'required|numeric|min_length[0]|max_length[11]'],
            'titulo' => ['label' => 'Titulo', 'rules' => 'required|min_length[0]|max_length[150]'],
            'resumo' => ['label' => 'Resumo', 'rules' => 'permit_empty|min_length[0]'],
            'codOrganizacao' => ['label' => 'CodOrganizacao', 'rules' => 'required|numeric|min_length[0]|max_length[11]'],
            'dataCriacao' => ['label' => 'DataCriacao', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'dataAtualizacao' => ['label' => 'DataAtualizacao', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'dataInicio' => ['label' => 'DataInicio', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'dataEncerramento' => ['label' => 'DataEncerramento', 'rules' => 'permit_empty|valid_date|min_length[0]'],
            'termoAceite' => ['label' => 'TermoAceite', 'rules' => 'permit_empty|min_length[0]'],
            'instrucoes' => ['label' => 'Instrucoes', 'rules' => 'permit_empty|min_length[0]'],
            'codAutor' => ['label' => 'CodAutor', 'rules' => 'permit_empty|numeric|min_length[0]|max_length[11]'],
            'ativo' => ['label' => 'Ativo', 'rules' => 'permit_empty|min_length[0]|max_length[11]'],
            'codVisibilidade' => ['label' => 'Visibilidade', 'rules' => 'permit_empty|min_length[0]|max_length[11]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form

        } else {

            if ($this->questionariosModel->update($fields['codQuestionario'], $fields)) {
				
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


		if (pegaPermissao('Questionarios', 'deletar') == 0) {
			$response['messages'] = lang("App.deny-delete");
			return $this->response->setJSON($response);
		}

		
		$id = $this->request->getPost('codQuestionario');
		
		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
			
		} else {	
		
			if ($this->questionariosModel->where('codQuestionario', $id)->delete()) {
								
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
