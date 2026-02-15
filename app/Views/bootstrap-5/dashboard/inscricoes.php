<?= $this->extend('bootstrap-5/dashboard/template') ?>

<?= $this->section('content') ?>
<main class="app-main">
    <div class="app-content">
        <div class="container">
            <div class="row mt-5">
                <div class="col">
                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                Inscrições
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table thead-light table-striped table-bordered table-hover" id="table-inscricao">
                                    <thead>
                                        <tr class="bg-success">
                                            <th class="col-1">#</th>
                                            <th class="col-3">Nome</th>
                                            <th class="col-2">CPF</th>
                                            <th class="col-3">E-mail</th>
                                            <th class="col-2">Telefone</th>
                                            <th class="col-2">Pago?</th>
                                            <th class="col-1">Ação</th>
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
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <?= vite_assets('src/main.js') ?>
    <script>
        console.log("inscricao");
    </script>
<?= $this->endSection() ?>