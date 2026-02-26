<?= $this->extend('bootstrap-5/dashboard/template') ?>

<?= $this->section('content') ?>
<main class="app-main">
    <div class="app-content">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-12">
                    <h3>Total Inscrições:
                        <span id="total_inscritos"></span>
                    </h3>
                </div>

                <div class="col-md-12">
                    <hr>
                    <strong>Total estudantes:
                        <span id="total_estudantes"></span>
                    </strong>
                </div>

                <div class="col-md-12">
                    <strong class="text-success">Total estudantes pagos:
                        <span id="total_estudantes_pagos"></span>
                    </strong>
                </div>

                <div class="col-md-12">
                    <strong class="text-danger">Total estudantes pendente pagamento:
                        <span id="total_estudantes_pendente_pagamento"></span>
                    </strong>
                </div>

                <div class="col-md-12">
                    <hr>
                    <strong>Total veterinários:
                        <span id="total_veterinarios"></span>
                    </strong>
                </div>

                <div class="col-md-12">
                    <strong class="text-success">Total veterinários pagos:
                        <span id="total_veterinarios_pagos"></span>
                    </strong>
                </div>

                <div class="col-md-12">
                    <strong class="text-danger">Total veterinários pendente pagamento:
                        <span id="total_veterinarios_pendente_pagamento"></span>
                    </strong>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <div class="card card-primary card-outline">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                Inscrições
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary mr-4" onclick="Inscricao.exportarExcel()">
                                    Exportar todos os dados
                                </button>
                                <button type="button" class="btn btn-secondary" onclick="Inscricao.search()">
                                    Atualizar listagem
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table thead-light table-striped table-bordered table-hover" id="table-inscricao">
                                    <thead>
                                        <tr class="bg-success">
                                            <th>#</th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Telefone</th>
                                            <th>CPF</th>
                                            <th>Pago?</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal" id="modal-inscricao" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detalhes da inscrição</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <b>Pago</b>: <span id="pago"></span>
            </div>

            <div class="col-12">
                <b>Nome</b>: <span id="nome"></span>
            </div>

            <div class="col-12">
                <b>CPF</b>: <span id="cpf"></span>
            </div>

            <div class="col-12">
                <b>Email</b>: <span id="email"></span>
            </div>

            <div class="col-12">
                <b>Telefone</b>: <span id="telefone"></span>
            </div>

            <div class="col-12">
                <b>Perfil</b>: <span id="perfil"></span>
            </div>

            <div class="col-12">
                <b>CRMV</b>: <span id="crmv"></span>
            </div>

            <div class="col-12">
                <b>Instituição</b>: <span id="instituicao"></span>
            </div>

            <div class="col-12">
                <b>Matricula</b>: <span id="matricula"></span>
            </div>

            <div class="col-12">
                <b>Data criação</b>: <span id="created_at"></span>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <?= vite_assets('src/main.js') ?>
<?= $this->endSection() ?>