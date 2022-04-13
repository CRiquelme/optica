<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Stock productos
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
<section id="stock">
  <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
      <titulo class="text-4xl"></titulo>
      <div class="uk-width-1-6 pos_relative">
          <!-- <button class="uk-button uk-button-secondary uk-button-small  uk-text-middle uk-position-center" @click="nuevo_traslado()">Nuevo</button> -->
      </div>
  </article>

  <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
    <!-- <div class="w-1/5">
        <h2>FILTROS</h2>
        <label>Producto</label>
        <v-select 
            :options="options" 
            :reduce="producto => producto.id_producto" 
            label="modelo" 
            :value="selected" 
            v-model="valorProducto"
            class="uk-form-width-large uk-width-1-1@m"
        >
            <span slot="no-options">No hay datos para su búsqueda.</span>
        </v-select>
        
        <div class="uk-margin-small-top">
            <label>Tienda</label>
            <v-select 
                :options="tiendas" 
                :reduce="tienda => tienda.id_tienda" 
                label="nombre_tienda" 
                :value="selected" 
                v-model="valorTienda"
                class="uk-form-width-large uk-width-1-1@m"
            >
                <span slot="no-options">No hay datos para su búsqueda.</span>
            </v-select>
        </div>
        <button @click="limpiarFiltro" class="uk-button uk-button-secondary uk-margin-medium-top uk-align-center">Limpiar filtros</button>

    </div> -->

    
    <div v-if="cargar" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    <div v-if="!cargar" class="w-full mb-5">
      <table class="uk-table uk-table-divider uk-table-striped uk-table-hover" id="stock_table">
        <thead>
          <tr>
            <th>Código</th>
            <th>Producto</th>
            <th>Tienda</th>
            <th>Marca</th>
            <th>Stock</th>
            <th>Stock crítico</th>
            <th>Observación</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(producto, index) in info" :key="index.producto_id">
            <td>{{producto.cod_barra}}</td>
            <td>{{producto.producto}}</td>
            <td>{{producto.tienda}}</td>
            <td>{{producto.nombre_marca}}</td>
            <td>{{producto.stock}}</td>
            <td>{{producto.stock_critico}}</td>
            <td>
              <span v-if="parseInt(producto.stock) <= parseInt(producto.stock_critico) && 
                          parseInt(producto.stock) > 0" 
                    class="bg-yellow-300 px-3 py-2">
                    Poco stock
              </span>
              <span v-else-if="parseInt(producto.stock) === 0" class="bg-red-200 px-3 py-2">Sin stock</span>
              <span v-else class="bg-green-200 px-3 py-2 w-full">Stock suficiente</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </article>
</section>

<script>

    Vue.component('v-select', VueSelect.VueSelect);

    Vue.component('titulo', {
        template: '<h1 class="uk-text-uppercase">{{titulo}}</h1>',
        data: function() {
            return { titulo: 'Stock de productos' }
        }
    });

    var app = new Vue({
        el      : '#stock',
        data () {
            return {
                info: null,
                infoedit: null,
                errores: [],
                valorProducto: null,
                valorTienda: null,
                selected: null,
                options: [],
                tiendas: [],
                cargar: true,
            }
        },

        methods: {
            limpiarFiltro: function() {
                this.valorProducto = null;
                this.valorTienda = null;
            },

            async getAllInfo() {
              let self = this;
              await axios
              .get('<?=base_url('rest-stock')?>')
              .then(response => (this.info = response.data.data));
              
              await axios
              .get('<?=base_url('rest-traslados/productos')?>')
              .then(response => (this.options = response.data.data));

              await axios
                  .get('<?=base_url('rest-traslados/tiendas')?>')
                  .then(response => (this.tiendas = response.data.data));

              $(function() {
                $('#stock_table').DataTable( 
                  {
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"                  
                    },
                  }
                )
              });
              self.cargar = false;
            }
        },

        async created () {
          await this.getAllInfo();
        }

    });

    $(document).ready(function() {
        $('#valorProducto').select2({});
    });
</script>


<?= $this->endSection();?>