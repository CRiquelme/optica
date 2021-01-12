<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Convenios
<?= $this->endSection();?>

<!-- Contenido de la página -->
<?= $this->section('page_content'); ?>

<section id="convenios">
  <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
    <h1 class="text-4xl">Convenios</h1>
  </article>
	<table class="uk-table uk-table-divider uk-table-striped uk-table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Empresa</th>
                        <th>Estado</th>
                        <th class="uk-text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-for="(c, n) in info" 
                        :key="n">
                        <td>
                            <button class="uk-button uk-button-link uk-text-success uk-text-bolder" >
                                <i class="far fa-edit uk-margin-small-left uk-text-success"></i> 1
                            </button>
                        </td>
                        <td> {{c.nombre}} </td>
                        <td>{{c.estado}}</td>
                        
                        <td class="uk-text-center">
                            <i class="fas fa-trash-alt cursor-pointer text-red-500" ></i>

                            <i class="fas fa-sign-out-alt ml-5 cursor-pointer text-green-800" ></i>

                            <i class="fas fa-reply-all ml-5 cursor-pointer text-orange-800" title="Deshacer última salida" ></i>
                        </td>
                    </tr>
                </tbody>
            </table>

</section> <!-- #convenios -->


<script>
  // Acá se escribe lo de vue (borrar este comentario)
  var app = new Vue({
    el : '#convenios',
    data () {
      return {
				info:[]
			 }
    },
		created(){
			this.info=[{id:1,nombre:"empresa1Nombre",estado:"Activo"}]
			axios
				.get('<?=base_url('rest-convenios')?>')
				.then(r=>console.log(r))
		}
  })
</script>

<?= $this->endSection();?>