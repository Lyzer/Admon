


<div id="encabezado">
    <h1>Registro -  FeiSystems</h1>
</div>
<div id="cuerpo">
    <section>
        <?php
        $user = array('name' => 'username', 'placeholder' => 'Nombre de Usuario');
        $nameuser = array('name' => 'nameuser', 'placeholder' => 'Nombre');
        $password = array('name' => 'password', 'placeholder' => 'Contraseña');
        $submit = array('name' => 'submit', 'value' => 'Registrarse', 'title' => 'Registrarse');
        ?>
        <?= form_open('agregaUser') ?>
        <label for="username">Nombre Usuario</label>
        <?= form_input($user) ?> <p class="error"> <?= strip_tags(form_error('username')) ?></p>
        <label for="nameuser">Nombre</label>
        <?= form_input($nameuser) ?> <p class="error"> <?= strip_tags(form_error('nameuser')) ?> </p>
        <label for="password">Contraseña</label>
        <?= form_password($password) ?> <p class="error"> <?= strip_tags(form_error('password')) ?></p>
        <?php if ($this->session->flashdata('usuario_existe')) { ?>
        <p class="error"><?= $this->session->flashdata('usuario_existe') ?></p>
        <?php } ?>
        <?= form_submit($submit) ?>
        <?= form_close() ?>
    </section>
    <h2><?= anchor('', '<- Atras') ?> </h2>
</div>
<div id="pie">







