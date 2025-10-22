<?php
// Licença GNU GPL

namespace App\Models;

use CodeIgniter\Model;

class ModulosModel extends Model
{

	protected $table = 'modulos';
	protected $primaryKey = 'codModulo';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['nome', 'link', 'pai', 'ordem', 'destaque', 'icone', 'dataCriacao', 'DataAtualizacao'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;




	public function pegaTudo()
	{
		$query = $this->db->query('select m.*, mm.nome as descricaoPai
		from modulos m 
		left join modulos mm on m.pai=mm.codModulo');
        return $query->getResult();
	}



	public function pegaModulosRaiz()
	{
		$query = $this->db->query('select * from ' . $this->table . ' where pai = 0 order by ordem asc');
		return $query->getResult();
	}



	public function listaDropDownModulosRaiz()
	{
		$query = $this->db->query('select codModulo as id, nome as text from ' . $this->table . ' where pai = 0 and nome is not null order by nome asc');
		return $query->getResult();
	}


	public function listaDropDownModulosFilho()
	{
		$query = $this->db->query('select codModulo as id, nome as text from ' . $this->table . ' where pai != 0 and nome is not null order by nome asc');
		return $query->getResult();
	}

	


	public function pegaModulosFilho()
	{
		$query = $this->db->query('select * from ' . $this->table . ' where pai != 0 order by  ordem asc,codModulo asc');
		return $query->getResult();
	}


	public function pegaModulosRaizPermitidos($codColaborador = NULL, $codPerfil = NULL)
	{
		$query = $this->db->query('
		select p.codPerfil, m.*,pm.listar,pm.adicionar,pm.editar,pm.deletar
		from perfiscolaboradoresmembro pcm 
		left join perfis p on pcm.codPerfil = p.codPerfil 
		left join perfismodulos pm on pm.codPerfil = p.codPerfil 
		left join modulos m on m.codModulo = pm.codModulo 
		where pm.listar= 1 and pcm.codColaborador ="'.$codColaborador.'" and p.codPerfil = "'.$codPerfil.'" and m.pai = 0
		order by m.ordem asc');
		return $query->getResult();
	}

	
	public function pegaModulosFilhoPermitidos($codColaborador = NULL, $codPerfil = NULL)
	{
		$query = $this->db->query('
		select p.codPerfil, m.*,pm.listar,pm.adicionar,pm.editar,pm.deletar
		from perfiscolaboradoresmembro pcm 
		left join perfis p on pcm.codPerfil = p.codPerfil 
		left join perfismodulos pm on pm.codPerfil = p.codPerfil 
		left join modulos m on m.codModulo = pm.codModulo 
		where pm.listar= 1 and pcm.codColaborador ="'.$codColaborador.'" and p.codPerfil = "'.$codPerfil.'" and m.pai != 0
		order by m.ordem asc,m.codModulo asc');
		return $query->getResult();
	}

}
