<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use DateTime;

use App\Controllers\BaseController;
use CodeIgniter\Services;

use App\Models\LogsModel;
use App\Models\ColaboradoresModel;
use App\Models\OrganizacoesModel;


use App\Models\AtendimentosModel;
use App\Models\PainelChamadasModel;
use SessionIdInterface;


class PainelChamadas extends BaseController
{


    protected $pessoasModel;
    protected $organizacoesModel;
    protected $organizacao;
    protected $codOrganizacao;
    protected $PainelChamadasModel;
    protected $validation;

    protected $atendimentosModel;
    protected $LogsModel;
    protected $ColaboradoresModel;
    protected $OrganizacoesModel;

    public function __construct()
    {

        $this->validation =  \Config\Services::validation();

        $codOrganizacao = session()->codOrganizacao;



        $timezone = 'America/Recife';

        date_default_timezone_set($timezone);

        helper(['notificacoes', 'seguranca', 'formularios', 'pdf', 'alertas']);
        $this->LogsModel = new LogsModel();
        $this->ColaboradoresModel = new ColaboradoresModel();
        $this->OrganizacoesModel = new OrganizacoesModel();
        $this->atendimentosModel = new AtendimentosModel();
        $this->PainelChamadasModel = new PainelChamadasModel();

        $dadosOrganizacao = $this->OrganizacoesModel->pegaDadosBasicosOrganizacao($codOrganizacao);

        session()->set('descricaoOrganizacao', $dadosOrganizacao->descricao);
        session()->set('logo', $dadosOrganizacao->logo);
    }

    public function index()
    {

        return view('painelChamadas');
    }





    public function painelChamadas()
    {
        $response = array();



        $data['data'] = array();


        $result = $this->PainelChamadasModel->marcados();

        foreach ($result as $key => $value) {

            if ($value->dataCriacao !== NULL) {
                $horaChegada = date('H:i', strtotime($value->dataCriacao));
                $tempoAssistencia = intervaloTempoHoraMinutos($value->dataCriacao, date('Y-m-d H:i'));
            } else {
                $horaChegada = "";
                $tempoAssistencia  = "";
            }


            $statusChegou = '';
            $periodo = '';


            $data['data'][$key] = array(
                $value->nomeCompleto,
                $value->especialidade,
                $horaChegada,
                $tempoAssistencia,
            );
        }

        return $this->response->setJSON($data);
    }


    public function listaDropDownEspecialidades()
    {

        $result = $this->PainelChamadasModel->listaDropDownEspecialidades();

        if ($result !== NULL) {


            return $this->response->setJSON($result);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }


    public function verificaChamadas()
    {

        $data['data'] = array();

        $chamados = $this->PainelChamadasModel->pacientesChamados();


        if (!empty($chamados)) {


            if ($chamados->qtdChamadas >= 1) {

                $data['qtdChamadas'] = $chamados->qtdChamadas - 1;

                if ($chamados->codChamada !== NULL and $chamados->codChamada !== "" and $chamados->codChamada !== " ") {

                    $this->PainelChamadasModel->update($chamados->codChamada, $data);
                }

                $tratamento = "";
                $data['success'] = true;
                $data['sala'] = $chamados->localAssistencia;
                $data['pacienteModal'] = '
                <div style="font-weight: bold;">' . $chamados->especialidade . '<div>
                <div style="font-size:80px;font-weight: bold;margin-top:20px">' . $chamados->nomeCompleto . '<div>
                <div style="margin-top:0px">' . $chamados->localAssistencia . '<div>';

                $data['textoLeitura'] = $tratamento . " " . $chamados->nomeCompleto . " " . $data['sala'];
            }

            if ($chamados->ultimaChamada > 10) {
                $this->PainelChamadasModel->where('codChamada', $chamados->codChamada)->delete();
            }


            return $this->response->setJSON($data);
        } else {
            $data['success'] = false;
            return $this->response->setJSON($data);
        }
    }



    public function pacientesUltimasChamadas($especialidades = NULL)
    {

        $data['data'] = array();

        $result = $this->PainelChamadasModel->pacientesUltimasChamadas();

        foreach ($result as $key => $value) {



            $data['data'][$key] = array(
                $value->nomePaciente,
                '<center>' . $value->Nrchamadas . '</center>',
                $value->especialista, // . $value->localAssistencia,

            );
        }

        return $this->response->setJSON($data);
    }
}
