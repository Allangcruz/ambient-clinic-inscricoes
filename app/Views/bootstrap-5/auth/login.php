<?= $this->extend('auth/template') ?>

<?= $this->section('content') ?>
<div class="login-box">
    <div class="card card-outline card-primary">
    <div class="card-header">
        <a href="https://ambientclinic.com.br" class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
            <h1 class="mb-0"><b>Ambient Clinic</b></h1>
        </a>
    </div>
    <div class="card-body login-card-body">
        <p class="login-box-msg">Bem vindo ao Ambient Clinic</p>
            <form action="auth/autenticar" method="post" id="form-login">
                <div class="input-group mb-1">
                    <div class="form-floating">
                        <label for="email">E-mail</label>
                        <input id="email" type="email" class="form-control" required maxlength="250" placeholder="" />
                    </div>
                </div>
                <label id="email-error" class="error" for="email"></label>

                <div class="input-group mb-2">
                    <div class="form-floating">
                        <label for="password">Senha</label>
                        <input id="password" type="password" class="form-control" required placeholder="" />
                    </div>
                </div>
                <label id="password-error" class="error" for="password"></label>

                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary" onclick="ambientClinic.autenticar()">ACESSAR</button>
                        </div>
                    </div>
                </div>
            </form>
        </p>
    </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/login.js') ?>?version=<?= esc(date('Ymdhis')) ?>"></script>
<?= $this->endSection() ?>