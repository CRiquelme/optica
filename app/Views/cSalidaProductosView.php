<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Consulta de salidas entre fechas
<?= $this->endSection();?>
<section id="consultaSalidas">
    hola
</section>
<?= $this->section('page_content'); ?>


<script>
Vue.component('titulo', {
    template: '<h1 class="uk-text-uppercase">{{titulo}}</h1>',
    data: function() {
        return { titulo: 'Cristales' }
    }
});
var app = new Vue({
    el      : '#consultaSalidas',
    data () {
        return {
        }
    }
})

</script>
<?= $this->endSection();?>