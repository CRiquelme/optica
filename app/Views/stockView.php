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
    <!-- <article class="uk-container uk-container-larger uk-align-center " uk-grid> -->
        <div class="uk-margin uk-width-1-4 uk-card uk-card-default uk-card-body uk-margin-small-left">
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

        </div>
        
        <div class="uk-width-3-4" uk-grid>
            <div 
                v-for="(stock, index) in info" 
                :key="index.producto_id" 
                v-if="(stock.producto_id === valorProducto || !valorProducto) 
                        && 
                        (stock.tienda_id === valorTienda || !valorTienda) "
            >
                <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                    <h3 class="uk-card-title">{{ stock.producto }} en {{ stock.tienda }}</h3>
                    <p class="mb-4">
                        <b>Producto:</b> {{ stock.producto }} <br>
                        <b>Marca:</b> {{stock.nombre_marca}} <br>
                        <b>Stock:</b> {{ stock.stock }} <br>
                        <b>Stock crítico:</b> {{ stock.stock_critico }} <br>
                        <!-- <b>Stock crítico:</b> {{ stock.stock_critico }} <br> -->
                    </p>
                        <span v-if="parseInt(stock.stock) <= parseInt(stock.stock_critico)" class="bg-yellow-300 px-3 py-2">Poco stock </span>
                        <span v-else-if="parseInt(stock.stock) == 0" class="bg-red-200 px-3 py-2">Sin stock </span>
                        <span v-else class="bg-green-200 px-3 py-2">Stock suficiente</span>
                        <!-- <span v-else class="uk-alert-success" uk-alert>Stock suficiente</span> -->
                </div>
            </div>
        </div>
    </article>

</section> <!-- Stock -->






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
                tiendas: []
            }
        },

        methods: {
            limpiarFiltro: function() {
                this.valorProducto = null;
                this.valorTienda = null;
            }
        },
       
        created () {
            var self = this;
            axios
            .get('<?=base_url('rest-stock')?>')
            .then(response => (this.info = response.data.data));
            
            axios
            .get('<?=base_url('rest-traslados/productos')?>')
            .then(response => (this.options = response.data.data));

            axios
                .get('<?=base_url('rest-traslados/tiendas')?>')
                .then(response => (this.tiendas = response.data.data));
        }
    });

    $(document).ready(function() {
        $('#valorProducto').select2({});
    });
</script>


<?= $this->endSection();?>