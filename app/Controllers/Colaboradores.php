<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ColaboradoresModel;
use App\Models\OrganizacoesModel;

class Colaboradores extends BaseController
{

    protected $ColaboradoresModel;
    protected $OrganizacoesModel;
    protected $validation;

    public function __construct()
    {
		helper(['seguranca', 'formularios']);
		verificaSeguranca($this, session(), base_url());
        $this->ColaboradoresModel = new ColaboradoresModel();
        $this->OrganizacoesModel = new OrganizacoesModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {

        $data = [
            'controller'        => 'colaboradores',
            'title'             => 'Usuários'
        ];

        return view('colaboradores', $data);
    }

    public function getAll()
    {
        $response = $data['data'] = array();

        $result = $this->ColaboradoresModel->pegaTudo();

        foreach ($result as $key => $value) {

            $ops = '<div class="btn-group mt-4">';
            $ops .= '<button type="button" class=" btn btn-sm dropdown-toggle btn-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
            $ops .= '<i class="fa-solid fa-pen-square"></i>  </button>';
            $ops .= '<div class="dropdown-menu">';
            $ops .= '<a class="dropdown-item text-primary" onClick="save(' . $value->codColaborador . ')"><i class="fa-solid fa-pen-to-square"></i>   ' .  lang("App.edit")  . '</a>';
            $ops .= '<div class="dropdown-divider"></div>';
            $ops .= '<a class="dropdown-item text-primary" onClick="trocasenha(' . $value->codColaborador . ')"><i class="fa fa-user-lock"></i>   ' .  lang("App.password")  . '</a>';
            $ops .= '<div class="dropdown-divider"></div>';
            $ops .= '<a class="dropdown-item text-danger" onClick="remove(' . $value->codColaborador . ')"><i class="fa-solid fa-trash"></i>   ' .  lang("App.delete")  . '</a>';
            $ops .= '</div></div>';

            if ($value->ativo) {
                $ativo = 'Sim';
            } else {
                $ativo = 'Não';
            }
            $data['data'][$key] = array(
                $value->codColaborador,
                $value->conta,
                $value->nomeCompleto,
                $value->siglaOrganizacao,
                $ativo,
                $ops
            );
        }

        return $this->response->setJSON($data);
    }

    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('codColaborador');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->ColaboradoresModel->where('codColaborador', $id)->first();

            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function add()
    {

        sleep(2);
        $response = array();

        $lista = array();
        $emails = $this->ColaboradoresModel->emailPessoal();

        foreach ($emails as $row) {
            array_push($lista, $row->emailPessoal);
        }

        if (trim($this->request->getPost('emailPessoal')) !== NULL) {
            if (in_array(trim($this->request->getPost('emailPessoal')), $lista)) {
                $response['success'] = false;
                $response['mensagem'] = 'A email "' . trim($this->request->getPost('emailPessoal')) . " já está em uso!";

                return $this->response->setJSON($response);
            }
        }

        $fields['codOrganizacao'] =  $this->request->getPost('codOrganizacao');
        $fields['codColaborador'] = $this->request->getPost('codColaborador');
        $fields['codClasse'] = 1;
        $fields['conta'] = mb_strtolower(trim($this->request->getPost('conta')), 'utf-8');
        $fields['nomeExibicao'] = mb_strtoupper($this->request->getPost('nomePrincipal'), "utf-8");
        $fields['nomePrincipal'] = mb_strtoupper($this->request->getPost('nomePrincipal'), "utf-8");
        $fields['nomeCompleto'] = mb_strtoupper($this->request->getPost('nomeCompleto'), "utf-8");
        $fields['identidade'] = $this->request->getPost('identidade');
        $fields['cpf'] = $this->request->getPost('cpf');
        $fields['codBen'] = $this->request->getPost('codBen');
        $fields['emailFuncional'] = $this->request->getPost('emailFuncional');
        $fields['emailPessoal'] = trim($this->request->getPost('emailPessoal'));
        $fields['codEspecialidade'] = $this->request->getPost('codEspecialidade');
        $fields['telefoneTrabalho'] = $this->request->getPost('telefoneTrabalho');
        $fields['celular'] = $this->request->getPost('celular');
        $fields['endereco'] = $this->request->getPost('endereco');
        $fields['dataInicioEmpresa'] = $this->request->getPost('dataInicioEmpresa');
        $fields['dataCriacao'] = date('Y-m-d H:i:s');
        $fields['dataAtualizacao'] = date('Y-m-d H:i:s');
        $fields['dataNascimento'] = $this->request->getPost('dataNascimento');
        $fields['codDepartamento'] = $this->request->getPost('codDepartamento');
        $fields['codFuncao'] = $this->request->getPost('codFuncao');
        $fields['codCargo'] = $this->request->getPost('codCargo');
        $fields['codPerfilPadrao'] = $this->request->getPost('codPerfilPadrao');
        $fields['nrEndereco'] = $this->request->getPost('nrEndereco');
        $fields['codMunicipioFederacao'] = $this->request->getPost('codMunicipioFederacao');
        $fields['cep'] = $this->request->getPost('cep');
        $fields['informacoesComplementares'] = $this->request->getPost('informacoesComplementares');
        $fields['pai'] = $this->request->getPost('pai');

        if ($this->request->getPost('ativo') == 'on') {
            $fields['ativo'] = 1;
        } else {
            $fields['ativo'] = 0;
        }
        if ($this->request->getPost('aceiteTermos') == 'on') {
            $fields['aceiteTermos'] = 1;
        } else {
            $fields['aceiteTermos'] = 0;
        }


        $this->validation->setRules([
            'dataCriacao' => ['label' => 'dataCriacao', 'rules' => 'required|max_length[40]'],
            'dataAtualizacao' => ['label' => 'dataAtualizacao', 'rules' => 'required|max_length[40]'],
            'conta' => ['label' => 'Conta', 'rules' => 'permit_empty|max_length[40]'],
            'nomeExibicao' => ['label' => 'Nome exibição', 'rules' => 'permit_empty|max_length[40]'],
            'nomeCompleto' => ['label' => 'Nome completo', 'rules' => 'permit_empty|max_length[100]'],
            'identidade' => ['label' => 'Identidade', 'rules' => 'permit_empty|max_length[15]'],
            'cpf' => ['label' => 'cpf', 'rules' => 'permit_empty|max_length[15]'],
            'emailFuncional' => ['label' => 'Email funcional', 'rules' => 'permit_empty|max_length[40]'],
            'emailPessoal' => ['label' => 'Email pessoal', 'rules' => 'permit_empty|max_length[40]'],
            'codEspecialidade' => ['label' => 'Especialidade', 'rules' => 'permit_empty|max_length[11]'],
            'telefoneTrabalho' => ['label' => 'Telefone trabalho', 'rules' => 'permit_empty|max_length[16]'],
            'celular' => ['label' => 'Celular', 'rules' => 'permit_empty|max_length[16]'],
            'endereco' => ['label' => 'Endereço', 'rules' => 'permit_empty|max_length[200]'],
            'senha' => ['label' => 'Senha', 'rules' => 'permit_empty|max_length[200]'],
            'ativo' => ['label' => 'Ativo', 'rules' => 'permit_empty|max_length[1]'],
            'dataInicioEmpresa' => ['label' => 'Data início empresa', 'rules' => 'permit_empty|valid_date'],
            'datanascimento' => ['label' => 'Data de nascimento', 'rules' => 'permit_empty|valid_date'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

        } else {

            if ($this->ColaboradoresModel->insert($fields)) {

                $response['success'] = true;
                $response['messages'] = lang("App.insert-success");
            } else {

                $response['success'] = false;
                $response['messages'] = lang("App.insert-error");
            }
        }
        return $this->response->setJSON($response);
    }


    public function trocaSenha($codColaborador = null, $senha = null, $confirmacao = null)
    {


        $response = array();


        if ($codColaborador == null) {
            $codColaborador = $this->request->getPost('codColaborador');
        } else {
            $codColaborador = $codColaborador;
        }

        if ($senha == null) {
            $senha = $this->request->getPost('senha');
        } else {
            $senha = $senha;
        }


        if ($confirmacao == null) {
            $confirmacao = $this->request->getPost('confirmacao');
        } else {
            $confirmacao = $confirmacao;
        }


        
        $colaborador = $this->ColaboradoresModel->organizacaoColaborador($codColaborador);


        $fields['codColaborador'] = $codColaborador;
        $fields['senha1'] = $senha;
        $fields['senha2'] = $confirmacao;


        $chave = $colaborador->chaveSalgada;
        $tipo_cifra = 'des';

        
        //CRIPTOGRAFIA DE SENHA
        $senhaResinc = encriptar($chave, $tipo_cifra, $fields['senha1']); // print descriptar($chave, $tipo_cifra, 'dHZPcW84ZktwaytPOFBrTjBadk1QUT09OjqP+UO2YtpH7g==');



        $statusTrocaSenha = "";

        //TROCA SENHA 
        $senha = hash("sha256", $this->request->getPost('senha') . $chave);
        $fields['senha'] = $senha;
        $fields['senhaResinc'] = $senhaResinc;
        $fields['dataSenha'] = date('Y-m-d H:i');
        $fields['dataAtualizacao'] = date('Y-m-d H:i');

        $this->validation->setRules([
            'codColaborador' => ['label' => 'codColaborador', 'rules' => 'required|numeric'],
            'senha1' => ['label' => 'Senha', 'rules' => 'permit_empty|matches[senha2]'],
            'senha2' => ['label' => 'Confirmação', 'rules' => 'required|max_length[40]'],
        ]);



        $qtdSenhasArmazenadas = $colaborador->diferenteUltimasSenhas;

        if ($qtdSenhasArmazenadas > 0) {
            $historicoSenhas = array();
            $historicoSenhas  = explode(",", $colaborador->historicoSenhas);

            if (count($historicoSenhas) >= $qtdSenhasArmazenadas) {
                unset($historicoSenhas[0]);
            }

            $historicoSenhas  = implode(",", $historicoSenhas);

            $fields['historicoSenhas'] = $historicoSenhas . "," . '"' . $senha . '"';
        } else {
            $fields['historicoSenhas'] = '';
        }

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {


        
            if ($this->ColaboradoresModel->update($fields['codColaborador'], $fields)) {

                $response['success'] = true;
                $response['csrf_hash'] = csrf_hash();        
                $response['messages'] = 'Senha trocada com sucesso';
            } else {

                $response['success'] = false;
                $response['messages'] = 'Erro na atualização da senha!';
            }
        }

        return $this->response->setJSON($response);
    }


    public function pegaOrganizacaoColaborador()
    {
        $response = array();

        if ($this->request->getPost('codColaborador') == NULL) {
            $codColaborador = session()->codColaborador;
        } else {
            $codColaborador = $this->request->getPost('codColaborador');
        }




        if ($this->validation->check($codColaborador, 'required|numeric')) {

            $data = $this->ColaboradoresModel->organizacaoColaborador($codColaborador);

            return $this->response->setJSON($data);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }



    public function listaDropDownColaboradores()
    {

        $result = $this->ColaboradoresModel->listaDropDownColaboradores();

        if ($result !== NULL) {


            return $this->response->setJSON($result);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function edit()
    {





        $response = array();

        $fields['codOrganizacao'] = $this->request->getPost('codOrganizacao');
        $fields['codColaborador'] = $this->request->getPost('codColaborador');
        $fields['nomeCompleto'] = mb_strtoupper($this->request->getPost('nomeCompleto'), "utf-8");
        $fields['nomeExibicao'] = mb_strtoupper($this->request->getPost('nomePrincipal'), "utf-8");
        $fields['nomePrincipal'] = mb_strtoupper($this->request->getPost('nomePrincipal'), "utf-8");
        $fields['codDepartamento'] = $this->request->getPost('codDepartamento');
        $fields['codFuncao'] = $this->request->getPost('codFuncao');
        $fields['codCargo'] = $this->request->getPost('codCargo');
        $fields['codEspecialidade'] = $this->request->getPost('codEspecialidade');
        $fields['identidade'] = $this->request->getPost('identidade');
        $fields['cpf'] = removeCaracteresIndesejados($this->request->getPost('cpf'));
        $fields['codBen'] = removeCaracteresIndesejados($this->request->getPost('codBen'));
        $fields['emailFuncional'] = mb_strtolower($this->request->getPost('emailFuncional'), "utf-8");
        $fields['emailPessoal'] = mb_strtolower($this->request->getPost('emailPessoal'), "utf-8");
        $fields['telefoneTrabalho'] = $this->request->getPost('telefoneTrabalho');
        $fields['celular'] = $this->request->getPost('celular');
        $fields['endereco'] = $this->request->getPost('endereco');
        if ($this->request->getPost('ativo') == 'on') {
            $fields['ativo'] = 1;
        } else {
            $fields['ativo'] = 0;
        }
        if ($this->request->getPost('aceiteTermos') == 'on') {
            $fields['aceiteTermos'] = 1;
        } else {
            $fields['aceiteTermos'] = 0;
        }
        $fields['dataInicioEmpresa'] = $this->request->getPost('dataInicioEmpresa');
        $fields['dataNascimento'] = $this->request->getPost('dataNascimento');
        $fields['nrEndereco'] = $this->request->getPost('nrEndereco');
        $fields['codMunicipioFederacao'] = $this->request->getPost('codMunicipioFederacao');
        $fields['reservadoSimNao'] = $this->request->getPost('reservadoSimNao');
        $fields['reservadoTexto100'] = $this->request->getPost('reservadoTexto100');
        $fields['reservadoNumero'] = $this->request->getPost('reservadoNumero');
        $fields['cep'] = $this->request->getPost('cep');
        $fields['dataAtualizacao'] = date('Y-m-d H:i');
        $fields['codPerfilPadrao'] = $this->request->getPost('codPerfilPadrao');
        $fields['informacoesComplementares'] = $this->request->getPost('informacoesComplementares');
        $fields['pai'] = $this->request->getPost('pai');



        $this->validation->setRules([
            'codColaborador' => ['label' => 'codColaborador', 'rules' => 'required|numeric|max_length[11]'],
            'nomeExibicao' => ['label' => 'Nome exibição', 'rules' => 'required|max_length[40]'],
            'nomeCompleto' => ['label' => 'Nome completo', 'rules' => 'required|max_length[100]'],
            'identidade' => ['label' => 'Identidade', 'rules' => 'permit_empty|max_length[15]'],
            'cpf' => ['label' => 'cpf', 'rules' => 'permit_empty|max_length[15]'],
            'emailFuncional' => ['label' => 'Email funcional', 'rules' => 'permit_empty|max_length[40]'],
            'emailPessoal' => ['label' => 'EmailPessoal', 'rules' => 'permit_empty|valid_email|min_length[0]|max_length[40]'],
            'codEspecialidade' => ['label' => 'Especialidade', 'rules' => 'permit_empty|max_length[11]'],
            'telefoneTrabalho' => ['label' => 'Telefone trabalho', 'rules' => 'permit_empty|max_length[16]'],
            'celular' => ['label' => 'Celular', 'rules' => 'permit_empty|max_length[16]'],
            'endereco' => ['label' => 'Endereço', 'rules' => 'permit_empty|max_length[200]'],
            'senha' => ['label' => 'Senha', 'rules' => 'permit_empty|max_length[200]'],
            'dataInicioEmpresa' => ['label' => 'Data início empresa', 'rules' => 'permit_empty|valid_date'],
            'datanascimento' => ['label' => 'Data de nascimento', 'rules' => 'permit_empty|valid_date'],

        ]);


        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($this->ColaboradoresModel->update($fields['codColaborador'], $fields)) {

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

        $id = $this->request->getPost('codColaborador');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {

            if ($this->ColaboradoresModel->where('codColaborador', $id)->delete()) {

                sleep(2);
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
