<?php
// Licença GNU GPL

namespace App\Models;
use CodeIgniter\Model;

class ModulosNotificacaoModel extends Model {
    
	protected $table = 'modulosnotificacao';
	protected $primaryKey = 'codModuloNotificacao';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['codOrganizacao','codModulo','codTipoNotificacao', 'codModeloNotificacao', 'destinoNotificacao', 'observacoes'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	

	public function pegaTudo()
    {
		
		$codOrganizacao = session()->codOrganizacao;
        $query = $this->db->query('select * from modulosnotificacao');
        return $query->getResult();
    }
	public function pegaTiposNotificacoes()
    {
		
        $query = $this->db->query('select * from tiposnotificacoes');
        return $query->getResult();
    }

	public function pegaPorCodigo($codModuloNotificacao)
    {
        $query = $this->db->query('select * from ' . $this->table. ' where codModuloNotificacao = "'.$codModuloNotificacao.'"');
        return $query->getRow();
    }

	public function pegaPorCodigoModulo($codModulo)
    {
		$codOrganizacao = session()->codOrganizacao;
        $query = $this->db->query('select mn.*,tn.descricaoTipoNotificacao,mon.nomeModeloNotificacao,pn.nomeProtocoloNotificacao 
		from modulosnotificacao mn join tiposnotificacoes tn on tn.codTipoNotificacao=mn.codTipoNotificacao
		join modelosnotificacao mon on mon.codModeloNotificacao = mn.codModeloNotificacao 
		join protocolosnotificacao pn on pn.codProtocoloNotificacao = mon.codProtocoloNotificacao
		where mn.codOrganizacao = '.$codOrganizacao.' and mn.codModulo = '.$codModulo);
        return $query->getResult();
    }



}