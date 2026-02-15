<?= $this->extend('pico/dashboard/template') ?>

<?= $this->section('content') ?>
<h1>Inscrições</h1>
<div class="overflow-auto">
    <table id="table-inscricao">
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
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

  <?= vite_assets('src/app.js') ?>
<script>
  console.log("inscricao");
</script>
<?= $this->endSection() ?>