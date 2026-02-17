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

    public function viewInscricoes(): string
    {
        return view('bootstrap-5/dashboard/inscricoes');
        // return view('pico/dashboard/inscricoes');
    }

    public function index(): ResponseInterface
    {
        try {
            return $this->inscricaoModel->getInscricaoFilter($this->request);
        } catch (\Exception $e) {
            return $this->responseInternalServerError($e->getMessage());
        }
    }

    public function delete($id): ResponseInterface
    {
        try {
            $inscricao = $this->inscricaoModel->getInscricao($id);
            if (! $inscricao) {
                return $this->responseNotFound($this->getMessageNotFound($id));
            }

            $this->inscricaoModel->delete($id);

            return $this->responseNoContent();
        } catch (\Exception $e) {
            return $this->responseInternalServerError($e->getMessage());
        }
    }

    public function show($id): ResponseInterface
    {
        try {
            $inscricao = $this->inscricaoModel->getInscricao($id);

            if (! $inscricao) {
                return $this->responseNotFound($this->getMessageNotFound($id));
            }
            
            return $this->response->setJSON(['data' => $inscricao]);
        } catch (\Exception $e) {
            return $this->responseInternalServerError($e->getMessage());
        }
    }

    private function getMessageNotFound(?int $id = null)
    {
        return "Inscrição '{$id}' não encontrado";
    }

    public function update($id): ResponseInterface
    {
        try {
            $inscricao = $this->inscricaoModel->getInscricao($id);

            if (! $inscricao) {
                return $this->responseNotFound($this->getMessageNotFound($id));
            }

            $request = $this->request->getJSON();
            $statusPagamento = $request->status ?? null;

            $this->inscricaoModel->update($id, ['pago' => $statusPagamento]);
            
            return $this->responseSuccess('Pagamento atualizado com sucesso!');
        } catch (\Exception $e) {
            return $this->responseInternalServerError($e->getMessage());
        }
    }
}
