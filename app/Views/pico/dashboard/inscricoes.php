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

<dialog open>
  <article>
    <header>
      <button aria-label="Close" rel="prev"></button>
      <p>
        <strong>🗓️ Thank You for Registering!</strong>
      </p>
    </header>
    <p>
      We're excited to have you join us for our
      upcoming event. Please arrive at the museum 
      on time to check in and get started.
    </p>
    <ul>
      <li>Date: Saturday, April 15</li>
      <li>Time: 10:00am - 12:00pm</li>
    </ul>
  </article>
</dialog>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/inscricoes.js') ?>?version=<?= esc(date('Ymdhis')) ?>"></script>
<script>
    $(function () {
        ambientclinic.inscricao.init()
    });
</script>
<?= $this->endSection() ?>