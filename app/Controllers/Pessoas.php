<?php
// Licença GNU GPL

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Services;

use App\Models\AtributosSistemaModel;
use App\Models\LogsModel;
use App\Models\PessoasModel;
use App\Models\OrganizacoesModel;
use App\Models\AtributosSistemaOrganizacaoModel;
use App\Models\PerfilPessoasMembroModel as PerfilPessoasMembroModel;


class Pessoas extends BaseController
{

    protected $PessoasModel;
    public $request;
    protected $OrganizacoesModel;
    protected $Organizacao;
    protected $AtrubutosOrganizacaoSistama;
    protected $validation;
    protected $LogsModel;


    public function __construct()
    {

        helper(['seguranca', 'formularios']);
        verificaSeguranca($this, session(), base_url());
        $this->LogsModel = new LogsModel();



        $this->PessoasModel = new PessoasModel();
        $this->OrganizacoesModel = new OrganizacoesModel();
        $this->AtributosSistemaModel = new AtributosSistemaModel();


        $AtrubutosSistama = $this->AtributosSistemaModel->pegaTudo();

        //pega atributos disponiveis e passa para a view
        $this->AtributosSistemaOrganizacaoModel = new AtributosSistemaOrganizacaoModel();

        $AtrubutosOrganizacaoSistama = $this->AtributosSistemaOrganizacaoModel->pegaAtributosOrganizacao($visivelFomulario = 1);


        $this->LogsModel = new LogsModel(); // $this->LogsModel->inserirLog('descrição da ocorrencia',$codColaborador);
        $this->validation =  \Config\Services::validation();

        $this->codOrganizacao = session()->codOrganizacao;
        $this->OrganizacoesModel =  $this->OrganizacoesModel->pegaOrganizacao($this->codOrganizacao);
    }

    public function index()
    {

        $permissao = verificaPermissao('Pessoas', 'listar');
        if ($permissao == 0) {
            echo mensagemAcessoNegado(session()->organizacoes);
            $this->LogsModel->inserirLog('Acesso indevido ao Módulo Pessoas', session()->codColaborador);
            exit();
        }

        $data = [
            'controller'        => 'pessoas',
            'title'             => 'Pessoas'
        ];
        echo view('tema/cabecalho');
        echo view('tema/menu_vertical');
        echo view('tema/menu_horizontal');
        return view('pessoas', $data);
    }

    public function aniversariantes()
    {


        $data = [
            'controller'        => 'pessoas',
            'title'             => 'Pessoas'
        ];
        echo view('tema/cabecalho');
        echo view('tema/menu_vertical');
        echo view('tema/menu_horizontal');
        return view('aniversariantes', $data);
    }

    public function listaDropDownPessoas()
    {

        $result = $this->PessoasModel->listaDropDownPessoas();

        if ($result !== NULL) {


            return $this->response->setJSON($result);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function listaDropDownMotivosInativos()
    {

        $result = $this->PessoasModel->listaDropDownMotivosInativos();

        if ($result !== NULL) {


            return $this->response->setJSON($result);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }


    public function listaTodasPessoasAteDesativados()
    {

        $result = $this->PessoasModel->listaTodasPessoasAteDesativados();

        if ($result !== NULL) {


            return $this->response->setJSON($result);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }


    public function listaDropDownSolicitante()
    {

        $result = $this->PessoasModel->listaDropDownSolicitante();

        if ($result !== NULL) {


            return $this->response->setJSON($result);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }




    public function gerarVCARD()
    {

        $pessoas = $this->PessoasModel->pegarVCARD();

        $response = array();
        $contatos = "";

        foreach ($pessoas as $pessoa) {
            $celular = $pessoa->celular;
            $telefoneresidencial = $pessoa->telefoneresidencial;
            $pessoa->endereco = str_ireplace(",", "\,", $pessoa->endereco);
            $contatos .= "BEGIN:VCARD" . "<br>";
            $contatos .= "VERSION:3.0" . "<br>";
            $contatos .= "FN:$pessoa->nomeexibicao<br>";
            $contatos .= "N:;$pessoa->nomeexibicao - 	$pessoa->siglaOrganizacao - $pessoa->secao ;;;" . "<br>";
            $contatos .= "item1.EMAIL;TYPE=INTERNET:$pessoa->emailpessoal" . "<br>";
            $contatos .= "item1.X-ABLabel:Particular" . "<br>";
            $contatos .= "EMAIL;TYPE=INTERNET;TYPE=WORK:$pessoa->emailfuncional" . "<br>";
            $contatos .= "TEL;TYPE=CELL:$celular" . "<br>";
            $contatos .= "TEL;TYPE=HOME:$telefoneresidencial" . "<br>";
            $contatos .= "ADR;TYPE=HOME:;$pessoa->endereco;;;;;" . "<br>";
            $contatos .= "item2.ORG:;$pessoa->endereco" . "<br>";
            $contatos .= "item2.X-ABLabel:" . "<br>";
            $contatos .= "item3.TITLE:$pessoa->siglaOrganizacao" . "<br>";
            $contatos .= "item3.X-ABLabel:" . "<br>";
            $contatos .= "BDAY;VALUE=text:$pessoa->datanascimento" . "<br>";
            $contatos .= "ROLE:$pessoa->quadro" . "<br>";
            $contatos .= "NOTE:$pessoa->secao\nLocation: $pessoa->secao" . "<br>";
            $contatos .= "END:VCARD" . "<br>";
        }


        if ($pessoas !== NULL) {

            $response['success'] = true;
            $response['csrf_hash'] = csrf_hash();
            $response['contatos'] = $contatos;
        } else {
            $response['success'] = false;
        }

        return $this->response->setJSON($response);
    }


    public function listaDropDownResponsaveis()
    {

        $result = $this->PessoasModel->listaDropDownResponsaveis();

        if ($result !== NULL) {


            return $this->response->setJSON($result);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }


    public function contas()
    {
        $response = array();
        $lista = array();
        $contas = $this->PessoasModel->contas();

        foreach ($contas as $row) {
            array_push($lista, $row->conta);
        }

        if (!empty($lista)) {
            $response['success'] = true;
            $response['csrf_hash'] = csrf_hash();
            $response['jsonContas'] = json_encode($lista);
        } else {
            $response['success'] = true;
            $response['csrf_hash'] = csrf_hash();
            $response['jsonContas'] = json_encode("");
        }

        return $this->response->setJSON($response);
    }






    public function desativarPessoa($codColaborador = null)
    {
        if ($codColaborador == NULL) {
            $codColaborador = $this->request->getPost('codColaborador');
        }


        if ($this->request->getPost('codMotivoInativo') !== NULL and $this->request->getPost('codMotivoInativo') !== "") {

            $codMotivoInativo = $this->request->getPost('codMotivoInativo');
            //estabelece o motivo
            $response = desativarPessoaHelper($this, $codColaborador, $codMotivoInativo);
        } else {

            $response['success'] = false;
            $response['messages'] = 'É necessário definir um motivo para desativação';
            return $this->response->setJSON($response);
        }



        return $this->response->setJSON($response);
    }

    public function reativarPessoa($codColaborador = null)
    {
        $response = reativarPessoaHelper($this, $codColaborador);
        return $this->response->setJSON($response);
    }



    public function filtrar()
    {
        if ($this->request->getPost('codColaborador')  !== NULL) {
            $codColaborador = $this->request->getPost('codColaborador');
        }

        session()->set('filtroPessoa', $codColaborador);

        if ($this->request->getPost('desativados') == 'on') {
            session()->set('filtroDesativados', 1);
        } else {
            session()->set('filtroDesativados', 0);
        }


        $response = array();

        $response['success'] = true;
        $response['csrf_hash'] = csrf_hash();
        return $this->response->setJSON($response);
    }







    public function getAll()
    {
        $response = array();

        $data['data'] = array();

        $result = $this->PessoasModel->pega_pessoas();

        foreach ($result as $key => $value) {

            $ops = '<div class="text-center"><div style="text-align:center" class="btn-group mt-4">';
            $ops .= '	<button style="margin-left:1px" type="button" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Editar pessoa" onclick="edit(' . $value->codColaborador . ')"><i class="fa fa-edit"></i></button>';
            $ops .= '	<button style="margin-left:1px" type="button" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Troca de senha" onclick="trocasenha(' . $value->codColaborador . ')"><i class="fa fa-user-lock"></i></button>';
            $ops .= '	<button style="margin-left:1px" type="button" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Remover pessoa" onclick="remove(' . $value->codColaborador . ')"><i class="fa fa-trash"></i></button>';

            if ($value->ativo == 0) {
                $ops .= '	<button style="margin-left:1px" type="button" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Reativar pessoa" onclick="reativarPessoa(' . $value->codColaborador . ')"><i style="font-size:15px" class="fas fa-user"></i></button>';
            }
            if ($value->ativo == 1) {
                $ops .= '	<button style="margin-left:1px" type="button" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Desativar pessoa" onclick="confirmacaoDesativacao(' . $value->codColaborador . ',\'' . $value->nomeExibicao . '\')"><i style="font-size:12px" class="fas fa-user-slash"></i></button>';
            }

            $ops .= '</div>
        
            </div>';

            if ($value->ativo == 0) {
                $ativo = ' <span><i style="font-size:20px" class="fas fa-user-slash text-danger"></i></span>';
            }
            if ($value->ativo == 1) {
                $ativo = ' <span><i style="font-size:20px" class="fas fa-user text-success"></i></span>';
            }

            if ($value->codMotivoInativo !== NULL) {
                $nomeExibicao = $value->nomeExibicao . " (" . $value->descricaoMotivoInativacao . ")";
            } else {
                $nomeExibicao = $value->nomeExibicao;
            }


            $data['data'][$key] = array(
                $value->codColaborador . $ativo,
                $value->conta,
                $nomeExibicao,
                $value->nomeCompleto,
                $value->descricaoDepartamento,
                $ops,
            );
        }

        return $this->response->setJSON($data);
    }

    public function imprimirAniversariantes()
    {

        $codStatus = "";
        $html = '
        <style>
        .border-dotted{
            border-style: inset; #dashed;            
            border-width: 3px;
            border-color:gray;
           }

           .imagemDeFundo{
            background: url("' . base_url() . '/imagens/cartao.png"); 
        }

        </style>
        
        <div class="row">';
        $contador = 0;
        foreach ($this->request->getPost() as $chave => $atributo) {
            $contador++;
            $fields = array();

            if (strpos($chave,  'imprimirCheckbox') !== false) {
                $codColaborador = str_replace('imprimirCheckbox', '', $chave);


                $pessoa = $this->PessoasModel->pegaPessoaPorCodColaborador($codColaborador);

                $dia =  session()->cidade . '-' . session()->uf . ', ' . date('d', strtotime($pessoa->dataNascimento)) . ' de ' . nomeMesPorExtenso(date('m', strtotime($pessoa->dataNascimento))) . ' de ' . date('Y') . '.';

                $html .= '
                <div style="width:145mm;height:105mm;margin-top:2px" class="col-md-6 imagemDeFundo">
                   
                    <div style="margin-top:80px" class="row text-center">
                        <div style="font-size:20px;font-weight:bold" class="col-md-12">
                            '.$pessoa->descricao.'
                        </div>
                    </div>

                    <div style="margin-left:10px" class="row justify-content-start">
                        <div style="margin-top:20px" class="col-md-12">
                            Caríssimo (a), <span style="font-weight:bold">' . $pessoa->nomeExibicao . '</span>, os integrantes do '.$pessoa->siglaOrganizacao.' a parabenixzam pelo transcurso da sua data natalícia formulando votos de sucesso, paz e saúde.
                        </div>

                    </div>
                    <div  style="margin-left:10px" class="row text-right">
                        <div style="margin-top:20px;" class="col-md-12">
                          ' . $dia . '
                        </div>
                    </div> 

                    <div style="margin-left:10px" class="row text-left">
                        <div style="margin-top:20px;" class="col-md-12">
                           Atenciosamente,
                        </div>
                    </div> 

                    <div style="margin-top:30px" class="row text-center">
                        <div style="font-weight:bold" class="col-md-12">
                            HAILTON ANTÔNIO CASARA CAVALCANTE
                        </div>
                    </div>
                    <div style="margin-top:0px" class="row text-center">
                        <div style="" class="col-md-12">
                           DIRETOR DO '.$pessoa->siglaOrganizacao.'
                        </div>
                    </div>
                   
                
                
                
                </div>';
            }

            if ($contador > 4) {
                $contador = 0;
                $html .= '<h1></h1>';
            }
        }

        $html . '</div>';


        $response['success'] = true;
        $response['html'] = $html;

        return $this->response->setJSON($response);
    }
    public function listaAniversariantes()
    {
        $response = array();

        $data['data'] = array();

        $aniversariantes = $this->PessoasModel->aniversariantes4Dias();

        foreach ($aniversariantes as $key => $value) {

            $checkbox = '<input class="imprimirCheckbox" name="imprimirCheckbox' . $value->codColaborador . '" type="checkbox" >';

            $ops = '';
            $data['data'][$key] = array(
                $checkbox . '<span style="margin-left:5px"> </span> ' . $value->dia . ' (' . diaSemanaCompleto(date('Y') . '-' . date('m-d', strtotime($value->dataNascimento))) . ')',
                $value->nomeExibicao,
                $value->descricaoDepartamento,
                $value->emailPessoal,
                $value->celular,
                $ops,
            );
        }

        return $this->response->setJSON($data);
    }




    public function pegaMeusPerfisValidos()
    {
        $this->PerfilPessoasMembroModel = new PerfilPessoasMembroModel;
        $id = $this->request->getPost('codColaborador');
        $meusPerfisValidos = $this->PerfilPessoasMembroModel->pegaMeusPerfisValidos($id);
        return $this->response->setJSON($meusPerfisValidos);
    }


    public function verificaPendenciaCadastro()
    {
        $response = array();

        if (session()->codPaciente !== NULL) {
            $response['pendencias'] = false;
            $response['quantidade'] = 0;


            return $this->response->setJSON($response);
        }


        $codColaborador = session()->codColaborador;
        $codOrganizacao = session()->codOrganizacao;

        $pessoa = $this->PessoasModel->organizacaoPessoa($codColaborador);


        $atributos = $this->AtributosSistemaOrganizacaoModel->pegaTudoPorOrganizacao($codOrganizacao);

        $ArrayAtributos = array();
        foreach ($atributos as $atributo) {
            if ($atributo->visivelFormulario == 1 and $atributo->obrigatorio == 1) {
                array_push($ArrayAtributos, $atributo->nomeAtributoSistema);
            }
        }
        //print_r($ArrayAtributos);
        $nrPendencias = 0;
        foreach ($ArrayAtributos as $item) {
            if ($pessoa->$item == NULL or $pessoa->$item == '0000-00-00') {

                $nrPendencias++;
            } else {
                //print 'NÃO Tem Nulo';
            }
        }
        $data = array('pendencias' => $nrPendencias);

        if ($nrPendencias > 0 and $codColaborador !== 0) {
            $response['pendencias'] = true;
            $response['quantidade'] = $nrPendencias;
        } else {
            $response['pendencias'] = false;
            $response['quantidade'] = $nrPendencias;
        }

        return $this->response->setJSON($response);
    }



    public function verificaPendenciaSenha()
    {
        $response = array();

        if (session()->codPaciente !== NULL) {
            $response['pendencias'] = false;
            $response['quantidade'] = 0;


            return $this->response->setJSON($response);
        }

        $codColaborador = session()->codColaborador;
        $codOrganizacao = session()->codOrganizacao;

        $pessoa = $this->PessoasModel->organizacaoPessoa($codColaborador);

        if ($pessoa->senha == NULL and $codColaborador !== 0) {
            $response['pendencias'] = true;
        }

        return $this->response->setJSON($response);
    }


    public function getOne()
    {
        $response = array();

        $id = $this->request->getPost('codColaborador');

        if ($this->validation->check($id, 'required|numeric')) {

            $data = $this->PessoasModel->where('codColaborador', $id)->first();

            return $this->response->setJSON($data);
        } else {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }


    public function pegaOrganizacaoPessoa()
    {
        $response = array();

        if ($this->request->getPost('codColaborador') == NULL) {
            $codColaborador = session()->codColaborador;
        } else {
            $codColaborador = $this->request->getPost('codColaborador');
        }




        if ($this->validation->check($codColaborador, 'required|numeric')) {

            $data = $this->PessoasModel->organizacaoPessoa($codColaborador);

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
        $contas = $this->PessoasModel->contas();

        foreach ($contas as $row) {
            array_push($lista, $row->conta);
        }

        if ($this->request->getPost('conta') !== NULL) {
            if (in_array($this->request->getPost('conta'), $lista)) {
                $response['success'] = 'contaExistente';
                $response['mensagem'] = 'A conta "' . $this->request->getPost('conta') . " já está em uso!";

                return $this->response->setJSON($response);
            }
        }

        $fields['codOrganizacao'] =  $this->request->getPost('codOrganizacao');
        $fields['codColaborador'] = $this->request->getPost('codColaborador');
        $fields['codClasse'] = 1;
        $fields['conta'] = mb_strtolower(removeCaracteresIndesejados(trim($this->request->getPost('conta'))), 'utf-8');
        $fields['nomeExibicao'] = mb_strtoupper($this->request->getPost('nomeExibicao'), "utf-8");
        $fields['nomePrincipal'] = mb_strtoupper($this->request->getPost('nomePrincipal'), "utf-8");
        $fields['nomeCompleto'] = mb_strtoupper($this->request->getPost('nomeCompleto'), "utf-8");
        $fields['identidade'] = $this->request->getPost('identidade');
        $fields['cpf'] = removeCaracteresIndesejados($this->request->getPost('cpf'));
        $fields['codBen'] = removeCaracteresIndesejados($this->request->getPost('codBen'));
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
            'conta' => ['label' => 'Conta', 'rules' => 'required|max_length[40]'],
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
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($codColaborador = $this->PessoasModel->insert($fields)) {


                $response['success'] = true;
                $response['csrf_hash'] = csrf_hash();
                $response['codColaboradorCriada'] = $codColaborador;
                $response['messages'] = 'Pessoa criada com sucesso';
            } else {

                $response['success'] = false;
                $response['messages'] = 'Erro na inserção!';
            }
        }


        return $this->response->setJSON($response);
    }


    public function  importarPessoasApolo()
    {

        ini_set('max_execution_time', '0'); //300 seconds = 5 minutes
        set_time_limit(0);

        $inicioProcesso = time();

        $PessoasApolo = $this->PessoasModel->pessoasApolo();

        $pessoasNovas = 0;
        $pessoasAtualizadas = 0;
        foreach ($PessoasApolo as $pessoaApolo) {
            $fields = array();

            $cpf = removeCaracteresIndesejados($pessoaApolo->cpf);

            if (!is_numeric($cpf)) {
                $cpf = null;
            }
            $nomeCompleto = mb_strtoupper($pessoaApolo->nome, "utf-8");
            $nomeCompletoSemAcento = removeAcentos(mb_strtoupper($pessoaApolo->nome, "utf-8"));
            $pessoasLocal = $this->PessoasModel->pegaPessoaPorcpfOuNomeCompleto(trim($cpf), trim($nomeCompleto), $nomeCompletoSemAcento);


            if (empty($pessoasLocal)) {


                if (is_numeric($cpf) !== true) {
                    $cpf = $pessoaApolo->prec_cp; //para gerar numero aleatório
                }

                $fields['codOrganizacao'] =  session()->codOrganizacao;
                $fields['codClasse'] = 1;
                $fields['conta'] = $cpf;
                $fields['nomeExibicao'] = mb_strtoupper(postoGraduacaoDescricao($pessoaApolo->p_grad), "utf-8") . ' ' . mb_strtoupper($pessoaApolo->nome, "utf-8");
                $fields['nomePrincipal'] = trim($pessoaApolo->nome);
                $fields['nomeCompleto'] = trim($pessoaApolo->nome);
                $fields['identidade'] = $pessoaApolo->idt;
                $fields['cpf'] = removeCaracteresIndesejados($cpf);
                $fields['codBen'] = removeCaracteresIndesejados($pessoaApolo->cod_ben);
                $fields['emailFuncional'] = null;
                $fields['emailPessoal'] = null;
                $fields['codEspecialidade'] = null;
                $fields['telefoneTrabalho'] = null;
                $fields['celular'] = null;
                $fields['endereco'] = null;
                $fields['dataInicioEmpresa'] = $pessoaApolo->data_lc;
                $fields['dataCriacao'] = date('Y-m-d H:i:s');
                $fields['dataAtualizacao'] = date('Y-m-d H:i:s');
                $fields['dataNascimento'] = $pessoaApolo->data_nasc;
                $fields['codDepartamento'] = null;
                $fields['codFuncao'] = null;
                $fields['codCargo'] = postoGraduacaoLookup($pessoaApolo->p_grad);
                $fields['codPerfilPadrao'] = 0;
                $fields['nrEndereco'] = $this->request->getPost('nrEndereco');
                $fields['codMunicipioFederacao'] = null;
                $fields['cep'] = null;
                $fields['informacoesComplementares'] = 'Migrado do apolo';
                $fields['ativo'] = 0;
                $fields['aceiteTermos'] = 0;
                if ($this->PessoasModel->insert($fields)) {
                    $pessoasNovas++;
                }

                //COPIA FOROPERFIL
                @copy('arquivos/imagens/pacientes/' . $pessoaApolo->file_up, 'arquivos/imagens/pessoas/' . $cpf . '.jpeg');

                $fields['fotoPerfil'] = $cpf . '.jpeg';
            } else {

                if (is_numeric($cpf) !== true) {
                    $cpf = $pessoaApolo->prec_cp; //para gerar numero aleatório
                }
                if ($pessoasLocal->fotoPerfil == NULL or $pessoasLocal->fotoPerfil == "") {
                    $fields['fotoPerfil'] = $cpf . '.jpeg';
                    @copy('arquivos/imagens/pacientes/' . $pessoaApolo->file_up, 'arquivos/imagens/pessoas/' . $cpf . '.jpeg');
                    $fields['fotoPerfil'] = $cpf . '.jpeg';
                }
                if ($this->PessoasModel->update($pessoasLocal->codColaborador, $fields)) {
                    $pessoasAtualizadas++;
                }
            }
        }

        $fimProcesso = time();
        $tempo = $fimProcesso - $inicioProcesso;
        $tempo = $tempo / 60;

        $response['success'] = true;
        $response['csrf_hash'] = csrf_hash();
        $response['messages'] = '
        <div>Informações importadas com sucesso.</div>
        <div>Tempo de execução: ' . $tempo . '</div>
        <div>Pessoas Novas: ' . $pessoasNovas . '</div>
        <div>Pessoas Atualizadas: ' . $pessoasAtualizadas . '</div>';
        return $this->response->setJSON($response);
    }




    public function edit()
    {
        sleep(2);

        $response = array();

        $fields['codOrganizacao'] = $this->request->getPost('codOrganizacao');
        $fields['codColaborador'] = $this->request->getPost('codColaborador');
        $fields['nomeCompleto'] = mb_strtoupper($this->request->getPost('nomeCompleto'), "utf-8");
        $fields['nomeExibicao'] = mb_strtoupper($this->request->getPost('nomeExibicao'), "utf-8");

        if (session()->codColaborador == $this->request->getPost('codColaborador')) {

            session()->nomeExibicao = $this->request->getPost('nomeExibicao');
        }

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
            'emailPessoal' => ['label' => 'Email pessoal', 'rules' => 'permit_empty|max_length[40]'],
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

            if ($this->PessoasModel->update($fields['codColaborador'], $fields)) {

                $response['success'] = true;
                $response['csrf_hash'] = csrf_hash();
                $response['messages'] = 'Atualizado com sucesso';
            } else {

                $response['success'] = true;
                $response['csrf_hash'] = csrf_hash();
                $response['messages'] = 'Erro na atualização!';
            }
        }

        return $this->response->setJSON($response);
    }

    public function teste()
    {
        return $this->response->setJSON(true);
    }


    function enviaFoto()
    {

        //FAZ O UPLOAD E GRAVA NO BANCO

        $response = array();

        $avatar = $this->request->getFile('file');

        if ($this->request->getFile('file') == NULL) {
            $response['success'] = false;
            return $this->response->setJSON($response);
        }

        $nomeArquivo = removeCaracteresIndesejados($this->request->getPost('codColaborador'))  . '.' . $avatar->getClientExtension();
        $avatar->move(WRITEPATH . '../arquivos/imagens/pessoas/',  $nomeArquivo, true);



        $fields['fotoPerfil'] =  $nomeArquivo;


        $db      = \Config\Database::connect();
        $builder = $db->table('pessoas');


        $builder->where('codColaborador', $this->request->getPost('codColaborador'));
        $builder->update($fields);



        $response['success'] = true;
        $response['csrf_hash'] = csrf_hash();
        $response['messages'] = 'Sucesso!';
        $response['meuCodColaborador'] = session()->codColaborador;
        $response['nomeArquivo'] =  $nomeArquivo;



        if (session()->codColaborador == $this->request->getPost('codColaborador')) {
            session()->set('fotoPerfil', $nomeArquivo);
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


        $pessoa = $this->PessoasModel->organizacaoPessoa($codColaborador);


        $fields['codColaborador'] = $codColaborador;
        $fields['senha1'] = $senha;
        $fields['senha2'] = $confirmacao;


        $chave = $pessoa->chaveSalgada;
        $tipo_cifra = 'des';


        //TROCA SENHA 
        $senha = hash("sha256", $this->request->getPost('senha') . $this->OrganizacoesModel->chaveSalgada);
        $fields['senha'] = $senha;
        $fields['dataSenha'] = date('Y-m-d H:i');
        $fields['dataAtualizacao'] = date('Y-m-d H:i');

        $this->validation->setRules([
            'codColaborador' => ['label' => 'codColaborador', 'rules' => 'required|numeric'],
            'senha1' => ['label' => 'Senha', 'rules' => 'permit_empty|matches[senha2]'],
            'senha2' => ['label' => 'Confirmação', 'rules' => 'required|max_length[40]'],
        ]);


        $qtdSenhasArmazenadas = $pessoa->diferenteUltimasSenhas;

        if ($qtdSenhasArmazenadas > 0) {
            $historicoSenhas = array();
            $historicoSenhas  = explode(",", $pessoa->historicoSenhas);

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

            if ($this->PessoasModel->update($fields['codColaborador'], $fields)) {

                $response['success'] = true;
                $response['csrf_hash'] = csrf_hash();
           
                $response['messages'] = '<div style="font-weight:bold;font-size:18px">Senha atualizada com sucesso</div><br>';

            } else {

                $response['success'] = false;
                $response['messages'] = 'Erro na atualização da senha!';
            }
        }

        sleep(3);
        return $this->response->setJSON($response);
    }



    public function verificaViolacaoTrocaSenha()
    {
        $response = array();
        if ($this->request->getPost('codColaborador') !== session()->codColaborador) {
            $response['success'] = true;
            $response['messages'] = 'VIOLAÇÃO DE ACESSO: Você não pode alterar a senha de outra pessoa!';
        }
        return $this->response->setJSON($response);
    }

    public function dadosTcle()
    {

        $response['dadosTcle'] = "";

        $response = array();
        if ($this->request->getPost('codColaborador') !== session()->codColaborador) {
            $data = $this->PessoasModel->where('codColaborador', $this->request->getPost('codColaborador'))->first();
            $response['success'] = true;
            $dataExtenso = session()->cidade . '-' . session()->uf . ', ' . date('d', strtotime(date('Y-m-d'))) . ' de ' . nomeMesPorExtenso(date('m', strtotime(date('Y-m-d')))) . ' de ' . date('Y', strtotime(date('Y-m-d'))) . '.';

        }
        return $this->response->setJSON($response);
    }

    public function trocaSenhaPessoaLogada($codColaborador = null, $senha = null, $confirmacao = null)
    {


        $response = array();


        if ($codColaborador == null) {
            if ($this->request->getPost('codColaborador') == NULL) {
                $codColaborador = session()->codColaborador;
            } else {
                $codColaborador = $this->request->getPost('codColaborador');
            }
        } else {
            $codColaborador = $codColaborador;
        }

        if ($codColaborador !== session()->codColaborador) {
            $response['success'] = false;
            $response['messages'] = 'VIOLAÇÃO DE ACESSO: Você não pode alterar a senha de outra pessoa!';

            return $this->response->setJSON($response);
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


        $pessoa = $this->PessoasModel->organizacaoPessoa($codColaborador);


        $fields['codColaborador'] = $codColaborador;
        $fields['senha1'] = $senha;
        $fields['senha2'] = $confirmacao;


        $chave = $pessoa->chaveSalgada;
        $tipo_cifra = 'des';


        $statusTrocaSenha = "";
        
        

        //TROCA SENHA 
        $senha = hash("sha256", $this->request->getPost('senha') . $this->OrganizacoesModel->chaveSalgada);
        $fields['senha'] = $senha;
        $fields['dataSenha'] = date('Y-m-d H:i');
        $fields['dataAtualizacao'] = date('Y-m-d H:i');

        $this->validation->setRules([
            'codColaborador' => ['label' => 'codColaborador', 'rules' => 'required|numeric'],
            'senha1' => ['label' => 'Senha', 'rules' => 'permit_empty|matches[senha2]'],
            'senha2' => ['label' => 'Confirmação', 'rules' => 'required|max_length[40]'],
        ]);


        $qtdSenhasArmazenadas = $pessoa->diferenteUltimasSenhas;

        if ($qtdSenhasArmazenadas > 0) {
            $historicoSenhas = array();
            $historicoSenhas  = explode(",", $pessoa->historicoSenhas);

            if (count($historicoSenhas) >= $qtdSenhasArmazenadas) {
                unset($historicoSenhas[0]);
            }

            $historicoSenhas  = implode(",", $historicoSenhas);

            $fields['historicoSenhas'] = $historicoSenhas . "," . '"' . $senha . '"';
        } else {
            $fields['historicoSenhas'] = '';
        }

        if ($this->validation->run($fields) == FALSE and $codColaborador !== NULL and $codColaborador !== '') {

            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {

            if ($this->PessoasModel->update($fields['codColaborador'], $fields)) {
                $statusTrocaSenha .= ' Sistema Local - <i class="fas fa-check text-success"></i> <br> ';

                $response['success'] = true;
                $response['csrf_hash'] = csrf_hash();

                $response['messages'] = '<div style="font-weight:bold;font-size:18px">Senha atualizada com sucesso</div><br>';


            } else {

                $response['success'] = false;
                $response['messages'] = 'Erro na atualização da senha!';
            }
        }

        sleep(3);
        return $this->response->setJSON($response);
    }



    public function remove()
    {
        $response = array();

        $id = $this->request->getPost('codColaborador');

        if (!$this->validation->check($id, 'required|numeric')) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {


            if ($this->PessoasModel->where('codColaborador', $id)->delete()) {


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
