
<div id="encabezado">
    <h1> FeiSystems </h1>
</div>
<div id="cuerpo">
    <section>
        <?php
        $username = array('name' => 'username', 'placeholder' => 'nombre de usuario');
        $password = array('name' => 'password', 'placeholder' => 'introduce tu password');
        $submit = array('name' => 'submit', 'value' => 'Iniciar sesión', 'title' => 'Iniciar sesión');
        ?>
        <?= form_open('autentica') ?>
        <label for="username">Nombre de usuario:</label>
        <?= form_input($username) ?> <p class="error"><?= strip_tags(form_error('username')) ?> </p>
        <label for="password">Introduce tu password:</label>
        <?= form_password($password) ?><p class="error"><?= strip_tags(form_error('password')) ?></p>
        <?= form_hidden('token', $token) ?>
        <?php if ($this->session->flashdata('usuario_incorrecto')) { ?>
        <p class="error"><?= $this->session->flashdata('usuario_incorrecto') ?></p>
        <?php } ?>
        <?= form_submit($submit) ?>
        <?= form_close() ?>
    </section> 
    
    <h2><?= anchor('registro', 'Registrarse') ?> </h2>
</div>
<div id="pie">

