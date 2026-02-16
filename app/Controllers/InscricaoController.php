<?php

namespace App\Controllers;

use App\Models\InscricaoModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ResponseTrait;

class InscricaoController extends BaseController
{
    use ResponseTrait;
    protected InscricaoModel $inscricaoModel;

    public function __construct()
    {
        $this->inscricaoModel = new InscricaoModel();
    }

    public function index(): string
    {
        return view('bootstrap-5/dashboard/inscricoes');
        // return view('pico/dashboard/inscricoes');
    }

    public function listar(): ResponseInterface
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
