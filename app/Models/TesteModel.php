<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Models;
use CodeIgniter\Model;

class TesteModel extends Model {
    
	protected $table = 'teste';
	protected $primaryKey = 'codTeste';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['descricao', 'tipo'];
	protected $useTimestamps = false;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    
	
}