<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Login
<?= $this->endSection();?>


<?= $this->section('page_content'); ?>


<div class="uk-card uk-card-default uk-grid-collapse uk-child-width-1-2@s uk-margin uk-margin-remove full-height" uk-grid>
    <div class="uk-card-media-left uk-cover-container">
        <img src="<?php echo base_url('public/images/abstract-2468874_1280.jpg');?>" uk-cover> 
    </div>
    <div class="pos_relative uk-padding-remove">
        <div class="uk-card-body uk-position-center uk-padding-remove">
            <?php
            echo '<div class="uk-text-center uk-padding-remove">';
                echo '<h1 class="uk-text-uppercase uk-text-bolder">Login</h1>';
            echo '</div>';
            if (! empty($errores)) : ?>
                <div class="uk-padding-large uk-padding-remove-top uk-padding-remove-bottom uk-cover-container">
                        <ul class="uk-list uk-list-striped">
                        <?php foreach ($errores as $field => $error) : ?>
                            <li class="uk-text-danger uk-text-center"><?=$error ?></li>
                        <?php endforeach ?>
                        </ul>
                </div>
            <?php endif;  ?>
            
            <?php
            echo form_open('login', array('class' => 'uk-form-stacked uk-padding-remove '));

                // Captura de datos para devolverlos cuando encuentre errores
                $username               = isset($username) ? $username : '';
                $password               = isset($password) ? $password : '';

                // Clases
                $classUsernameL         = isset($errores['username']) ? 'uk-form-label uk-text-danger uk-text-uppercase uk-text-center' : 'uk-form-label uk-text-uppercase uk-text-center';
                $classUsername          = isset($errores['username']) ? 'uk-input uk-form-danger uk-width-1-1 uk-form-large uk-form-width-large' : 'uk-input uk-width-1-1 uk-form-large uk-form-width-large';

                $classPassword          = isset($errores['password']) ? 'uk-input uk-form-danger uk-form-large uk-form-width-large' : 'uk-input uk-form-large uk-form-width-large';
                $classPasswordL         = isset($errores['password']) ? 'uk-form-label uk-text-danger uk-text-uppercase uk-text-center' : 'uk-form-label uk-text-uppercase uk-text-center';

                // Formulario
                echo '<div class="">';
                echo form_label('Nombre de usuario', 'username', array('class' => $classUsernameL));
                echo form_input(array('name' => 'username', 'id' => 'username', 'class' => $classUsername, 'value' => $username));
                echo isset($errores['username']) ? '<span class="uk-text-danger">'.$errores['username'].'</span>' : '';
                echo '</div>';

                echo '<div class="uk-margin">';
                echo form_label('Contraseña', 'password', array('class' => $classPasswordL));
                echo form_password(array('name' => 'password', 'id' => 'password', 'class' => $classPassword, 'value' => $password));
                echo isset($errores['password']) ? '<span class="uk-text-danger">'.$errores['password'].'</span>' : '';
                echo '</div>';

                echo '<div class="uk-margin">';
                echo form_submit('submit', 'Ingresar', array('class' => 'uk-button uk-button-primary uk-width-1-1 '));
                echo '</div>';
            echo form_close();
            ?>
        </div>
    </div>
</div>
<?= $this->endSection();?>
