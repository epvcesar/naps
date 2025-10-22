<?php
// Desenvolvido por CDS Saúde Sistemas

namespace App\Models;
use CodeIgniter\Model;

class PerfisModulosModel extends Model {
    
	protected $table = 'perfismodulos';
	protected $primaryKey = 'codPerfil,codModulo';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['codOrganizacao','codPerfil','codModulo','listar', 'adicionar', 'editar', 'deletar','dataAtualizacao'];
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
        $query = $this->db->query('select * from perfismodulos pm
		right  join perfis p on p.codPerfil=p.codPerfil
		right  join modulos m on m.codModulo=pm.codModulo');
        return $query->getResult();
    }


	public function pegaModulosVisiveis($codPerfil = NULL)
    {
		
        $query = $this->db->query('
		select "'.$codPerfil.'" as codPerfil, m.codModulo, m.nome, a.codAtalho
		from perfismodulos pm
		join modulos m on pm.listar =1 and m.codModulo=pm.codModulo
		left join atalhos a on m.codModulo=a.codModulo and pm.codPerfil = a.codPerfil 
		where pm.codPerfil = "'.$codPerfil.'" and m.pai is not null and m.pai<>0
		order by m.nome asc,m.nome asc');
        return $query->getResult();
    }
	
	public function pegaTudoPerfil($codPerfil = NULL)
    {
		
        $query = $this->db->query('
		select "'.$codPerfil.'" as codPerfil, m.codModulo, m.nome,mm.nome as pai, pm.listar,pm.adicionar,pm.editar,pm.deletar 
		from perfismodulos pm
		right  join modulos m on m.codModulo=pm.codModulo and pm.codPerfil = "'.$codPerfil.'"
       	left join modulos mm on mm.codModulo =  m.pai
		order by m.nome asc,mm.nome asc');
        return $query->getResult();
    }
	
	public function pegaTudoPerfilSame($codPerfil = NULL)
    {
		
		$codOrganizacao = session()->codOrganizacao;
        $query = $this->db->query('
		select "'.$codPerfil.'" as codPerfil, m.codModulo, m.nome,mm.nome as pai, pm.listar,pm.adicionar,pm.editar,pm.deletar 
		from perfismodulos pm
		right  join modulos m on m.codModulo=pm.codModulo and pm.codPerfil = "'.$codPerfil.'" and pm.codOrganizacao='.$codOrganizacao.' and  m.nome like "%same%"
       	left join modulos mm on mm.codModulo =  m.pai
		order by m.nome asc,mm.nome asc');
        return $query->getResult();
    }

	public function verificaSeExiste($codPerfil,$codModulo)
    {
		
        $query = $this->db->query('select * 
		from perfismodulos where codPerfil = "'.$codPerfil.'" and codModulo = '.$codModulo
		);
        return $query->getRow();
    }


	public function atualiza_listar($codPerfil,$codModulo)
    {
		
        $this->db->query('update perfismodulos set listar =1 where codPerfil = "'.$codPerfil.'" and codModulo = '.$codModulo
		);
        return true;
    }

	public function atualiza_adicionar($codPerfil,$codModulo)
    {
		
        $this->db->query('update perfismodulos set adicionar =1 where codPerfil = "'.$codPerfil.'" and codModulo = '.$codModulo
		);
        return true;
    }
	public function atualiza_editar($codPerfil,$codModulo)
    {
		
        $this->db->query('update perfismodulos set editar =1 where codPerfil = "'.$codPerfil.'" and codModulo = '.$codModulo
		);
        return true;
    }
	public function atualiza_deletar($codPerfil,$codModulo)
    {
		
        $this->db->query('update perfismodulos set deletar =1 where codPerfil = "'.$codPerfil.'" and codModulo = '.$codModulo
		);
        return true;
    }

	public function pegaPorCodigo($codPerfil = NULL)
    {
        $query = $this->db->query('select * from perfismodulos where codPerfil = "'.$codPerfil.'"');
        return $query->getRow();
    }

	public function deletePerfilModulo($codPerfil = NULL)
    {
        $query = $this->db->query('delete from perfismodulos where codPerfil = "'.$codPerfil.'"');
        return true;
    }



	public function deleteMembroPerfil($codPerfil = NULL)
    {
        $query = $this->db->query('delete from perfiscolaboradoresmembro where codPerfil = "'.$codPerfil.'"');
        return true;
    }

}