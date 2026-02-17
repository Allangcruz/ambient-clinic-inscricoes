<?php

namespace App\Controllers;

use App\Models\InscricaoModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Traits\ResponseTrait;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

    private function getMessageNotFound($id)
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

    public function exportar()
    {
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        // Cabeçalhos
        $activeWorksheet->setCellValue('A1', 'ID');
        $activeWorksheet->setCellValue('B1', 'nome');
        $activeWorksheet->setCellValue('C1', 'EMAIL');
        $activeWorksheet->setCellValue('D1', 'CPF');
        $activeWorksheet->setCellValue('E1', 'TELEFONE');
        $activeWorksheet->setCellValue('F1', 'PERFIL');
        $activeWorksheet->setCellValue('G1', 'CRMV');
        $activeWorksheet->setCellValue('H1', 'INSTITUICAO');
        $activeWorksheet->setCellValue('I1', 'MATRICULA');
        $activeWorksheet->setCellValue('J1', 'PAGO');
        $activeWorksheet->setCellValue('K1', 'DATA_CRIACAO');


        // Dados (Exemplo vindo do Model)
        $inscricoes = $this->inscricaoModel->findAll();
        $linha = 2;
        foreach ($inscricoes as $inscricao) {
            $activeWorksheet->setCellValue('A' . $linha, $inscricao->id);
            $activeWorksheet->setCellValue('B' . $linha, $inscricao->nome);
            $activeWorksheet->setCellValue('C' . $linha, $inscricao->email);
            $activeWorksheet->setCellValue('D' . $linha, $inscricao->cpf);
            $activeWorksheet->setCellValue('E' . $linha, $inscricao->telefone);
            $activeWorksheet->setCellValue('F' . $linha, $inscricao->perfil);
            $activeWorksheet->setCellValue('G' . $linha, $inscricao->crmv);
            $activeWorksheet->setCellValue('H' . $linha, $inscricao->instituicao);
            $activeWorksheet->setCellValue('I' . $linha, $inscricao->matricula);
            $activeWorksheet->setCellValue('J' . $linha, $inscricao->pago);
            $activeWorksheet->setCellValue('K' . $linha, $inscricao->created_at);
            $linha++;
        }

        $writer = new Xlsx($spreadsheet);

        // Configura o nome do arquivo
        $filename = 'inscricoes_' . time() . '.xlsx';
        $savePath = WRITEPATH . 'uploads/' . $filename;
        $writer->save($savePath);

        // Retorna o link para o AJAX
        return $this->response->setJSON([
            'status' => 'success',
            'url' => base_url("inscricoes/download/" . $filename)
        ]);
    }

    public function download($fileName)
    {
        $path = WRITEPATH . 'uploads/' . $fileName;

        if (file_exists($path)) {
            // O response->download força o navegador a baixar o arquivo
            return $this->response->download($path, null)->setFileName($fileName);
        } else {
            return redirect()->to('/')->with('error', 'Arquivo não encontrado.');
        }
    }
}
