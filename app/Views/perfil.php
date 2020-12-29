<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
perfil
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
<h1>Perfil</h1> 
<?php
// if(!empty($this->session)) :
//     //echo $this->session->userdata('nombre');
//     echo $userData['id_usuario'];
// else :
//     echo 'sin sesión';
// endif; 

// echo $this->session->get('id_usuario');
?>

<?= $this->endSection();?>