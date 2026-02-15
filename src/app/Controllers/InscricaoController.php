<?php

namespace App\Controllers;

use App\Models\InscricaoModel;
use App\Traits\ResponseTrait;

class InscricaoController extends BaseController
{
    use ResponseTrait;
    protected InscricaoModel $inscricaoModel;

    public function index(): string
    {
        return view('dashboard/inscricoes');
    }

    public function listar(): string
    {
        try {
            return $this->inscricaoModel->getInscricaoFilter($this->request);
        } catch (\Exception $e) {
            return $this->responseInternalServerError($e->getMessage());
        }
    }

    public function status(): string
    {
        return view('auth/login');
    }
}
