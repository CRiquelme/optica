<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Facturas emitidas
<?= $this->endSection();?>

<!-- Contenido de la página -->
<?= $this->section('page_content'); ?>

<section id="facturasEmitidas">

</section>


<script>
var app = new Vue({
    el      : '#facturasEmitidas',
    data () {
        return {

        }
    },
    created () {
        console.log('hola')
    }
});

</script>

<?= $this->endSection();?>