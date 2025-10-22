<?php
// Desenvolvido por Emanuel Peixoto Vicente

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Services;

use App\Models\LogsModel;
use App\Models\ColaboradoresModel;
use App\Models\OrganizacoesModel;

use App\Models\FederacoesModel;
use Config\Encryption;

class Federacoes extends BaseController
{

	protected $FederacoesModel;
	protected $ColaboradoresModel;
	protected $OrganizacoesModel;
	protected $Organizacao;
	protected $codOrganizacao;
	protected $LogsModel;
	protected $validation;

	public function __construct()
	{

		helper(['seguranca', 'formularios']);
		verificaSeguranca($this, session(), base_url());
		$this->FederacoesModel = new FederacoesModel();
		$this->OrganizacoesModel = new OrganizacoesModel();
		$this->LogsModel = new LogsModel(); // $this->LogsModel->inserirLog('descrição da ocorrencia',$codColaborador);
		$this->validation =  \Config\Services::validation();
		$this->codOrganizacao = session()->codOrganizacao;
		$this->Organizacao =  $this->OrganizacoesModel->pegaOrganizacao($this->codOrganizacao);
	}

	public function index()
	{

		$permissao = verificaPermissao('Federacoes', 'listar');
		if ($permissao == 0) {
			echo mensagemAcessoNegado(session()->organizacoes);
			$this->LogsModel->inserirLog('Acesso indevido ao Módulo \"Federacoes\"', session()->codColaborador);
			exit();
		}


		$data = [
			'controller'    	=> 'federacoes',
			'title'     		=> 'Federações'
		];
		return view('federacoes', $data);
	}

	public function getAll()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->FederacoesModel->pegaTudo();

		$chave = $this->FederacoesModel->pegaChave(session()->codOrganizacao)->chaveSalgada;

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info"  data-toggle="tooltip" data-placement="top" title="Editar"  onclick="editfederacoes(' . $value->codFederacao . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Remover"  onclick="removefederacoes(' . $value->codFederacao . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->codFederacao,
				$value->descricaoFederacao,
				$value->servidor,
				$value->banco,
				$value->login,
				'************',
				$ops,
			);
		}

		return $this->response->setJSON($data);
	}

	public function verificarEsquema()
	{
		$response = array();

		$data['data'] = array();

		$result = $this->FederacoesModel->pegaTudo();

		$chave = $this->FederacoesModel->pegaChave(session()->codOrganizacao)->chaveSalgada;
		$tipo_cifra = 'des';

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-sm btn-info"  data-toggle="tooltip" data-placement="top" title="Verificar"  onclick="diferencaEsquemaAgora(' . $value->codFederacao . ')">Diferença Esquema</button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->codFederacao,
				$value->descricaoFederacao,
				$value->servidor,
				$value->banco,
				$value->login,
				'************',
				$ops,
			);
		}

		return $this->response->setJSON($data);
	}
	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('codFederacao');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->FederacoesModel->pegaPorCodigo($id);

			return $this->response->setJSON($data);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{

		$response = array();

		$fields['codFederacao'] = $this->request->getPost('codFederacao');
		$fields['descricaoFederacao'] = $this->request->getPost('descricaoFederacao');
		$fields['servidor'] = $this->request->getPost('servidor');
		$fields['banco'] = $this->request->getPost('banco');
		$fields['login'] = $this->request->getPost('login');



		$chave = $this->FederacoesModel->pegaChave(session()->codOrganizacao)->chaveSalgada;
	
		$config         = config(Encryption::class);
		$config->key    = $chave;
		$config->driver = 'OpenSSL';
		
		$encrypter = service('encrypter', $config);

		$fields['senha'] = bin2hex($encrypter->encrypt($this->request->getPost('senha')));
	

		$this->validation->setRules([
			'descricaoFederacao' => ['label' => 'Decrição', 'rules' => 'required|max_length[100]'],
			'servidor' => ['label' => 'Servidor', 'rules' => 'required|max_length[100]'],
			'banco' => ['label' => 'Banco', 'rules' => 'required|max_length[120]'],
			'login' => ['label' => 'Login', 'rules' => 'required|max_length[50]'],
			'senha' => ['label' => 'Senha', 'rules' => 'required|max_length[120]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->FederacoesModel->insert($fields)) {

				$response['success'] = true;
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

		$fields['codFederacao'] = $this->request->getPost('codFederacao');
		$fields['descricaoFederacao'] = $this->request->getPost('descricaoFederacao');
		$fields['servidor'] = $this->request->getPost('servidor');
		$fields['banco'] = $this->request->getPost('banco');
		$fields['login'] = $this->request->getPost('login');

		$chave = $this->FederacoesModel->pegaChave(session()->codOrganizacao)->chaveSalgada;


		if ($this->request->getPost('senha') !== "************") {
			
			$config         = config(Encryption::class);
			$config->key    = $chave;
			$config->driver = 'OpenSSL';
			
			$encrypter = service('encrypter', $config);
	
			$fields['senha'] = bin2hex($encrypter->encrypt($this->request->getPost('senha')));
		
		}




		$this->validation->setRules([
			'codFederacao' => ['label' => 'codFederacao', 'rules' => 'required|numeric'],
			'descricaoFederacao' => ['label' => 'Decrição', 'rules' => 'required|max_length[100]'],
			'servidor' => ['label' => 'Servidor', 'rules' => 'required|max_length[100]'],
			'banco' => ['label' => 'Banco', 'rules' => 'required|max_length[120]'],
			'login' => ['label' => 'Login', 'rules' => 'required|max_length[50]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {

			if ($this->FederacoesModel->update($fields['codFederacao'], $fields)) {

				$response['success'] = true;
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

		$id = $this->request->getPost('codFederacao');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->FederacoesModel->where('codFederacao', $id)->delete()) {

				$response['success'] = true;
				$response['messages'] = 'Deletado com sucesso';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Erro na deleção!';
			}
		}

		return $this->response->setJSON($response);
	}
}
