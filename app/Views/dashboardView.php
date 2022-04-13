<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Dashboard
<?= $this->endSection();?>


<?= $this->section('page_content'); ?>

<section class="m-10" id="dashboardGeneral">
  <div class="grid md:grid-cols-5 gap-4">
    <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
        <?= $this->include('components/sidebar') ?>
    </div>
    <div class="md:row-span-1 md:col-span-4">
    <div class="grid md:grid-cols-5 gap-4">
      <div class="md:row-span-4 md:col-span-2 px-4">
          <h2 class="my-4 flex-none uppercase">Buscar producto <small>(código de barras)</small></h2>
          <input @keyup="buscarCodigoBarra()" id="searchProduct" v-model="searchProduct" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="text" placeholder="12345">
          <button @click="limpiar_buscador_productos()" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white focus:outline-none py-2 px-4 border border-blue-500 hover:border-transparent rounded-lg my-3">Limpiar</button>
      </div>
        <div class="md:row-span-4 md:col-span-2 px-4">
            <div 
                class="pt-4"
                v-for="(i, index) in info" 
                v-if="i.cod_barra === searchProduct "
            >
                <h3 class="text-lg uppercase font-bold">{{ i.modelo }} - {{ i.nombre_marca }} - {{ i.precio_venta | clp }}</h3>
            </div>
            <ul v-if="buscarStock != 0">
                <li
                    v-for="(s, index) in buscarStock" 
                    :key="`${s.cod_barra}${index}`" 
                >
                    {{ s.tienda }}, <span class="">stock: <b>{{ s.stock }}</b></span> 
                </li>
            </ul>
            <ul v-else>
                <li>Sin información del producto</li>
            </ul>
        </div>
      </div>
    </div>
    <div class="md:row-span-1 md:col-span-4">
      <h2 class="text-xl font-bold">Productos con stock crítico <i class="fas fa-question-circle" title="Si el stock es mayor a cero y el stock es mayor o igual al stock crítico, se muestra en la tabla."></i></h2>
      <table class="uk-table uk-table-hover uk-table-striped" id="stock_critico">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Tienda</th>
                <th>Stock</th>
                <th>Stock crítico</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(s, index) in stock" :key="index.producto_id">
                <td>{{ s.producto }}</td>
                <td>{{ s.tienda }}</td>
                <td>{{ s.stock }}</td>
                <td>{{ s.stock_critico }}</td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>


<script>
  var app = new Vue({
    el      : '#dashboardGeneral',
    data () {
      return {
          info: null,
          marcas: null,
          marcasUnicas: null,
          stock: [],
          searchProduct: null,
          searchProducts: null,
          buscarStock: null
      }
    },
    
    methods: {
        limpiar_buscador_productos: function () {
            this.searchProduct = null;
            this.buscarStock = null
            document.getElementById("searchProduct").focus();
        },

        buscarCodigoBarra: function() {
            let self = this
            if(self.searchProduct != '') {
                self.searchProducts = self.searchProduct
            } else {
                self.searchProducts = 0; 
            }
            axios
                .get('<?=base_url("rest-stock/show-codigo")?>/' + self.searchProducts)
                .then(response => (self.buscarStock = response.data.data));
        }
    },

    filters: {
        clp: function(value) {
            if(!value) return ''
            return new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(value)
        }
    },

    created () {
        let self = this
        axios
            .get('<?=base_url('rest-productos')?>')
            .then(response => (
                    this.info = response.data.data,
                    this.marcas = response.data.data.map(marca => marca.nombre_marca),
                    this.marcasUnicas = [...new Set(this.marcas)]
                )
            )
        
    },

    mounted () {
        let self = this;
        this.limpiar_buscador_productos();
        axios
          .get('<?=base_url('rest-stock')?>')
          .then(response => {
              self.stock = response.data.data.filter(s => s.stock > 0 && s.stock <= s.stock_critico);
              // self.stock = response.data.data;
              
              $(function() {
                  let table = $('#stock_critico').DataTable( 
                      {
                          "order": [ 0, "desc" ],
                          "info": false,
                          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                          "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
                      }
                  )
              });
          });
    }
  });
</script>
<?= $this->endSection();?>