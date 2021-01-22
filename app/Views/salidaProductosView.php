<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Salida de productos
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
<section id="salida_producto">
    <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
        <titulo class="text-4xl"></titulo>
    </article>

    <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
        <div class="w-1/5">
            <form class="uk-card uk-card-default uk-card-body">
                <h2 class="uk-text-uppercase">Salida de producto</h2>
                <fieldset class="uk-fieldset">
                    <div class="uk-margin">
                        <ul class="uk-list uk-list-striped">
                            <li class="text-orange-700" v-for="error in errores">{{ error }}</li>
                        </ul>
                    </div>
                    <div class="uk-margin">
                        <label>Buscar producto <small>(código de barras)</small></label>
                        <input @keyup="buscarCodigoBarra()" id="searchProduct" v-model="searchProduct" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="text" placeholder="12345">
                    </div>
                    <div class="uk-margin">
                        <label for="">Producto*</label>
                        <v-select 
                            :options="options" 
                            :reduce="producto => producto.id_producto" 
                            label="modelo" 
                            :value="selected" 
                            v-model="op_producto"
                            class="uk-form-width-large uk-width-1-1@m"
                            id="producto_id"
                            @input="revisarStock($event)"
                        >
                            <span slot="no-options">No hay datos del productos. <a href="<?=base_url('productos')?>" class="bg-blue-200 text-blue-800 hover:bg-blue-800 hover:text-blue-200 px-1 block">Por favor ingreselo.</a> </span>
                        </v-select>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="tienda_id">Tienda*</label>
                        <div class="uk-form-controls">
                            <select v-model="op_tienda_id" class="uk-select" id="tienda_id" name="tienda_id" @change="revisarStock($event)">
                                <option value="">Seleccione una tienda</option>
                                <option v-for="(tienda, index) in tiendas" :key="tiendas.id_tienda" v-bind:value="tienda.id_tienda">
                                    {{tienda.nombre_tienda}}
                                </option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="uk-margin">
                        <label class="uk-form-label" for="cantidad_productos">Cantidad de productos* (Stock: {{ stock }}) </label>
                        <input v-model="op_cantidad_productos" class="uk-input" id="cantidad_productos" name="cantidad_productos" type="number" placeholder="Cantidad" :min="1" autocomplete="off" :max="stock">
                    </div>
                    <div class="uk-margin" v-if="op_producto && op_tienda_id && op_cantidad_productos  && action === 'editar'">
                        <button class="bg-blue-700 min-w-full xl:min-w-0 text-white py-1 px-2 mb-2" type="button" @click="update_ingreso()">Editar</button>
                        <button class="bg-red-700 min-w-full xl:min-w-0 text-white py-1 px-2" type="button" @click="limpiar_form()">No editar</button>
                    </div>
                    <div class="uk-margin" v-else-if="op_producto && op_tienda_id && op_cantidad_productos && op_cantidad_productos <= stock && op_cantidad_productos > 0">
                        <button class="uk-button uk-button-primary uk-width-1-1" type="button" @click="agregar()">Guardar</button>
                    </div>
                    *<small class="text-red-600">datos obligatorios</small>
                </fieldset>
            </form>

            <div class="uk-card uk-card-default uk-card-body uk-margin-medium-top">
                <h2 class="uk-text-uppercase">FILTROS</h2>
                <label>Producto</label>
                <v-select 
                    :options="options" 
                    :reduce="producto => producto.modelo" 
                    label="modelo" 
                    :value="selected" 
                    v-model="valorProducto"
                    class="uk-form-width-large uk-width-1-1@m"
                >
                    <span slot="no-options">No hay datos para su búsqueda.</span>
                </v-select>
                
                <div class="uk-margin-small-top uk-margin-medium-bottom">
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
                <button @click="limpiarFiltro" class="uk-button uk-button-secondary uk-margin-medium-top uk-align-center">Limpiar</button>
            </div>
        </div>

        <div class="w-4/5">
            <table class="uk-table uk-table-striped uk-table-hover w-full" id="salidaProductos">
                <thead>
                    <tr>
                        <th>producto</th>
                        <th>tienda</th>
                        <th>cantidad</th>
                        <th>Fecha registro</th>
                        <th class="uk-text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-for="(ingresos, idinfo) in info" 
                        :key="ingresos.id_producto_salida" 
                        v-if="(ingresos.modelo === valorProducto || !valorProducto) 
                                && 
                            (ingresos.tienda_id === valorTienda || !valorTienda) "
                    >
                        <td>
                            <button class="uk-button uk-button-link uk-text-success uk-text-bolder" @click="editar_ingreso(idinfo, ingresos.producto_id, ingresos.id_producto_salida)">
                                <i class="far fa-edit uk-margin-small-left uk-text-success"></i> {{ ingresos.modelo }}
                            </button>
                        </td>
                        <td>{{ ingresos.nombre_tienda }}</td>
                        <td>{{ ingresos.cantidad_producto }}</td>
                        <td>{{ ingresos.created_at | fechaNormalSinHora }}</td>
                        <td class="uk-text-center">
                            <button class="uk-button uk-button-link uk-text-danger uk-text-bolder" @click="delete_ingreso(idinfo, ingresos.id_producto_salida)" v-bind:id="'delete-' + ingresos.id_producto_salida"><i class="fas fa-trash-alt uk-margin-small-left uk-text-danger" ></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </article>
</section>


<script>

    Vue.component('v-select', VueSelect.VueSelect)

    Vue.component('titulo', {
        template: '<h1 class="uk-text-uppercase">{{titulo}}</h1>',
        data: function() {
            return { titulo: 'Salida de productos' }
        }
    });

    Vue.filter('fechaNormalSinHora', function(value) {
        if (value) {
            return moment(String(value)).format('DD/MM/YYYY')
        }
    });

    var app = new Vue({
        el      : '#salida_producto',
        data () {
            return {
                info: null,
                infoedit: null,
                errores: [],
                op_producto: '',
                selected: null,
                tiendas: null,
                op_tienda_id: '',
                op_cantidad_productos: null,
                id_producto_salida: null,
                options: [],
                action: null,
                valorProducto: null,
                valorTienda: null,
                options: [],
                tiendas: [],
                searchProduct: '',
                stocks: null,
                stock: null,
            }
        },
        methods: {
            agregar: function() {
                const params = new URLSearchParams();

                if(this.op_producto !== null) {
                    params.append('producto_id', this.op_producto);
                }
                if(this.op_tienda_id !== null) {
                    params.append('tienda_id', this.op_tienda_id);
                }
                if(this.op_cantidad_productos !== null) {
                    params.append('cantidad_producto', this.op_cantidad_productos);
                }
                axios
                    .post('<?=base_url('rest-salida-productos')?>', params)
                    .then(
                        response => {
                            console.log(response.data);
                            if(response.data.code === 500) {
                                console.log(response.data.msj);
                                this.errores = response.data.msj;
                            } else {
                                axios
                                    .get('<?=base_url('rest-salida-productos')?>')
                                    .then(response => (this.info = response.data.data));
                                this.errores                = null;
                                this.op_cantidad_productos  = null;
                                this.op_tienda_id = '';
                                this.op_producto = '';
                                this.stock = null;
                            }
                        }
                    );
                Swal.fire({
                    position: 'top-end',
                    title: 'Salida registrada',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            },

            delete_ingreso : function(index, id) {
                const swalWithBootstrapButtons = Swal.mixin({
                                                    customClass: {
                                                        confirmButton: 'uk-button uk-button-primary',
                                                        cancelButton: 'uk-button uk-button-danger'
                                                    },
                                                    buttonsStyling: false
                                                });
                
                swalWithBootstrapButtons.fire({
                    title: '¿Está seguro que desea eliminarlo?',
                    // text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, quiero eliminarlo',
                    cancelButtonText: 'No, cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                            axios.delete('<?=base_url('rest-salida-productos')?>/' + id)
                            .then(response => {
                                this.info.splice(index, 1);
                            });

                            swalWithBootstrapButtons.fire(
                            'Eliminado',
                            'La salida fue eliminada.',
                            'success'
                            )
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                            'Cancelado',
                            'El ingreso se mantiene.',
                            'error'
                            )
                            
                        }
                    });
            },

            limpiar_form: function() {
                this.op_cantidad_productos  = null,
                this.op_factura             = null,
                this.action                 = null
            },

            editar_ingreso : function(index, producto_id, id_producto_salida) {
                this.action = 'editar'
                this.errores = null;
                this.op_producto = producto_id;
                this.id_producto_salida = id_producto_salida;

                axios
                .get('<?=base_url('rest-salida-productos')?>/' + id_producto_salida)
                .then(response => (
                        this.infoedit               = response.data,
                        this.op_cantidad_productos  = response.data.data.cantidad_producto,
                        this.op_tienda_id           = response.data.data.tienda_id
                    ));
            },

            update_ingreso: function() {
                console.log('guardando...');
                id = this.id_producto_salida;

                const params = new URLSearchParams();
                if(this.op_producto !== null) {
                    params.append('producto_id', this.op_producto);
                }
                if(this.op_tienda_id !== null) {
                    params.append('tienda_id', this.op_tienda_id);
                }
                if(this.op_cantidad_productos !== null) {
                    params.append('cantidad_producto', this.op_cantidad_productos);
                }
                axios
                    .put('<?=base_url('rest-salida-productos')?>/' + id, params)
                    .then(
                        response => {
                            console.log(response.data);

                            if(response.data.code === 500) {
                                console.log(response.data.msj);
                                this.errores = response.data.msj;
                                Swal.fire({
                                    title: 'Salida no actualizado',
                                    icon: 'error',
                                    confirmButtonText: 'Confirmar'
                                });
                            } else {
                                axios
                                    .get('<?=base_url('rest-salida-productos')?>')
                                    .then(response => (this.info = response.data.data));
                                this.errores = null;

                                Swal.fire({
                                    position: 'top-end',
                                    title: 'Salida actualizada',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        }
                    );
            },

            limpiarFiltro: function() {
                this.valorProducto = null;
                this.valorTienda = null;
            },

            buscarCodigoBarra: function() {
                var self = this
                // self.searchProducts = self.searchProduct
                axios
                    .get('<?=base_url("rest-stock/show-codigo")?>/' + self.searchProduct)
                    // .then(response => (self.buscarStock = response.data.data))
                    .then(response => (self.op_producto = response.data.data[0].producto_id));
            },

            revisarStock: function(event)  {
                axios
                .get('<?=base_url('rest-stock')?>')
                .then(response => (this.stocks = response.data.data));
                console.log(this.op_producto + ' ' + this.op_tienda_id)
                for(st of this.stocks) {
                    if(this.op_producto === st.producto_id && this.op_tienda_id === st.tienda_id) {
                        return this.stock = st.stock;
                    } 
                    this.stock = 0;
                }
            },

            getAllInfo() {
                axios
                    .get('<?=base_url('rest-salida-productos')?>')
                    .then(response => {
                        this.info = response.data.data;
                        
                        $(function() {
                            var table = $('#salidaProductos').DataTable( 
                                {
                                    "order": [ 3, "desc" ],
                                    "info": false,
                                    "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
                                }
                            )
                        });
                    });
            }
        },
        created () {
            axios
                .get('<?=base_url('rest-stock')?>')
                .then(response => (this.stocks = response.data.data));
        },

        mounted () {
            var self = this;

            axios
                .get('<?=base_url('rest-traslados/productos')?>')
                .then(response => (this.options = response.data.data));

            axios
                .get('<?=base_url('rest-traslados/tiendas')?>')
                .then(response => (this.tiendas = response.data.data));
            
            axios
                .get('<?=base_url('rest-salida-productos')?>')
                .then(response => (this.info = response.data.data));

            axios
            .get('<?=base_url('rest-traslados/productos')?>')
            .then(response => (this.options = response.data.data));

            axios
                .get('<?=base_url('rest-traslados/tiendas')?>')
                .then(response => (this.tiendas = response.data.data));
        },
        mounted () {
           this.getAllInfo();
        }
    });

    $(document).ready(function() {
        $('#op_producto').select2({});
    });
</script>

<?= $this->endSection();?>