<?php
// Desenvolvido por CDS Saúde Sistemas

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Services;

use App\Models\LogsModel;
use App\Models\ColaboradoresModel;
use App\Models\OrganizacoesModel;

use App\Models\PerfilColaboradoresMembroModel;

class PerfilColaboradoresMembro extends BaseController
{

	protected $PerfilColaboradoresMembroModel;
	protected $ColaboradoresModel;
	protected $OrganizacoesModel;
	protected $Organizacao;
	protected $codOrganizacao;
	protected $validation;

	public function __construct()
	{

		helper(['seguranca', 'formularios']);
		verificaSeguranca($this, session(), base_url());
		$this->PerfilColaboradoresMembroModel = new PerfilColaboradoresMembroModel();
		$this->OrganizacoesModel = new OrganizacoesModel();
		$this->LogsModel = new LogsModel(); // $this->LogsModel->inserirLog('descrição da ocorrencia',$codColaborador);
		$this->validation =  \Config\Services::validation();
		$this->codOrganizacao = session()->codOrganizacao;
		$this->organizacao =  $this->OrganizacoesModel->pegaOrganizacao($this->codOrganizacao);


	}

	public function index()
	{
		
		$permissao = verificaPermissao('PerfilColaboradoresMembro', 'listar');
		if ($permissao == 0) {
			echo mensagemAcessoNegado(session()->organizacoes);
			$this->LogsModel->inserirLog('Acesso indevido ao Módulo PerfilColaboradoresMembro', session()->codColaborador);
			exit();
		}
		$data = [
			'controller'    	=> 'perfilColaboradoresMembro',
			'title'     		=> 'Membros do Perfil'
		];
		return view('perfilColaboradoresMembro', $data);
	}

	public function getMembros()
	{
		$codPerfil = $this->request->getPost('codPerfil');
		$response = array();

		$data['data'] = array();

		$result = $this->PerfilColaboradoresMembroModel->pegaPorCodigoPerfil($codPerfil);

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editperfilColaboradoresMembro(' . $value->codColaboradorMembro . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="top" title="Remover" onclick="removeperfilColaboradoresMembro(' . $value->codColaboradorMembro . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			if ($value->dataEncerramento == NULL) {
				$dataEncerramento = 'Indeterminado';
			} else {
				$dataEncerramento = $value->dataEncerramento;
			}


			$data['csrf_token'] =  csrf_token();
			$data['csrf_hash'] =  csrf_hash();
			$data['data'][$key] = array(
				$value->nomeExibicao,
				$value->dataInicio,
				$dataEncerramento,

				$ops,
			);
		}

		return $this->response->setJSON($data);
	}



	public function getAll()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->PerfilColaboradoresMembroModel->pegaTudo();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editperfilColaboradoresMembro(' . $value->codColaboradorMembro . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-xs btn-danger"  data-toggle="tooltip" data-placement="top" title="Remover" onclick="removeperfilColaboradoresMembro(' . $value->codColaboradorMembro . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			if ($value->dataEncerramento == NULL) {
				$dataEncerramento = 'Indeterminado';
			} else {
				$dataEncerramento = $value->dataEncerramento;
			}


			$data['csrf_token'] =  csrf_token();
			$data['csrf_hash'] =  csrf_hash();
			$data['data'][$key] = array(
				$value->nomeExibicao,
				$value->dataInicio,
				$dataEncerramento,

				$ops,
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('codColaboradorMembro');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->PerfilColaboradoresMembroModel->pegaPorCodigo($id);

			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		

		$response = array();

		$fields['codColaboradorMembro'] = $this->request->getPost('codColaboradorMembro');
		$fields['codColaborador'] = $this->request->getPost('codColaborador');
		$fields['codPerfil'] = $this->request->getPost('codPerfil');
		$fields['dataInicio'] = $this->request->getPost('dataInicio');
		if ($this->request->getPost('dataEncerramento') == NULL) {
			$fields['dataEncerramento'] = NULL;
		} else {
			$fields['dataEncerramento'] = $this->request->getPost('dataEncerramento');
		}
		$fields['dataCriacao'] = date('Y-m-d H:i');
		$fields['dataAtualizacao'] =  date('Y-m-d H:i');

		$this->validation->setRules([
			'codColaborador' => ['label' => 'Membro', 'rules' => 'required|numeric|max_length[11]'],
			'codPerfil' => ['label' => 'CodPerfil', 'rules' => 'required|numeric|max_length[11]'],
			'dataInicio' => ['label' => 'DataInicio', 'rules' => 'required|valid_date'],
			'dataEncerramento' => ['label' => 'DataEncerramento', 'rules' => 'permit_empty|valid_date'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->PerfilColaboradoresMembroModel->insert($fields)) {

				$response['success'] = true;
				$response['csrf_hash'] = csrf_hash();
				$response['messages'] = 'Informação inserida com sucesso';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Erro na inserção!';
			}
		}

		return $this->response->setJSON($response);
	}

	public function edit()
	{

		$response = array();

		$fields['codColaboradorMembro'] = $this->request->getPost('codColaboradorMembro');
		$fields['codColaborador'] = $this->request->getPost('codColaborador');
		$fields['codPerfil'] = $this->request->getPost('codPerfil');
		$fields['dataInicio'] = $this->request->getPost('dataInicio');
		if ($this->request->getPost('dataEncerramento') == NULL) {
			$fields['dataEncerramento'] = NULL;
		} else {
			$fields['dataEncerramento'] = $this->request->getPost('dataEncerramento');
		}

		$fields['dataAtualizacao'] =  date('Y-m-d H:i');


		$this->validation->setRules([
			'codColaboradorMembro' => ['label' => 'codColaboradorMembro', 'rules' => 'required|numeric|max_length[11]'],
			'codColaborador' => ['label' => 'Membro', 'rules' => 'required|numeric|max_length[11]'],
			'codPerfil' => ['label' => 'CodPerfil', 'rules' => 'required|numeric|max_length[11]'],
			'dataInicio' => ['label' => 'DataInicio', 'rules' => 'required|valid_date'],
			'dataEncerramento' => ['label' => 'DataEncerramento', 'rules' => 'permit_empty|valid_date'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->PerfilColaboradoresMembroModel->update($fields['codColaboradorMembro'], $fields)) {

				$response['success'] = true;
				$response['csrf_hash'] = csrf_hash();
				$response['messages'] = 'Atualizado com sucesso';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Erro na atualização!';
			}
		}

		return $this->response->setJSON($response);
	}

	public function remove()
	{
		$response = array();

		$id = $this->request->getPost('codColaboradorMembro');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->PerfilColaboradoresMembroModel->where('codColaboradorMembro', $id)->delete()) {

				$response['success'] = true;
				$response['csrf_hash'] = csrf_hash();
				$response['messages'] = 'Deletado com sucesso';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Erro na deleção!';
			}
		}

		return $this->response->setJSON($response);
	}
}
