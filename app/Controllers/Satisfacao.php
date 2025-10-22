<?php

// Licença GNU GPL

namespace App\Controllers;




use App\Controllers\BaseController;
use CodeIgniter\Services;
use App\Models\LogsModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;


use App\Models\SatisfacaoModel;

class Satisfacao extends BaseController
{

    protected $SatisfacaoModel;
    protected $validation;
	protected $LogsModel;

    public function __construct()
    {

        $this->SatisfacaoModel = new SatisfacaoModel();
		$this->LogsModel = new LogsModel();
		$this->validation =  \Config\Services::validation();
    }



    public function index()
    {

        return view('satisfacao');
    }
    public function listaDropDownOrganizacoes()
    {

        $result = $this->SatisfacaoModel->listaDropDownOrganizacoes();

        if ($result !== NULL) {


            return $this->response->setJSON($result);
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
        $fields['data'] = date('Y-m-d H:i');
        $fields['email'] = $this->request->getPost('email');
        $fields['servico'] = $this->request->getPost('servico');
        $fields['atendimento'] = $this->request->getPost('atendimento');
        $fields['qualidade'] = $this->request->getPost('qualidade');
        $fields['tempo'] = $this->request->getPost('tempo');
        $fields['instalacoes'] = $this->request->getPost('instalacoes');
        $fields['qualidadePresencial'] = $this->request->getPost('qualidadePresencial');
        $fields['sugestao'] = $this->request->getPost('sugestao');


        $this->validation->setRules([
            'codOrganizacao' => ['label' => 'codOrganizacao', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'codMeio' => ['label' => 'CodMeio', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'data' => ['label' => 'Data', 'rules' => 'required|valid_date|min_length[0]'],
            'email' => ['label' => 'Email', 'rules' => 'permit_empty|min_length[0]'],
            'servico' => ['label' => 'Servico', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'atendimento' => ['label' => 'Atendimento', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'qualidade' => ['label' => 'Qualidade', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'tempo' => ['label' => 'Tempo', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'instalacoes' => ['label' => 'Instalacoes', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'qualidadePresencial' => ['label' => 'QualidadePresencial', 'rules' => 'permit_empty|numeric|min_length[0]'],
            'sugestao' => ['label' => 'Sugestao', 'rules' => 'permit_empty|min_length[0]'],

        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['success'] = false;
            $response['messages'] = $this->validation->getErrors(); //Show Error in Input Form

        } else {

            if ($this->SatisfacaoModel->insert($fields)) {

                $response['success'] = true;
                $response['messages'] = 'Obrigado! Avaliação realizada com sucesso!';
            } else {

                $response['success'] = false;
                $response['messages'] = lang("App.insert-error");
            }
        }

        return $this->response->setJSON($response);
    }

    public function listaDropDownMeios()
    {

        $result = $this->SatisfacaoModel->listaDropDownMeios();

        if ($result !== NULL) {


            return $this->response->setJSON($result);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }
}
