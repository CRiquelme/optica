<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Lista de productos
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
<div id="lista_productos" class="m-10">
  <div class="pb-5 mb-4" uk-grid>
    <h1 class="text-4xl uppercase">Lista de productos (en construcción)</h1>
  </div>

  <div class="grid md:grid-cols-5 gap-4">
    <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
      <?= $this->include('components/sidebar') ?>
    </div>

    <div class="md:row-span-1 md:col-span-4 ">
      <table class="uk-table uk-table-hover uk-table-striped" id="tabla_productos">
        <thead>
          <tr>
            <th>created_at</th>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Proveedor(es)</th>
            <th>Marca</th>
            <!-- <th>Opciones</th> -->
          </tr>
        </thead>
        <tbody>
          <tr v-for="producto in productos">
            <td>{{ producto.created_at }}</td>
            <td>{{ producto.modelo }}</td>
            <td>{{ producto.categoria }}</td>
            <td>{{ producto.nombre_proveedor }}</td>
            <td>{{ producto.marca }}</td>
            <!-- <td> -->
              <!-- <button class="uk-button uk-button-default uk-button-small" @click="verProducto(producto.id_producto)">Ver</button>
              <button class="uk-button uk-button-primary uk-button-small" @click="editarProducto(producto.id_producto)">Editar</button>
              <button class="uk-button uk-button-danger uk-button-small" @click="eliminarProducto(producto.id_producto)">Eliminar</button> -->
            <!-- </td> -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  Vue.component('v-select', VueSelect.VueSelect);
  let app = new Vue({
    el: '#lista_productos',
    data () {
      return {
        productos: null,
      }
    },
    methods: {
      async getProductos() {
        try {
          let response = await axios.get('<?= base_url('restProductos/getProductos') ?>');
          this.productos = response.data.data;
          $(function() {
            let table = $('#tabla_productos').DataTable({
                "order": [ 0, "desc" ],
                "info": false,
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
                "columnDefs": [
                {
                  "targets": [ 0 ],
                  "visible": false,
                  "searchable": false
                }
                ],
                "order": [[ 0, "asc" ]],
              }
            )
          });
        } catch (error) {
          console.log(error);
        }
      },
    },
    async created () {
      await this.getProductos();
    },
  });
</script>

<?= $this->endSection(); ?>
