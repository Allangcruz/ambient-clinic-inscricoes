<?= $this->extend('pico/dashboard/template') ?>

<?= $this->section('content') ?>
<h1>Inscrições</h1>
<div class="overflow-auto">
    <table id="table-inscricao" class="striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Pago?</th>
                <th>Ação</th>
            </tr>
        </thead>
    </table>
</div>              
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <?= vite_assets('src/main.js') ?>
    <script>
        console.log("inscricao");
    </script>
<?= $this->endSection() ?>