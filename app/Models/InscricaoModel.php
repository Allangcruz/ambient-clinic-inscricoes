<?php

namespace App\Models;

use CodeIgniter\Model;
use \Hermawan\DataTables\DataTable;

class InscricaoModel extends Model
{
    protected $table            = 'inscricoes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nome',
        'email',
        'telefone',
        'cpf',
        'perfil',
        'crmv',
        'matricula',
        'instituicao',
        'pago'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getInscricaoFilter($request)
    {
        $queryBuilder = $this->where('deleted_at IS NULL');

        return DataTable::of($queryBuilder)
            ->setSearchableColumns(['nome', 'email', 'telefone', 'cpf'])
            ->toJson(true);
    }

    public function getInscricao($id): object
    {
        return $this->first($id);
    }

    public function getTotalInscritos(): int
    {
        return $this->countAllResults();
    }

    public function getTotalPorPerfil($perfil): int
    {
        return $this->where('perfil', $perfil)->countAllResults();
    }

    public function getTotalPorPerfilPago($perfil): int
    {
        return $this->where('perfil', $perfil)
                    ->where('pago', 'Sim')
                    ->countAllResults();
    }
}
