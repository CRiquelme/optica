<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Infome de traslados
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>

<section id="informe">
    <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
        <h1 class="text-4xl uppercase">Informe de traslados</h1>
    </article>

    <!-- Formulario de consulta -->
    <div class="flex flex-wrap mb-2 mx-10 my-5">
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cFecha">
                Fecha
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="cFecha" type="date" placeholder="Fecha" v-model="cFecha" @change="getInfo">
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cTiendaOrigen">
                Tienda de origen
            </label>
            <select v-model="cTiendaOrigen" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="cTiendaOrigen" name="cTiendaOrigen" @change="getInfo">
                <option v-for="(tienda, index) in tiendas" :key="tiendas.id_tienda" :value="tienda.id_tienda">
                    {{tienda.nombre_tienda}}
                </option>
            </select>
        </div>
        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cTiendaDestino">
                Tienda de destino
            </label>
            <select v-model="cTiendaDestino" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="cTiendaDestino" name="cTiendaDestino" @change="getInfo">
                <option v-for="(tienda, index) in tiendas" :key="tiendas.id_tienda" :value="tienda.id_tienda">
                    {{tienda.nombre_tienda}}
                </option>
            </select>
        </div>

        <div v-if="cargar" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>


        <table v-else class="uk-table uk-table-striped uk-table-hover">
            <thead>
                <tr>
                    <th>ID de traslado</th>
                    <th>Código de barra</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio de compra</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(it, idDetalle) in info" :key="idDetalle">
                    <td>{{ it.id_producto_tienda }}</td>
                    <td>{{ it.cod_barra }}</td>
                    <td>{{ it.modelo }}</td>
                    <td>{{ it.cantidad_productos }}</td>
                    <td>{{ it.precio_unitario | money }}</td>
                    <td>{{ it.cantidad_productos != null ? it.cantidad_productos * it.precio_unitario : 0 | money }}</td>
                </tr>
                <tr>
                    <td class="bg-gray-200 font-bold" colspan="5">Total</td>
                    <td class="bg-gray-200 font-bold">{{totalDetalleFactura | money}}</td>
                </tr>
                
            </tbody>
        </table>

    </div>

</section>

<script>
var app = new Vue({
    el      : '#informe',
    data () {
        return {
            tiendas: [],
            cTiendaOrigen: 1,
            cTiendaDestino: 3,
            cFecha: null,
            info: null,
            cargar: false,
        }
    },
    methods: {
        getInfo: function() {
            this.cargar = true
            let url = '<?=base_url('rest-traslados/informeTraslados')?>/'+this.cFecha+'/'+this.cTiendaOrigen+'/'+this.cTiendaDestino;
            axios
                .get(url)
                .then(response => {
                    this.info = response.data.data
                    this.cargar = false
                })
        }
    },

    created () {
        axios
            .get('<?=base_url('rest-traslados/tiendas')?>')
            .then(response => {
                this.tiendas = response.data.data
            });
            
            this.cFecha = new Date().toJSON().slice(0,10)
    },

    mounted () {
        
    },

    computed: {
        totalDetalleFactura: function () {
            let total = 0
            if(this.info != null) {
                let precios = this.info.map((det) => { 
                    if(det.precio_unitario != null && det.precio_unitario != null) {
                        return det.precio_unitario * det.cantidad_productos } 
                    }
                );
                
                total = precios.length > 0 ? precios.reduce((a, b) => a + b) : 0
            }
            return total;
        },

    },

    filters: {
        money: function (value) {
            if(value != null) {
                return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        },
        thousand: function (value) {
            if(value != null) {
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        }
    },
    
});
</script>

<?= $this->endSection();?>