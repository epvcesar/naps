<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\RespostasModel;
use App\Models\LogsModel;

class Respostas extends BaseController
{

	protected $respostasModel;
	protected $LogsModel;
	protected $validation;

	public function __construct()
	{

		helper(['seguranca', 'formularios']);
		verificaSeguranca($this, session(), base_url());
		$this->LogsModel = new LogsModel();
		$this->respostasModel = new RespostasModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{

		$data = [
			'controller'    	=> 'respostas',
			'title'     		=> 'respostas'
		];

		return view('respostas', $data);
	}

	public function getAll()
	{
		$response = $data['data'] = array();

		$result = $this->respostasModel->pegaTudo();

		foreach ($result as $key => $value) {

			$ops = '<div class="btn-group mt-0">';
			$ops .= '<button type="button" class="border btn btn-sm dropdown-toggle text-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
			$ops .= '<i class="fa-solid fa-pen-square"></i>  </button>';
			$ops .= '<div class="dropdown-menu">';
			$ops .= '<a class="dropdown-item text-primary" onClick="save(' . $value->codPesquisa . ')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
			$ops .= '<div class="dropdown-divider"></div>';
			$ops .= '<a class="dropdown-item text-danger" onClick="remove(' . $value->codPesquisa . ')"><i class="fa-solid fa-trash"></i>   ' .  lang("App.delete")  . '</a>';
			$ops .= '</div></div>';

			$data['data'][$key] = array(
				$value->codPesquisa,
				$value->siglaOrganizacao,
				$value->descricaoMeio,
				$value->data,
				$value->email,
				$value->servico,
				$value->atendimento,
				$value->qualidade,
				$value->tempo,
				$value->instalacoes,
				$value->qualidadePresencial,
				$value->sugestao,

				$ops
			);
		}

		return $this->response->setJSON($data);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('codPesquisa');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->respostasModel->where('codPesquisa', $id)->first();

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();

		$fields['codPesquisa'] = $this->request->getPost('codPesquisa');
		$fields['codOrganizacao'] = $this->request->getPost('codOrganizacao');
		$fields['codMeio'] = $this->request->getPost('codMeio');
		$fields['data'] = $this->request->getPost('data');
		$fields['email'] = $this->request->getPost('email');
		$fields['servico'] = $this->request->getPost('servico');
		$fields['atendimento'] = $this->request->getPost('atendimento');
		$fields['qualidade'] = $this->request->getPost('qualidade');
		$fields['tempo'] = $this->request->getPost('tempo');
		$fields['instalacoes'] = $this->request->getPost('instalacoes');
		$fields['qualidadePresencial'] = $this->request->getPost('qualidadePresencial');
		$fields['sugestao'] = $this->request->getPost('sugestao');


		$this->validation->setRules([
			'codOrganizacao' => ['label' => 'Organização', 'rules' => 'permit_empty|min_length[0]'],
			'codMeio' => ['label' => 'Meio', 'rules' => 'permit_empty|min_length[0]'],
			'data' => ['label' => 'Data', 'rules' => 'required|valid_date|min_length[0]'],
			'email' => ['label' => 'Email', 'rules' => 'permit_empty|valid_email|min_length[0]'],
			'servico' => ['label' => 'Servico', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'atendimento' => ['label' => 'Atendimento', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'qualidade' => ['label' => 'Qualidade', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'tempo' => ['label' => 'Tempo', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'instalacoes' => ['label' => 'Instalações', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'qualidadePresencial' => ['label' => 'QualidadePresencial', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'sugestao' => ['label' => 'Sugestão', 'rules' => 'permit_empty|min_length[0]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->respostasModel->insert($fields)) {

				$response['success'] = true;
				$response['messages'] = lang("App.insert-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.insert-error");
			}
		}

		return $this->response->setJSON($response);
	}

	public function edit()
	{
		$response = array();

		$fields['codPesquisa'] = $this->request->getPost('codPesquisa');
		$fields['codOrganizacao'] = $this->request->getPost('codOrganizacao');
		$fields['codMeio'] = $this->request->getPost('codMeio');
		$fields['data'] = $this->request->getPost('data');
		$fields['email'] = $this->request->getPost('email');
		$fields['servico'] = $this->request->getPost('servico');
		$fields['atendimento'] = $this->request->getPost('atendimento');
		$fields['qualidade'] = $this->request->getPost('qualidade');
		$fields['tempo'] = $this->request->getPost('tempo');
		$fields['instalacoes'] = $this->request->getPost('instalacoes');
		$fields['qualidadePresencial'] = $this->request->getPost('qualidadePresencial');
		$fields['sugestao'] = $this->request->getPost('sugestao');


		$this->validation->setRules([
			'codOrganizacao' => ['label' => 'Organização', 'rules' => 'permit_empty|min_length[0]'],
			'codMeio' => ['label' => 'Meio', 'rules' => 'permit_empty|min_length[0]'],
			'data' => ['label' => 'Data', 'rules' => 'required|valid_date|min_length[0]'],
			'email' => ['label' => 'Email', 'rules' => 'permit_empty|valid_email|min_length[0]'],
			'servico' => ['label' => 'Servico', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'atendimento' => ['label' => 'Atendimento', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'qualidade' => ['label' => 'Qualidade', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'tempo' => ['label' => 'Tempo', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'instalacoes' => ['label' => 'Instalações', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'qualidadePresencial' => ['label' => 'QualidadePresencial', 'rules' => 'permit_empty|numeric|min_length[0]'],
			'sugestao' => ['label' => 'Sugestão', 'rules' => 'permit_empty|min_length[0]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->respostasModel->update($fields['codPesquisa'], $fields)) {

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

		$id = $this->request->getPost('codPesquisa');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->respostasModel->where('codPesquisa', $id)->delete()) {

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
