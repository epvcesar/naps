<?php
// Desenvolvido por CDS Saúde Sistemas

namespace App\Models;
use CodeIgniter\Model;

class AtalhosModel extends Model {
    
	protected $table = 'atalhos';
	protected $primaryKey = 'codAtalho';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['codModulo', 'codPerfil','codOrganizacao'];
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
        $query = $this->db->query('select * 
		from atalhos a 
		join modulos m on m.codModulo=a.codModulo');
        return $query->getResult();
    }

	public function pegaTudoPorPerfil($codPerfil = 0)
    {
		
		$codOrganizacao = session()->codOrganizacao;
        $query = $this->db->query('
		select m.*,a.*
		from perfismodulos pm
		join modulos m on pm.listar =1 and m.codModulo=pm.codModulo
		left join atalhos a on m.codModulo=a.codModulo and pm.codPerfil = a.codPerfil 
		where a.codPerfil = "'.$codPerfil.'" and m.pai is not null and m.pai<>0 order by m.ordem asc'
		);


		

		if($query == NULL){
			return false;

		}else{
			return $query->getResult();

		}
			
    }

	public function pegaPorCodigo($codAtalho)
    {
        $query = $this->db->query('select * from ' . $this->table. ' where codAtalho = "'.$codAtalho.'"');
        return $query->getRow();
    }



}