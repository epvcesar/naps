<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class RespostasModel extends Model {
    
	protected $table = 'satisfacao';
	protected $primaryKey = 'codPesquisa';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['codOrganizacao', 'codMeio', 'data', 'email', 'servico', 'atendimento', 'qualidade', 'tempo', 'instalacoes', 'qualidadePresencial', 'sugestao'];
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
        $query = $this->db->query('select a.*, m.descricaoMeio, o.siglaOrganizacao
		from satisfacao a
		left join meios m on m.codmeio=a.codMeio
		left join organizacoes o on o.codOrganizacao=a.codOrganizacao
		order by a.codPesquisa desc');
        return $query->getResult();
    }



}