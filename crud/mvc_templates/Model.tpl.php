<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class @@@uModelName@@@ extends Model {
    
	protected $table = '@@@table@@@';
	protected $primaryKey = '@@@primaryKey@@@';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = [@@@allowedFields@@@];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'dataAtualizacao';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	

	
	public function pegaTudo()
	{
		$query = $this->db->query('select * from @@@table@@@');
        return $query->getResult();
	}

		
	public function pegaPorCodigo($@@@primaryKey@@@ = NULL)
	{
		$query = $this->db->query('select * from @@@table@@@ where @@@primaryKey@@@="'.$@@@primaryKey@@@.'"');
        return $query->getRow();
	}


}