<?php

//Licença GNU GPL


namespace App\Controllers;
use DateTime;

use app\Models\ModelosNotificacaoModel as ModelosNotificacaoModel;
use app\Models\PerfisModel as PerfisModel;
use app\Models\CargosModel as CargosModel;
use app\Models\FuncoesModel as FuncoesModel;
use app\Models\AtendimentosModel as AtendimentosModel;
use app\Models\PacientesModel as PacientesModel;
use app\Models\ModulosModel as ModulosModel;
use app\Models\TipoLDAPModel as TipoLDAPModel;
use app\Models\RelatoriosModel as RelatoriosModel;
use app\Models\OrganizacoesModel as OrganizacoesModel;
use app\Models\EscalasModel as EscalasModel;
use app\Models\DepartamentosModel as DepartamentosModel;
use app\Models\ExamesListaModel as ExamesListaModel;
use app\Models\EspecialidadesModel as EspecialidadesModel;
use app\Models\StatusProjetosModel as StatusProjetosModel;
use app\Models\TiposProjetosModel as TiposProjetosModel;
use app\Models\QuestionariosModel as QuestionariosModel;
use app\Models\AssistenciaslocaisModel as AssistenciaslocaisModel;
use app\Models\AssistenciaDiagnosticoModel as AssistenciaDiagnosticoModel;
use app\Models\RotinasModel as RotinasModel;
use app\Models\ProtocolosRedeModel as ProtocolosRedeModel;
use app\Models\ExercitoAgendasModel as ExercitoAgendasModel;
use app\Models\AssistenciasModel as AssistenciasModel;
use app\Models\AtributosSistemaModel as AtributosSistemaModel;
use app\Models\AtributosTipoLDAPModel as AtributosTipoLDAPModel;
use app\Models\MunicipiosFederacaoModel as MunicipiosFederacaoModel;
use app\Models\PerfilPessoasMembroModel as PerfilPessoasMembroModel;
use app\Models\PortalOrganizacaoModel as PortalOrganizacaoModel;
use app\Models\AtributosSistemaOrganizacaoModel as AtributosSistemaOrganizacaoModel;
use app\Models\ModulosNotificacaoModel as ModulosNotificacaoModel;
use app\Models\SlideshowModel as SlideshowModel;



function multiSiteLoginAtivado()
{

    $PortalOrganizacaoModel = new PortalOrganizacaoModel;
    $multiSiteLoginAtivado = $PortalOrganizacaoModel->multiSiteLoginAtivado();


    return $multiSiteLoginAtivado;
}



function brl2decimal($brl, $casasDecimais = 2)
{
    if ($brl == NULL) {
        return null;
    }
    // Se já estiver no formato USD, retorna como float e formatado
    if (preg_match('/^\d+\.{1}\d+$/', $brl))
        return (float) number_format($brl, $casasDecimais, '.', '');
    // Tira tudo que não for número, ponto ou vírgula
    $brl = preg_replace('/[^\d\.\,]+/', '', $brl);
    // Tira o ponto
    $decimal = str_replace('.', '', $brl);
    // Troca a vírgula por ponto
    $decimal = str_replace(',', '.', $decimal);
    return (float) number_format($decimal, $casasDecimais, '.', '');
}






function parentestolookup($valor)
{
    if ($valor == 'OUTRO(A)') {
        return 6;
    }
    if ($valor == 'MÃE') {
        return 2;
    }
    if ($valor == 'PAI') {
        return 1;
    }
    if ($valor == 'ESPOSA') {
        return 3;
    }
    if ($valor == 'FILHO(A)') {
        return 4;
    }
    if ($valor == 'OUTROS') {
        return 6;
    }
    if ($valor == 'IRMÃ(0)') {
        return 5;
    }
    return 6;
}

function lookupCodNomeEspecialidadesJson($especialidades)
{

    $especialidades = removeBraketsJson($especialidades);
    $AtendimentosModel = new AtendimentosModel;
    $especialidades = $AtendimentosModel->lookupCodNomeEspecialidadesJson($especialidades);
    return  $especialidades;
}



function previsaoAlta($data = NULL, $dataEncerramento = NULL, $indeterminado = NULL)
{

    $previsao = array();


    if ($indeterminado == 1) {
        $dataPrevAlta = 'Indeterminada';
        //FALTAM
        $faltam =  '';

        $previsao['dataPrevAlta'] = $dataPrevAlta;
        $previsao['faltam'] = $faltam;

        return $previsao;
    }


    if ($data !== NULL) {


        if (date('Y-m-d', strtotime($data)) == date('Y-m-d')) {

            $dataPrevAlta = 'Hoje, ' . date('d/m/Y', strtotime($data));;

            //FALTAM
            $faltam =  'Falta 0 dia  ';
        }


        if (date('Y-m-d', strtotime($data)) > date('Y-m-d')) {
            $dataPrevAlta = date('d/m/Y', strtotime($data));

            //FALTAM
            $faltam =  'Falta(m)  ' . intervaloTempoAssistencia($data, DATE('Y-m-d'));
        }

        if (date('Y-m-d', strtotime($data)) < date('Y-m-d')) {
            $dataPrevAlta = date('d/m/Y', strtotime($data));

            //FALTAM
            $faltam =  'Passou ' . intervaloTempoAssistencia($data, DATE('Y-m-d'));
        }

        if (date('Y-m-d', strtotime($data)) == date('Y-m-d', strtotime("+1 day", strtotime(date('Y-m-d'))))) {

            $dataPrevAlta = '<img style="width:20px;" src="' . base_url() . '/imagens/atencao.gif">Amanhã, ' . date('d/m/Y', strtotime($data));;

            //FALTAM
            $faltam =  'Falta 1 dia  ';
        }
    } else {

        $dataPrevAlta = 'Não Informado';
        //FALTAM
        $faltam =  '';
    }

    $previsao['dataPrevAlta'] = $dataPrevAlta;
    $previsao['faltam'] = $faltam;
    if ($dataEncerramento !== NULL) {
        $previsao['faltam'] = '';
    }
    return $previsao;
}


function intervaloTempoAssistencia($dataCriacao = null, $dataEncerramento = null)
{
    $resultadoArray = 0;
    if ($dataEncerramento == null) {
        $resultadoArray = 1;
        $dataEncerramento = date('Y-m-d H:i');
    } else {
        $dataEncerramento = $dataEncerramento;
    }



    $dataCriacao = new DateTime($dataCriacao);
    $dataEncerramento = new DateTime($dataEncerramento);
    $since_start = $dataCriacao->diff($dataEncerramento); // date now



    //ANOS
    if ($since_start->y == 0) {
        $unidadeAno = "";
    }
    if ($since_start->y == 1) {
        $unidadeAno = $since_start->y . " ano";
    }
    if ($since_start->y > 1) {
        $unidadeAno = $since_start->y . " anos";
    }


    //MES
    if ($since_start->m == 0) {
        $unidadeMes = "";
    }
    if ($since_start->m == 1) {
        $unidadeMes = $since_start->m . " mês";
    }
    if ($since_start->m > 1) {
        $unidadeMes = $since_start->m . " meses";
    }


    //SEMANAS
    if ($since_start->ww == 0) {
        $unidadeSemana = "";
    }
    if ($since_start->ww == 1) {
        $unidadeSemana = $since_start->ww . " semana";
    }
    if ($since_start->ww > 1) {
        $unidadeSemana = $since_start->ww . " semanas";
    }


    //DIAS
    if ($since_start->d == 0) {
        $unidadeDia = "";
    }
    if ($since_start->d == 1) {
        $unidadeDia = $since_start->d . " dia";
    }
    if ($since_start->d > 1) {
        $unidadeDia = $since_start->d . " dias";
    }


    //HORAS
    if ($since_start->h == 0) {
        $unidadeHora = "";
    }
    if ($since_start->h == 1) {
        $unidadeHora = $since_start->h . " h";
    }
    if ($since_start->h > 1) {
        $unidadeHora = $since_start->h . " h";
    }


    //MINUTOS
    if ($since_start->i == 0) {
        $unidadeMinuto = "";
    }
    if ($since_start->i == 1) {
        $unidadeMinuto = $since_start->i . " min";
    }
    if ($since_start->i > 1) {
        $unidadeMinuto = $since_start->i . " min";
    }

    if ($resultadoArray == 0) {
        return  $unidadeAno . " " . $unidadeMes . " " . $unidadeSemana . " " . $unidadeDia . " " . $unidadeHora . " " . $unidadeMinuto;
    } else {
        return $tempo = array(
            'unidadeAno' => $unidadeAno,
            'unidadeMes' => $unidadeMes,
            'unidadeDia' => $unidadeDia,
            'unidadeHora' => $unidadeHora,
            'unidadeMinuto' => $unidadeMinuto,
        );
    }
}

function listboxModulospai($CI, $codModulo = null, $hiddenOrDisabled = null)
{
    $gerarID = rand(10, 100);
    $CI->ModulosModel = new ModulosModel;
    $modulo = $CI->ModulosModel->pegaTudo();

    $botao = '
    
    <select style="width:100%" ' . $hiddenOrDisabled . '  id="pai" name="pai">
    
            <option value="0">CATEGORIA</option>';
    foreach ($modulo as $row) {

        $botao .= '
                <option value="' . $row->codModulo . '" >' . $row->nome . '</option>';
    }
    $botao .= "</select>";
    return $botao;
}

function intervaloTempoFatura($dataCriacao = null, $dataEncerramento = null)
{
    $resultadoArray = 0;
    if ($dataEncerramento == null) {
        $resultadoArray = 1;
        $dataEncerramento = date('Y-m-d H:i');
    } else {
        $dataEncerramento = $dataEncerramento;
    }



    $dataCriacao = new DateTime($dataCriacao);
    $dataEncerramento = new DateTime($dataEncerramento);
    $since_start = $dataCriacao->diff($dataEncerramento); // date now



    //ANOS
    if ($since_start->y == 0) {
        $unidadeAno = "";
    }
    if ($since_start->y == 1) {
        $unidadeAno = $since_start->y . " ano";
    }
    if ($since_start->y > 1) {
        $unidadeAno = $since_start->y . " anos";
    }


    //MES
    if ($since_start->m == 0) {
        $unidadeMes = "";
    }
    if ($since_start->m == 1) {
        $unidadeMes = $since_start->m . " mês";
    }
    if ($since_start->m > 1) {
        $unidadeMes = $since_start->m . " meses";
    }


    //DIAS
    if ($since_start->d == 0) {
        $unidadeDia = "";
    }
    if ($since_start->d == 1) {
        $unidadeDia = $since_start->d . " dia";
    }
    if ($since_start->d > 1) {
        $unidadeDia = $since_start->d . " dias";
    }


    if ($resultadoArray == 0) {
        return  $unidadeAno . " " . $unidadeMes . " " . $unidadeDia;
    } else {
        return $tempo = array(
            'unidadeAno' => $unidadeAno,
            'unidadeMes' => $unidadeMes,
            'unidadeDia' => $unidadeDia,
        );
    }
}


function intervaloTempoHoraMinutos($dataCriacao = null, $dataEncerramento = null)
{
    $dataCriacao = new DateTime($dataCriacao);
    $dataEncerramento = new DateTime($dataEncerramento);
    $since_start = $dataCriacao->diff($dataEncerramento); // date now

    $unidadeHora = "hora";
    $unidadeMinuto = "min";
    if ($since_start->h > 1) {
        $unidadeHora = "h";
    }
    if ($since_start->i > 1) {
        $unidadeMinuto = "min";
    }

    if ($since_start->h == 0) {
        return  $since_start->i . " " . $unidadeMinuto;
    } else {
        return  $since_start->h . " " . $unidadeHora . " " . $since_start->i . " " . $unidadeMinuto;
    }
}

function intervaloTempo($dataCriacao = null, $dataEncerramento = null, $diff = "minutes")
{
    $dataCriacao = new DateTime($dataCriacao);
    $dataEncerramento = new DateTime($dataEncerramento);
    $since_start = $dataCriacao->diff($dataEncerramento); // date now


    switch ($diff) {
        case 'seconds':
            return $since_start->s;
            break;
        case 'minutes':
            return $since_start->i;
            break;
        case 'hours':
            return $since_start->h;
            break;
        case 'days':
            return $since_start->d;
            break;
        case 'weeks':
            return $since_start->ww;
            break;
        case 'months':
            return $since_start->m;
            break;
        case 'years':
            return $since_start->y;
            break;
        default:
            # code...
            break;
    }
}


function tipoContatoLookup($valor)
{
    if ($valor == 'OUTRO(A)') {
        return 6;
    }
    if ($valor == 'OUTRO') {
        return 6;
    }
    if ($valor == 'AMIGO(A)') {
        return 5;
    }
    if ($valor == 'FAMILIAR') {
        return 3;
    }
    if ($valor == 'AMIGO') {
        return 5;
    }
    if ($valor == 'CHEFE') {
        return 2;
    }
    if ($valor == 'MÉDICO FAM') {
        return 4;
    }
    if ($valor == 'RESIDENCIAL') {
        return 8;
    }
    if ($valor == 'FUNCIONAL') {
        return 7;
    }
    if ($valor == 'PESSOAL') {
        return 1;
    }
    return 6;
}





function forcaLookup($valor)
{
    if ($valor == 'MB') {
        return 1;
    }
    if ($valor == 'EB') {
        return 2;
    }
    if ($valor == 'FAB') {
        return 3;
    }
    return 2;
}

function lookupCaegoriaItemFarmacia($valor)
{
    if ($valor == 1) {
        return 7;
    }

    if ($valor == 10) {
        return 2;
    }

    if ($valor == 35) {
        return 5;
    }

    if ($valor == 36) {
        return 6;
    }

    if ($valor == 43) {
        return 4;
    }

    if ($valor == 7) {
        return 3;
    }

    if ($valor == 26) {
        return 8;
    }

    if ($valor == 9) {
        return 1;
    }
    if ($valor == 0) {
        return 1;
    }
}



function dataValidade($texto)
{
    $data = explode("@", preg_replace('/[^0-9@]+/', '', str_replace("/", "@", $texto)));

    if (count($data) == 3) {
        return $data[2] . "-" .  $data[1] . "-" .  $data[0];
    }

    if (count($data) == 2) {
        return  $data[1] . "-" . $data[0] . "-" . '01';
    }
    return null;
}




function tipoBeneficiarioLookupSIGH($valor)
{

    if ($valor == 1) {
        return 1;
    }
    if ($valor == 2) {
        return 2;
    }
    if ($valor == 3) {
        return 1;
    }
    if ($valor == 4) {
        return 12;
    }
    if ($valor == 5) {
        return 1;
    }
    if ($valor == 6) {
        return 1;
    }
    if ($valor == 7) {
        return 5;
    }
    if ($valor == 8) {
        return 1;
    }
    if ($valor == 9) {
        return 9;
    }
    if ($valor == 10) {
        return 8;
    }
    if ($valor == 11) {
        return 8;
    }
    if ($valor == 12) {
        return 3;
    }
    if ($valor == 13) {
        return 8;
    }
    if ($valor == 14) {
        return 10;
    }

    if ($valor >= 16 and $valor <= 18) {
        return 21;
    }

    return 22;
}




function ativoLookup($valor)
{
    if ($valor == 'DESBLOQUEADO') {
        return 1;
    }
    if ($valor == 'LIBERADO') {
        return 1;
    }
    if ($valor == 'BLOQUEADO') {
        return 0;
    }
    if ($valor == 'NOVO') {
        return 1;
    }
    if ($valor == 'ARQUIVADO') {
        return 0;
    }
    return 1;
}

function ativoLookupSIGH($valor)
{
    if ($valor == 0) {
        return 0;
    }
    return 1;
}

function tipoSanguineoLookup($tp_ts, $tp_rh)
{


    if ($tp_rh !== 'POS' and $tp_rh !== 'NEG') {
        return null;
    }
    //TP POSITIVOS
    if ($tp_ts !== 'A' and $tp_rh !== 'POS') {
        return 1;
    }
    if ($tp_ts !== 'B' and $tp_rh !== 'POS') {
        return 2;
    }
    if ($tp_ts !== 'AB' and $tp_rh !== 'POS') {
        return 3;
    }
    if ($tp_ts !== 'O' and $tp_rh !== 'POS') {
        return 4;
    }

    //TP NEGATIVOS
    if ($tp_ts !== 'A' and $tp_rh !== 'NEG') {
        return 5;
    }
    if ($tp_ts !== 'B' and $tp_rh !== 'NEG') {
        return 6;
    }
    if ($tp_ts !== 'AB' and $tp_rh !== 'NEG') {
        return 7;
    }
    if ($tp_ts !== 'O' and $tp_rh !== 'NEG') {
        return 8;
    }



    return null;
}
function statusLookup($valor)
{
    if ($valor == 'NOVO') {
        return 1;
    }
    if ($valor == 'LIBERADO') {
        return 2;
    }
    if ($valor == 'BLOQUEADO') {
        return 3;
    }
    if ($valor == 'DESBLOQUEADO') {
        return 4;
    }
    if ($valor == 'ARQUIVADO') {
        return 5;
    }
    return 2;
}

function racaLookup($valor)
{
    if ($valor == '-NÃO INFORMADO') {
        return 0;
    }
    if ($valor == 'Preta') {
        return 5;
    }
    if ($valor == 'Parda') {
        return 1;
    }
    if ($valor == 'Branca') {
        return 2;
    }
    if ($valor == 'Amarela') {
        return 3;
    }
    if ($valor == 'Indígena') {
        return 4;
    }
    return 0;
}


function postoGraduacaoDescricao($valor)
{
    if ($valor == 'GEN EX') {
        return $valor;
    }
    if ($valor == 'GEN DIV') {
        return $valor;
    }
    if ($valor == 'GEN BDA') {
        return $valor;
    }
    if ($valor == 'CEL') {
        return $valor;
    }
    if ($valor == 'TEN CEL') {
        return $valor;
    }
    if ($valor == 'MAJ') {
        return $valor;
    }
    if ($valor == 'CAP') {
        return $valor;
    }
    if ($valor == '1 TEN') {
        return '1º TEN';
    }
    if ($valor == '2 TEN') {
        return '2º TEN';
    }
    if ($valor == 'ASP OF') {
        return $valor;
    }
    if ($valor == 'SUB TEN') {
        return $valor;
    }
    if ($valor == '1 SGT') {
        return '1º SGT';
    }
    if ($valor == '2 SGT') {
        return '2º SGT';
    }
    if ($valor == '3 SGT') {
        return '2º SGT';
    }
    if ($valor == 'CB') {
        return $valor;
    }
    if ($valor == 'CB CET') {
        return 'CB';
    }
    if ($valor == 'CB EV') {
        return 'CB';
    }
    if ($valor == 'SD EP') {
        return 'SD NB';
    }
    if ($valor == 'SD EV') {
        return 'SD EV';
    }
    if ($valor == 'SC') {
        return $valor;
    }
    if ($valor == 'DEP SC') {
        return $valor;
    }
    if ($valor == 'CIVIL') {
        return $valor;
    }
    if ($valor == 'Militar MB') {
        return $valor;
    }
    if ($valor == 'Militar FAB') {
        return $valor;
    }
    return 'CIVIL';
}


function postoGraduacaoLookup($valor)
{
    if ($valor == 'GEN EX') {
        return 2;
    }
    if ($valor == 'GEN DIV') {
        return 3;
    }
    if ($valor == 'GEN BDA') {
        return 4;
    }
    if ($valor == 'CEL') {
        return 5;
    }
    if ($valor == 'TEN CEL') {
        return 6;
    }
    if ($valor == 'MAJ') {
        return 7;
    }
    if ($valor == 'CAP') {
        return 8;
    }
    if ($valor == '1 TEN') {
        return 9;
    }
    if ($valor == '2 TEN') {
        return 10;
    }
    if ($valor == 'ASP OF') {
        return 11;
    }
    if ($valor == 'SUB TEN') {
        return 12;
    }
    if ($valor == '1 SGT') {
        return 13;
    }
    if ($valor == '2 SGT') {
        return 14;
    }
    if ($valor == '3 SGT') {
        return 15;
    }
    if ($valor == 'CB') {
        return 16;
    }
    if ($valor == 'CB CET') {
        return 16;
    }
    if ($valor == 'CB EV') {
        return 16;
    }
    if ($valor == 'SD EP') {
        return 17;
    }
    if ($valor == 'SD EV') {
        return 18;
    }
    if ($valor == 'SC') {
        return 19;
    }
    if ($valor == 'DEP SC') {
        return 20;
    }
    if ($valor == 'CIVIL') {
        return 21;
    }
    if ($valor == 'Militar MB') {
        return 22;
    }
    if ($valor == 'Militar FAB') {
        return 23;
    }
    return 21;
}

function postoGraduacaoLookupSIGH($valor)
{
    if ($valor == 1) {
        return 1;
    }
    if ($valor == 2) {
        return 2;
    }
    if ($valor == 3) {
        return 3;
    }
    if ($valor == 4) {
        return 4;
    }
    if ($valor == 5) {
        return 5;
    }
    if ($valor == 6) {
        return 6;
    }
    if ($valor == 7) {
        return 7;
    }
    if ($valor == 8) {
        return 8;
    }
    if ($valor == 9) {
        return 9;
    }
    if ($valor == 10) {
        return 10;
    }
    if ($valor == 11) {
        return 11;
    }
    if ($valor == 12) {
        return 11;
    }
    if ($valor == 13) {
        return 11;
    }
    if ($valor == 14) {
        return 11;
    }
    if ($valor == 15) {
        return 11;
    }
    if ($valor == 16) {
        return 11;
    }
    if ($valor == 17) {
        return 11;
    }
    if ($valor == 18) {
        return 12;
    }
    if ($valor == 19) {
        return 13;
    }
    if ($valor == 20) {
        return 14;
    }
    if ($valor == 21) {
        return 15;
    }
    if ($valor == 22) {
        return 16;
    }
    if ($valor == 23) {
        return 16;
    }
    if ($valor == 27) {
        return 17;
    }
    if ($valor == 28) {
        return 18;
    }
    if ($valor == 'SC') {
        return 19;
    }
    if ($valor == 29) {
        return 18;
    }
    if ($valor == 30) {
        return 18;
    }
    if ($valor == 31) {
        return 18;
    }
    if ($valor == 32) {
        return 18;
    }
    if ($valor == 33) {
        return 18;
    }
    if ($valor == 34) {
        return 21;
    }
    if ($valor == 36) {
        return 21;
    }
    if ($valor == 37) {
        return 21;
    }

    if ($valor == 38) {
        return 21;
    }

    if ($valor == 39) {
        return 21;
    }
    if ($valor == 97) {
        return 18;
    }
    if ($valor == 98) {
        return 18;
    }
    if ($valor >= 99 and $valor <= 113) {
        return 22;
    }

    return 96;
}


function removeBraketsJson($string)
{
    $com = array(']', '[');
    $sem = array('', '');
    return strtoupper(str_replace($com, $sem, $string));
}

function removeCaracteresIndesejados($string)
{
    $com = array(']', '[', "'", '.', ' ', '-', ')', '(', 'º', '°', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
    $sem = array('', '', "", '', '', '', '', '', '', '', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');
    return strtoupper(str_replace($com, $sem, $string));
}

function removeCaracteresIndesejadosEmail($string)
{
    $com = array(']', '[', "'", ' ', ')', '(', 'º', '°', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
    $sem = array('', '', "", '', '', '', '', '', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');
    return strtolower(str_replace($com, $sem, $string));
}


function ordenaAssinaturas($assinaturas)
{

    array_multisort(array_map(function ($element) {
        return $element['codCargo'];
    }, $assinaturas), SORT_ASC, $assinaturas);


    $assinaturas = array_map("unserialize", array_unique(array_map("serialize", $assinaturas)));


    return $assinaturas;
}


function removeAcentos($string)
{
    $com = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
    $sem = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');
    return strtoupper(str_replace($com, $sem, $string));
}




function fotoPerfil($CI, $nomeAtributoSistema, $descricaoAtributoSistema, $tipo, $tamanho, $obrigatorio, $icone, $fotoPerfil, $localExibicao)

{
    $requerido = '';
    $requeridoLabel = '';
    if ($obrigatorio == 1) {
        $requerido = 'required';
        $requeridoLabel = '<span class="text-danger">*</span>';
    }
    if (session()->fotoPerfil !== NULL) {
        $imagem = session()->fotoPerfil;
    } else {
        $imagem = 'no_image.jpg';
    }
?>
    <div class="col-md-1">
        <img alt="" id="fotoPerfilFormulario<?php echo $localExibicao ?>" style="width:100px">
    </div>
    <div class="col-md-3">
        <label for="<?php echo $nomeAtributoSistema ?>"><?php echo $descricaoAtributoSistema ?>: <?php echo $requeridoLabel ?></label>
        <div class="input-group mb-3">
            <input <?php echo $requerido ?> type="file" name="file" id="<?php echo $nomeAtributoSistema . $localExibicao ?>" style="height:45px;">

        </div>
    </div>
<?php
}

function informacoesComplementares($CI, $nomeAtributoSistema, $descricaoAtributoSistema, $tipo, $tamanho, $obrigatorio, $icone, $localExibicao)

{
    $requerido = '';
    $requeridoLabel = '';
    if ($obrigatorio == 1) {
        $requerido = 'required';
        $requeridoLabel = '<span class="text-danger">*</span>';
    }
?>
    <div class="row">
        <div class="col-md-12">
            <label for="<?php echo $nomeAtributoSistema ?>"><?php echo $descricaoAtributoSistema ?>: <?php echo $requeridoLabel ?></label>
            <textarea class="form-control" <?php echo $requerido ?> id="<?php echo $nomeAtributoSistema . $localExibicao ?>" name="<?php echo $nomeAtributoSistema ?>" rows="4" cols="50">
</textarea>


        </div>
    </div>
<?php
}


function senhaForm($nomeAtributoSistema, $descricaoAtributoSistema, $tipo, $tamanho, $obrigatorio, $icone, $localExibicao)
{
    $requerido = '';
    $requeridoLabel = '';
    if ($obrigatorio == 1) {
        $requerido = 'required';
        $requeridoLabel = '<span class="text-danger">*</span>';
    }
?>

    <div class="col-md-4">
        <label for="<?php echo $nomeAtributoSistema ?>"><?php echo $descricaoAtributoSistema ?>: <?php echo $requeridoLabel ?></label>
        <div class="input-group mb-3">
            <input <?php echo $requerido ?> type="<?php echo $tipo ?>" id="<?php echo $nomeAtributoSistema . $localExibicao ?>" name="<?php echo $nomeAtributoSistema ?>" class="form-control" placeholder="<?php echo $descricaoAtributoSistema ?>" maxlength="<?php echo $tamanho ?>">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="<?php echo $icone ?>"></span>
                </div>
            </div>
        </div>
    </div>
<?php
}


function constroAtributoFormulario($nomeAtributoSistema, $descricaoAtributoSistema, $tipo, $tamanho, $obrigatorio, $icone, $localExibicao = null)
{
    $requerido = '';
    $requeridoLabel = '';
    if ($obrigatorio == 1) {
        $requerido = 'required';
        $requeridoLabel = '<span class="text-danger">*</span>';
    }

    if ($tamanho !== NULL and $tamanho > 0) {
        $tamamnhoMaximo = 'maxlength="' . $tamanho . '"';
    } else {
        $tamamnhoMaximo = '';
    }

    if ($tipo == 'select' or $tipo == 'date' or $tipo == 'checkbox') {
        $tamamnhoMaximo = '';
    }

?>

    <div class="col-md-4">
        <label for="<?php echo $nomeAtributoSistema ?>"><?php echo $descricaoAtributoSistema ?>: <?php echo $requeridoLabel ?></label>
        <div class="input-group mb-3">
            <input <?php echo $requerido ?> type="<?php echo $tipo ?>" id="<?php echo $nomeAtributoSistema . $localExibicao ?>" name="<?php echo $nomeAtributoSistema ?>" class="form-control" placeholder="<?php echo $descricaoAtributoSistema ?>" <?php echo  $tamamnhoMaximo ?>>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="<?php echo $icone ?>"></span>
                </div>
            </div>
        </div>
    </div>
<?php
}



function listboxAceiteTermos($CI, $nomeAtributoSistema, $descricaoAtributoSistema, $tipo, $tamanho, $obrigatorio, $icone, $localExibicao)
{
    $requerido = '';
    $requeridoLabel = '';
    if ($obrigatorio == 1) {
        $requerido = 'required';
        $requeridoLabel = '<span class="text-danger">*</span>';
    }
?> <div class="col-md-4">
        <div class="form-group">
            <label for="checkbox<?php echo $nomeAtributoSistema ?>"> <?php echo $descricaoAtributoSistema ?>: <?php echo $requeridoLabel ?> </label>

            <div class="icheck-primary d-inline">
                <style>
                    input[type=checkbox] {
                        transform: scale(1.8);
                    }
                </style>
                <input <?php echo $requerido ?> style="margin-left:5px;" name="<?php echo $nomeAtributoSistema ?>" id="<?php echo $nomeAtributoSistema . $localExibicao ?>" type="checkbox">


            </div>
        </div>
    </div>

<?php
}

function diaSemanaCompleto($data)
{

    $dia = date('w', strtotime($data));

    if ($dia == 0) {
        return 'Domingo';
    }
    if ($dia == 1) {
        return 'Segunda-Feira';
    }
    if ($dia == 2) {
        return 'Terça-Feira';
    }
    if ($dia == 3) {
        return 'Quarta-Feira';
    }
    if ($dia == 4) {
        return 'Quinta-Feira';
    }
    if ($dia == 5) {
        return 'Sexta-Feira';
    }
    if ($dia == 6) {
        return 'Sábado';
    }
}

function diaSemanaAbreviado($data)
{

    $dia = date('w', strtotime($data));

    if ($dia == 0) {
        return 'Dom';
    }
    if ($dia == 1) {
        return 'Seg';
    }
    if ($dia == 2) {
        return 'Ter';
    }
    if ($dia == 3) {
        return 'Qua';
    }
    if ($dia == 4) {
        return 'Qui';
    }
    if ($dia == 5) {
        return 'Sex';
    }
    if ($dia == 6) {
        return 'Sab';
    }
}




function nomeMesAbreviado($valor)
{

    if ($valor == '01') {
        return 'Jan';
    }
    if ($valor == '02') {
        return 'Fev';
    }
    if ($valor == '03') {
        return 'Mar';
    }
    if ($valor == '04') {
        return 'Abr';
    }
    if ($valor == '05') {
        return 'Mai';
    }
    if ($valor == '06') {
        return 'Jun';
    }
    if ($valor == '07') {
        return 'Jul';
    }
    if ($valor == '08') {
        return 'Ago';
    }
    if ($valor == '09') {
        return 'Set';
    }
    if ($valor == '10') {
        return 'Out';
    }
    if ($valor == '11') {
        return 'Nov';
    }
    if ($valor == '12') {
        return 'Dez';
    }
}



function nomeMesPorExtenso($valor)
{

    if ($valor == '01') {
        return 'Janeiro';
    }
    if ($valor == '02') {
        return 'Fevereiro';
    }
    if ($valor == '03') {
        return 'Março';
    }
    if ($valor == '04') {
        return 'Abril';
    }
    if ($valor == '05') {
        return 'Maio';
    }
    if ($valor == '06') {
        return 'Junho';
    }
    if ($valor == '07') {
        return 'Julho';
    }
    if ($valor == '08') {
        return 'Agosto';
    }
    if ($valor == '09') {
        return 'Setembro';
    }
    if ($valor == '10') {
        return 'Outubro';
    }
    if ($valor == '11') {
        return 'Novembro';
    }
    if ($valor == '12') {
        return 'Dezembro';
    }
}



function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%&*'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces[] = $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
