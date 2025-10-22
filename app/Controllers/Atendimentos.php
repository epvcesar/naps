<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Services;

use App\Models\LogsModel;
use App\Models\ColaboradoresModel;
use App\Models\OrganizacoesModel;


use App\Models\AtendimentosModel;
use App\Models\PainelChamadasModel;
use SessionIdInterface;

class Atendimentos extends BaseController
{

	protected $atendimentosModel;
	protected $LogsModel;
	protected $ColaboradoresModel;
	protected $OrganizacoesModel;
	protected $PainelChamadasModel;
	protected $organizacao;
	protected $codOrganizacao;
	protected $validation;

	public function __construct()
	{

		helper(['notificacoes', 'seguranca', 'formularios', 'pdf', 'alertas']);
		verificaSeguranca($this, session(), base_url());
		$this->LogsModel = new LogsModel();
		$this->ColaboradoresModel = new ColaboradoresModel();
		$this->PainelChamadasModel = new PainelChamadasModel();
		$this->OrganizacoesModel = new OrganizacoesModel();
		$this->atendimentosModel = new AtendimentosModel();

		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{


		$data = [
			'controller'    	=> 'atendimentos',
			'title'     		=> 'atendimentos'
		];

		return view('atendimentos', $data);
	}
	public function atendimentosDia()
	{
		$response = $data['data'] = array();


		$dataFiltro = $this->request->getPost('dataFiltro');
		$codEspecialidadeFiltro = $this->request->getPost('codEspecialidadeFiltro');

		$result = $this->atendimentosModel->atendimentosDia($dataFiltro, $codEspecialidadeFiltro);

		foreach ($result as $key => $value) {



			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-primary" onclick="saveAtendimentos(' . $value->codAtendimento . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-success" onclick="chamarPainel(' . $value->codAtendimento . ')"><i class="fa-solid fa-bullhorn"></i></button>';
			$ops .= '	<button type="button" class="btn btn-info" onclick="alterarStatus(' . $value->codAtendimento . ')"><i class="fa-solid fa-"></i> Status</button>';
			$ops .= '	<button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-placement="top" title="Remover" onclick="removeAtendimentos(' . $value->codAtendimento . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->nomeCompleto,
				$value->especialidade,
				date('d/m/Y H:i', strtotime($value->dataCriacao)),
				$value->senha,
				'<span class="badge bg-'.$value->botao.'">'.$value->status.'</span>',
				$ops
			);
		}

		return $this->response->setJSON($data);
	}

	public function getAll()
	{
		$response = $data['data'] = array();

		$result = $this->atendimentosModel->pegaTudo();

		foreach ($result as $key => $value) {



			$ops = '<div class="btn-group">';
			$ops .= '	<button type="button" class="btn btn-primary" onclick="saveAtendimentos(' . $value->codAtendimento . ')"><i class="fa fa-edit"></i></button>';
			$ops .= '	<button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-placement="top" title="Remover" onclick="removeAtendimentos(' . $value->codAtendimento . ')"><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';

			$data['data'][$key] = array(
				$value->codAtendimento,
				$value->nomeCompleto,
				$value->especialidade,

				$ops
			);
		}

		return $this->response->setJSON($data);
	}

	public function chamarPacienteAgora()
	{
		$response = array();
		$data = array();
		$codAtendimento = $this->request->getPost('codAtendimento');
		$dados = $this->atendimentosModel->pegaPorCodigo($codAtendimento);


		$data['localAssistencia'] = $dados->especialidade;
		$data['codOrganizacao'] = session()->codOrganizacao;
		$data['codChamador'] = session()->codColaborador;
		$data['qtdChamadas'] = 2;
		$data['codPaciente'] = $dados->codPaciente;
		$data['codEspecialidade'] = $dados->codEspecialidade;

		if ($this->PainelChamadasModel->insert($data)) {
			$response['success'] = true;
			$response['csrf_hash'] = csrf_hash();
			$response['messages'] = 'Paciente ' . $dados->nomeCompleto . ' chamado com sucessoo';
		} else {
			$response['success'] = false;
			$response['messages'] = 'Erro ao chamar paciente, contate o administrador do sistema';
		}



		return $this->response->setJSON($response);
	}

	public function getOne()
	{
		$response = array();

		$id = $this->request->getPost('codAtendimento');

		if ($this->validation->check($id, 'required|numeric')) {

			$data = $this->atendimentosModel->pegaPorCodigo($id);

			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function listaDropDownEspecialidades()
	{

		$result = $this->atendimentosModel->listaDropDownEspecialidades();

		if ($result !== NULL) {


			return $this->response->setJSON($result);
		} else {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}


	public function add()
	{
		$response = array();




		$fields['codOrganizacao'] = session()->codOrganizacao;
		$fields['codPaciente'] = $this->request->getPost('codPaciente');
		$fields['codEspecialidade'] = $this->request->getPost('codEspecialidade');
		$fields['dataCriacao'] = date('Y-m-d H:i');
		$fields['dataAtualizacao'] = date('Y-m-d H:i');
		$fields['codStatus'] = 1;

		//GERA SENHA AUTOMATICA

		$totalPorEspecialidade = $this->atendimentosModel->totalPorEspecialidade($fields['codEspecialidade']);

		$seq = $totalPorEspecialidade + 1;
		$fields['seq'] = $seq;
		$seq = str_pad($seq, 3, '0', STR_PAD_LEFT);
		$siglaEspecialidade = $this->atendimentosModel->siglaEspecialidade($fields['codEspecialidade']);


		$fields['senha'] = $siglaEspecialidade->sigla . $seq;


		$this->validation->setRules([
			'codAtendimento' => ['label' => 'Código', 'rules' => 'permit_empty'],
			'codOrganizacao' => ['label' => 'Organizacao', 'rules' => 'required|numeric|min_length[0]|max_length[11]'],
			'codPaciente' => ['label' => 'Paciente', 'rules' => 'required|min_length[0]|max_length[11]'],
			'dataCriacao' => ['label' => 'DataCriacao', 'rules' => 'permit_empty|valid_date|min_length[0]'],
			'dataAtualizacao' => ['label' => 'DataAtualizacao', 'rules' => 'permit_empty|valid_date|min_length[0]'],
			'codStatus' => ['label' => 'Status', 'rules' => 'required|min_length[0]|max_length[11]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->atendimentosModel->insert($fields)) {

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




		$fields['codAtendimento'] = $this->request->getPost('codAtendimento');
		$fields['codPaciente'] = $this->request->getPost('codPaciente');
		$fields['codEspecialidade'] = $this->request->getPost('codEspecialidade');
		$fields['dataAtualizacao'] = date('Y-m-d H:i');


		$this->validation->setRules([
			'codAtendimento' => ['label' => 'Código', 'rules' => 'required|numeric|min_length[0]|max_length[11]'],
			'codPaciente' => ['label' => 'Paciente', 'rules' => 'required|min_length[0]|max_length[11]'],
			'dataAtualizacao' => ['label' => 'DataAtualizacao', 'rules' => 'permit_empty|valid_date|min_length[0]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->atendimentosModel->update($fields['codAtendimento'], $fields)) {

				$response['success'] = true;
				$response['messages'] = lang("App.update-success");
			} else {

				$response['success'] = false;
				$response['messages'] = lang("App.update-error");
			}
		}

		return $this->response->setJSON($response);
	}

	public function alterarStatus()
	{
		$response = array();

		$fields['codAtendimento'] = $this->request->getPost('codAtendimento');
		$fields['dataAtualizacao'] = date('Y-m-d H:i');
		$fields['codStatus'] = $this->request->getPost('codStatus');


		$this->validation->setRules([
			'codAtendimento' => ['label' => 'Código', 'rules' => 'required|numeric|min_length[0]|max_length[11]'],
			'dataAtualizacao' => ['label' => 'DataAtualizacao', 'rules' => 'permit_empty|valid_date|min_length[0]'],

		]);

		if ($this->validation->run($fields) == FALSE) {

			$response['success'] = false;
			$response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

		} else {

			if ($this->atendimentosModel->update($fields['codAtendimento'], $fields)) {

				$response['success'] = true;
				$response['messages'] = 'Atualizado com sucesso';
			} else {

				$response['success'] = false;
				$response['messages'] = 'Erro ao atualizar';
			}
		}

		return $this->response->setJSON($response);
	}
	public function remove()
	{
		$response = array();



		$id = $this->request->getPost('codAtendimento');

		if (!$this->validation->check($id, 'required|numeric')) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {

			if ($this->atendimentosModel->where('codAtendimento', $id)->delete()) {

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
