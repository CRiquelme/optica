<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Ingreso de productos
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
<section id="ingreso_producto">
    <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
        <titulo class="text-4xl"></titulo>

        


        <div class="uk-width-1-6 pos_relative">
            <!-- <button class="uk-button uk-button-secondary uk-button-small  uk-text-middle uk-position-center" @click="nuevo_traslado()">Nuevo</button> -->
        </div>
    </article>

    <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
        <div class="uk-width-1-4 uk-margin-large-bottom">
            <form class="uk-card uk-card-default uk-card-body">
                <h2 class="uk-text-uppercase">Nuevo ingreso</h2>
                <fieldset class="uk-fieldset">
                    <div class="uk-margin">
                        <ul class="uk-list uk-list-striped">
                            <li class="text-orange-700" v-for="error in errores">{{ error }}</li>
                        </ul>
                    </div>
                    <div class="uk-margin">
                        <label for="">Producto</label>
                        <v-select 
                            :options="options" 
                            :reduce="producto => producto.id_producto" 
                            label="modelo" 
                            :value="selected" 
                            v-model="op_producto"
                            class="uk-form-width-large uk-width-1-1@m"
                            id="producto_id"
                        >
                        <span slot="no-options">No hay datos del productos. <a href="<?=base_url('productos')?>" class="bg-blue-200 text-blue-800 hover:bg-blue-800 hover:text-blue-200 px-1 block">Por favor ingreselo.</a> </span>
                        </v-select>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="tienda_id">Tienda</label>
                        <div class="uk-form-controls">
                            <select v-model="op_tienda_id" class="uk-select" id="tienda_id" name="tienda_id">
                                <option value="">Seleccione una tienda</option>
                                <option v-for="(tienda, index) in tiendas" :key="tiendas.id_tienda" v-bind:value="tienda.id_tienda">
                                    {{tienda.nombre_tienda}}
                                </option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="uk-margin">
                        <label class="uk-form-label" for="cantidad_productos">Cantidad de productos</label>
                        <input v-model="op_cantidad_productos" class="uk-input" id="cantidad_productos" name="cantidad_productos" type="number" placeholder="Cantidad" :min="1" autocomplete="off">
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="op_factura">Factura</label>
                        <input v-model="op_factura" class="uk-input" id="op_factura" name="op_factura" type="text" placeholder="Factura" autocomplete="off">
                    </div>
                    <div class="uk-margin" v-if="op_producto && op_tienda_id && op_cantidad_productos && op_factura && action === 'editar'">
                        <button class="uk-button uk-button-primary" type="button" @click="update_ingreso()">Editar</button>
                        <button class="uk-button uk-button-secondary" type="button" @click="limpiar_form()">Limpiar</button>
                    </div>
                    <div class="uk-margin" v-else-if="op_producto && op_tienda_id && op_cantidad_productos && op_factura">
                        <button class="uk-button uk-button-primary uk-width-1-1" type="button" @click="agregar()">Guardar</button>
                    </div>
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
                <button @click="limpiarFiltro" class="uk-button uk-button-secondary uk-margin-medium-top uk-align-center">Limpiar filtros</button>
            </div>
        </div>

        <div class="uk-width-3-4" uk-grid>
            <table class="uk-table uk-table-divider uk-table-striped uk-table-hover">
                <thead>
                    <tr>
                        <th>producto</th>
                        <th>tienda</th>
                        <th>cantidad</th>
                        <th>factura</th>
                        <th>Fecha registro</th>
                        <th class="uk-text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-for="(ingresos, idinfo) in info" 
                        :key="ingresos.id_producto_ingreso" 
                        v-if="(ingresos.modelo === valorProducto || !valorProducto) 
                                && 
                            (ingresos.tienda_id === valorTienda || !valorTienda) "
                    >
                        <td>
                            <button class="uk-button uk-button-link uk-text-success uk-text-bolder" @click="editar_ingreso(idinfo, ingresos.producto_id, ingresos.id_producto_ingreso)">
                                <i class="far fa-edit uk-margin-small-left uk-text-success"></i> {{ ingresos.modelo }}
                            </button>
                        </td>
                        <td>{{ ingresos.nombre_tienda }}</td>
                        <td>{{ ingresos.cantidad_producto }}</td>
                        <td>{{ ingresos.factura }}</td>
                        <td>{{ ingresos.created_at | fechaNormalSinHora }}</td>
                        <td class="uk-text-center">
                            <button class="uk-button uk-button-link uk-text-danger uk-text-bolder" @click="delete_ingreso(idinfo, ingresos.id_producto_ingreso)" v-bind:id="'delete-' + ingresos.id_producto_ingreso"><i class="fas fa-trash-alt uk-margin-small-left uk-text-danger" ></i></button>
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
            return { titulo: 'Ingreso de productos' }
        }
    });

    Vue.filter('fechaNormalSinHora', function(value) {
        if (value) {
            return moment(String(value)).format('DD/MM/YYYY')
        }
    });

    var app = new Vue({
        el      : '#ingreso_producto',
        data () {
            return {
                info: null,
                infoedit: null,
                errores: [],
                op_producto: null,
                selected: null,
                tiendas: null,
                op_tienda_id: 1,
                op_cantidad_productos: null,
                op_factura: null,
                id_producto_ingreso: null,
                options: [],
                action: null,
                valorProducto: null,
                valorTienda: null,
                options: [],
                tiendas: []
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
                if(this.op_factura !== null) {
                    params.append('factura', this.op_factura);
                }
                axios
                    .post('<?=base_url('rest-ingreso-productos')?>', params)
                    .then(
                        response => {
                            console.log(response.data);
                            if(response.data.code === 500) {
                                console.log(response.data.msj);
                                this.errores = response.data.msj;
                            } else {
                                axios
                                    .get('<?=base_url('rest-ingreso-productos')?>')
                                    .then(response => (this.info = response.data.data));
                                this.errores                = null;
                                // this.op_producto            = null;
                                // this.op_tienda_id           = null;
                                this.op_cantidad_productos  = null;
                                this.op_factura             = null;
                            }
                        }
                    );
                Swal.fire({
                    position: 'top-end',
                    title: 'Ingreso registrado',
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
                            axios.delete('<?=base_url('rest-ingreso-productos')?>/' + id)
                            .then(response => {
                                this.info.splice(index, 1);
                            });

                            swalWithBootstrapButtons.fire(
                            'Eliminado',
                            'El ingreso fue eliminado.',
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
                // this.op_tienda_id           = null,
                this.op_factura             = null,
                this.action                 = null
            },

            editar_ingreso : function(index, producto_id, id_producto_ingreso) {
                this.action = 'editar'
                this.errores = null;
                console.log(index);
                console.log(producto_id);
                console.log(id_producto_ingreso);
                this.op_producto = producto_id;
                this.id_producto_ingreso = id_producto_ingreso;
                // this.op_id_producto_tienda = id;
                // console.log(this.op_id_producto_tienda);
                
                axios
                .get('<?=base_url('rest-ingreso-productos')?>/' + id_producto_ingreso)
                .then(response => (
                        this.infoedit               = response.data,
                        // this.op_productos           = response.data.data.producto_id,
                        this.op_cantidad_productos  = response.data.data.cantidad_producto,
                        this.op_tienda_id           = response.data.data.tienda_id,
                        this.op_factura             = response.data.data.factura
                        // this.op_tienda_destino_id   = response.data.data.tienda_destino_id
                    ));                
                // var modal = UIkit.modal("#modal-container").show();
            },
            update_ingreso: function() {
                console.log('guardando...');
                id = this.id_producto_ingreso;

                const params = new URLSearchParams();
                if(this.op_producto !== null) {
                    params.append('producto_id', this.op_producto);
                }
                if(this.op_producto !== null) {
                    params.append('tienda_id', this.op_tienda_id);
                }
                if(this.op_producto !== null) {
                    params.append('cantidad_producto', this.op_cantidad_productos);
                }
                if(this.op_producto !== null) {
                    params.append('factura', this.op_factura);
                }
                axios
                    .put('<?=base_url('rest-ingreso-productos')?>/' + id, params)
                    .then(
                        response => {
                            // this.info.push(response.data.data);
                            // UIkit.modal("#modal-container").hide();

                            console.log(response.data);

                            if(response.data.code === 500) {
                                console.log(response.data.msj);
                                this.errores = response.data.msj;
                                Swal.fire({
                                    title: 'Ingreso no actualizado',
                                    icon: 'error',
                                    confirmButtonText: 'Confirmar'
                                });
                            } else {
                                axios
                                    .get('<?=base_url('rest-ingreso-productos')?>')
                                    .then(response => (this.info = response.data.data));
                                this.errores = null;

                                Swal.fire({
                                    position: 'top-end',
                                    title: 'Ingreso actualizado',
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
            }
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
                .get('<?=base_url('rest-ingreso-productos')?>')
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
        $('#op_producto').select2({});
    });
</script>

<?= $this->endSection();?>