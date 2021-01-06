<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Convenios
<?= $this->endSection();?>

<!-- Contenido de la página -->
<?= $this->section('page_content'); ?>

<section id="convenios">

    <!-- Esta es la sección donde ingresas el html (borrar este comentario) -->
    <!-- Puedes tomar como ejemplo cristalesView.php (borrar este comentario) -->
    <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
        <h1 class="text-4xl">Convenios</h1>
    </article>

</section> <!-- #convenios -->


<script>
    // Acá se escribe lo de vue (borrar este comentario)
    var app = new Vue({
        el : '#convenios',
        data () {
            return { }
        },
    })
</script>

<?= $this->endSection();?>