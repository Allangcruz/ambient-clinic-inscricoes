<?= $this->extend('bootstrap-5/dashboard/template') ?>

<?= $this->section('content') ?>
<main class="app-main">
    <div class="app-content">
        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <div class="card card-primary card-outline">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                Inscrições
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary" onclick="Inscricao.exportarExcel()">
                                    Exportar todos os dados
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
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <?= vite_assets('src/main.js') ?>
<?= $this->endSection() ?>