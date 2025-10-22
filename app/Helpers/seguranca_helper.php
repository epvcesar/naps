<?php
//Licença GNU GPL
namespace App\Controllers;

use CodeIgniter\Services;
use App\Controllers\BaseController;
use App\Models\PessoasModel;
use App\Models\GruposModel;
use App\Models\OrganizacoesModel;
use App\Models\AtributosSistemaModel;
use App\Models\MapeamentoAtributosLDAPModel;
use App\Models\PortalOrganizacaoModel;
use App\Models\LogsModel;
use Config\Encryption;



function pegaCsrf()
{
    return  csrf_hash();
}


function verificaSeguranca($CI, $session, $aplicacao_url)
{



    //SET TIMEZONE
    if ($session->timezone !== NULL) {

        $timezone = $session->timezone;
    } else {

        $timezone = 'America/Recife';
    }
    date_default_timezone_set($timezone);


    // print_r($_GET['autorizacao']);
    //EXIT();

    /*
    helper('cookie');

    if (get_cookie('autorizacao') !== NULL and session()->autorizacao !== NULL) {
        if (md5(session()->autorizacao . session()->cpf) == get_cookie('autorizacao')) {
        } else {
            //header("Location:" . base_url());
          //  exit();
        }
    }
    */


    if ($session->estaLogado == NULL) {

?>
        <script>
            window.location.href = "<?php echo $aplicacao_url . '/login/logout' ?>";
        </script>
    <?php
        exit();
    }
}




function raizPermissoes($permissao)
{
    $url = explode("/", current_url());
    $controler = $url[count($url) - 1];



    if (verificaPermissao($controler, $permissao) !== 1) {
        session()->setFlashdata('mensagem_erro', 'Você não tem acesso a este recurso');
    ?>
        <script>
            window.location.href = "javascript:history.back()";
        </script>
<?php

    }
}

function verificaPermissao($modulo, $permissao)
{


    $liberados = array('home');
    if (in_array($modulo, $liberados)) {
        return 1;
    }


    foreach (session()->meusModulos as $meuModulo) {

        if (trim(mb_strtolower($meuModulo->link, 'utf-8')) == trim(mb_strtolower($modulo, 'utf-8'))) {

            if ($permissao == 'listar') {
                return  $meuModulo->listar;
            }
            if ($permissao == 'adicionar') {
                return $meuModulo->adicionar;
            }
            if ($permissao == 'editar') {
                return $meuModulo->editar;
            }
            if ($permissao == 'deletar') {
                return $meuModulo->deletar;
            }
        }
    }
    return 0;
}


function mensagemAcessoSomenteIntranet($organizacao =  null)
{

    $cabecalho = '';
    if (session()->logo !== NULL) {
        $cabecalho = "
        <div>
        <img style='margin-left:5px;width:70px' src='" . base_url() . "/imagens/organizacoes/" . session()->logo . "'>
        
        </div>
        <div>
        " . session()->descricaoOrganizacao . "
        </div>
";
    }
    if (session()->nomeExibicao !== NULL) {

        $request = \Config\Services::request();
        $ip = $request->getIPAddress();

        $dadosAcesso = "
        
        <div style='font-weight: bold;'>DADOS DO ACESSO</div>
        <div>Autor:" . session()->nomeExibicao . "</div>
        <div>Data/Hora:" . date('d/m/Y H:i') . "</div>
        <div>IP:" . $ip . "</div>
        
        ";
    }

    $corpo =
        '<html>
    
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
            <title></title>
    
            <style>
    
                .container {
                    #background: #d534347a;
                    color: #1f2d3db8;
                    
                   
                }
    
                .texto {
                    padding-left: 0px;
                    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                    font-size: 30px;

    
    
                }
            </style>
        </head>
    
        <body>
    
            <div class="container">
                <div class="row">
                    <div style="text-align:center" >
                       
                    </div>
                     <div>
                        <div>
                        
                        <div style="text-align:center;font-weight: bold;">' . $cabecalho . '</div>

                        <table>
                        <tr>
                        <td>
                        <span style="text-align:center;font-weight: bold;"><img style="margin-left:5px;width:70px" src="' . base_url('imagens/atencao.gif') . '"></span>
                        </td>
                        <td>
                          <div style="color:red" >Acesso a este recurso apenas pela Intranet!</div>
                        </td>
                        <tr>
                        </table>
                      
                        <div>
                        
                    ' . $dadosAcesso . '
                        </div>
                        </div>
                         <div style="padding-top: 10px;padding-right: 10px; padding-left: 10px;padding-bottom: 10px;font-size: 10px; width: 100%;height:auto;color:#fff;background:gray;text-align:center;vertical-align:middle">
                         
                         </div>
                    </div>
                </div>
            </div>
        </body>
    
        </html>';
    return  $corpo;
}

function mensagemAcessoNegado($organizacao =  null)
{




    $request = \Config\Services::request();
    $ip = $request->getIPAddress();

    $dadosAcesso = "
    
    <div style='font-weight: bold;'><i class='fa-solid fa-circle-exclamation'></i> ACESSO NEGADO</div>
    <div>Autor:" . session()->nomeExibicao . "</div>
    <div>Data/Hora:" . date('d/m/Y H:i') . "</div>
    <div>IP:" . $ip . "</div>
    
    ";


    $data = [
        'controller'        => 'Acesso negado',
        'dadosAcesso'             =>  $dadosAcesso,
        'title'             => 'Acesso negado'

    ];
    return view('acessoNegado', $data);
}


function encriptar($chave, $tipo_cifra, $texto)
{
    
		$config         = config(Encryption::class);
		$config->key    = $chave;
		$config->driver = 'OpenSSL';
		
		$encrypter = service('encrypter', $config);

                     
    return bin2hex($encrypter->encrypt($texto));
}

function descriptar($chave, $tipo_cifra, $texto)
{
    
		$config         = config(Encryption::class);
		$config->key    = $chave;
		$config->driver = 'OpenSSL';
		
		$encrypter = service('encrypter', $config);

    return $encrypter->decrypt(hex2bin($texto));
}






function ntpasswd($Input)
{
    // Convert the password from UTF8 to UTF16 (little endian)
    $Input = iconv('UTF-8', 'UTF-16LE', $Input);

    $MD4Hash = hash('md4', $Input);

    // Make it uppercase, not necessary, but it's common to do so with NTLM hashes
    $NTLMHash = strtoupper($MD4Hash);

    // Return the result
    return ($NTLMHash);
}

function checknt($passwd, $hash)
{
    return (ntpasswd($passwd) === strtoupper($hash));
}


function pegaIP()
{
    //pega IP
    $request = \Config\Services::request();
    $ip = $request->getIPAddress();
    return $ip;
}

function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false)
{
    $lmin = 'abcdefghijklmnopqrstuvwxyz';
    $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $num = '1234567890';
    $simb = '!@#$%';
    $retorno = '';
    $caracteres = '';

    $caracteres .= $lmin;
    if ($maiusculas)
        $caracteres .= $lmai;
    if ($numeros)
        $caracteres .= $num;
    if ($simbolos)
        $caracteres .= $simb;

    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand - 1];
    }
    return $retorno;
}

function geraNumero($tamanho = 8)
{
    $caracteres = '1234567890';
    $retorno = '';

    $len = strlen($caracteres);
    for ($n = 1; $n <= $tamanho; $n++) {
        $rand = mt_rand(1, $len);
        $retorno .= $caracteres[$rand - 1];
    }
    return $retorno;
}



?>