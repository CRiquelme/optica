<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Traslados
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
<section id="traslados">
    <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
        <titulo class="text-4xl"></titulo>
        <div class="uk-width-1-6 pos_relative">
            <button class="uk-button uk-button-secondary uk-button-small  uk-text-middle uk-position-center" @click="nuevo_traslado()">Nuevo</button>
        </div>
    </article>

    <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
        <div class="w-1/5">
            <div class="uk-card uk-card-default uk-card-body uk-margin-small-left mb-10">
                <h2>Agregar</h2>
                <div class="uk-width-1-1@s">
                    <label>Buscar producto <small>(código de barras)</small></label>
                    <input @keyup="buscarCodigoBarra3($event)" id="searchProduct3" v-model="searchProduct3" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal"  type="text" placeholder="12345">
                </div>
                <!-- Nombre producto -->
                <label class="uk-form-label">Producto</label>
                <div class="uk-form-controls">
                    <v-select 
                        :options="productos2" 
                        :reduce="producto => producto.id_producto" 
                        label="modelo" 
                        :value="selected2" 
                        v-model="op_productos3"
                        class="uk-form-width-large uk-width-1-1@m"
                        id="op_productos3"
                    >
                        <span slot="no-options">
                            No hay datos para su búsqueda.
                        </span>
                    </v-select>
                </div>
                <!-- Tienda origen -->
                <label class="uk-form-label" for="tienda_id">Tienda de origen</label>
                <div class="uk-form-controls">
                    <select v-model="op_tienda_id" class="uk-select" id="op_tienda_id" name="op_tienda_id" @change="onChange2($event)">
                        <option v-for="(tienda, index) in tiendas" :key="tiendas.id_tienda" v-bind:value="tienda.id_tienda">
                            {{tienda.nombre_tienda}}
                        </option>
                    </select>
                </div>
                <!-- Tienda destino -->
                <label class="uk-form-label" for="tienda_destino_id">Tienda de destino</label>
                <div class="uk-form-controls">
                    <select v-model="op_tienda_destino_id" class="uk-select" id="op_tienda_destino_id" name="op_tienda_destino_id">
                        <option v-for="(tienda, index) in tiendas" :key="tiendas.id_tienda" v-bind:value="tienda.id_tienda">
                            {{tienda.nombre_tienda}}
                        </option>
                    </select>
                </div>
                <!-- Cantidad de producto -->
                <label class="uk-form-label" for="op_cantidad_productos">Cantidad de productos 
                    <template v-if="(op_productos3 != null && op_productos != '') 
                        && (op_tienda_id !== null && op_tienda_id != '')
                        && cargando === false">
                        <small v-if="op_stock2 > 0" class="uk-label uk-label-success">Valor máximo: {{op_stock2}}</small>
                        <small v-if="op_stock2 <= 0" class="uk-label uk-label-danger">Sin stock</small>
                    </template>
                    <template v-if="cargando === true"> 
                        <span class="bg-black text-white p-1 block">Comprobando stock...</span>
                    </template>
                </label>
                <input v-model.number="op_cantidad_productos" class="uk-input" id="op_cantidad_productos" name="op_cantidad_productos" type="number" placeholder="Cantidad" :max='op_stock2' :min='1' autocomplete="off">

                <!-- Guardar -->
                <button 
                    v-if="action === null 
                    && op_stock2 != null 
                    && op_stock2 != 0 
                    && op_cantidad_productos <= op_stock2 
                    && op_tienda_id !== op_tienda_destino_id
                    && op_tienda_id !== null
                    && op_tienda_destino_id !== null
                    && op_productos3 != null"
                    class="uk-button uk-button-primary" 
                    type="button" 
                    @click="agregar_traslado2()">
                        Guardar
                </button>
                <span 
                    v-if="op_tienda_id === op_tienda_destino_id
                        && op_tienda_id !== null
                        && op_tienda_destino_id !== null"
                    class="bg-black text-white py-2 px-3 block"
                >
                    No puede seleccionar la misma tienda
                </span>
            </div>

            <div class="uk-card uk-card-default uk-card-body uk-margin-small-left">
                <h2>FILTRO</h2>
                <div class="uk-margin">
                    <label>Buscar producto <small>(código de barras)</small></label>
                    <input @keyup="buscarCodigoBarra()" id="searchProduct" v-model="searchProduct" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="text" placeholder="12345">
                </div>
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
                
                <div class="uk-margin-small-top">
                    <label>Tienda de origen</label>
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
        
        <div v-if="cargar" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

        <div v-if="!cargar" class="w-4/5">
            <table class="uk-table uk-table-divider uk-table-striped uk-table-hover"  id="trasladosProductos">
                <thead>
                    <tr class="uk-text-bold">
                        <th class="uk-text-center">ID</th>
                        <th class="uk-text-center">Cod. Barra</th>
                        <th class="uk-text-center">Producto</th>
                        <th class="uk-text-center">Tienda de origen</th>
                        <th class="uk-text-center">Tienda de destino</th>
                        <th class="uk-text-center">Cantidad de productos</th>
                        <th class="uk-text-center">Fecha registro</th>
                        <th class="uk-text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-for="(tras, index) in info" 
                        :key="index.id_producto"
                        v-if="(tras.modelo === valorProducto || !valorProducto) 
                                && 
                            (tras.tienda_id === valorTienda || !valorTienda) 
                                &&
                            (tras.cod_barra === codBarra || !codBarra)
                            "
                    >
                    
                        <td class="uk-text-center">
                            <button class="uk-button uk-button-link uk-text-success uk-text-bolder" @click="editar_traslado(index, tras.id_producto_tienda)"><i class="far fa-edit uk-margin-small-left uk-text-success"></i> {{tras.id_producto_tienda}}</button>
                        </td>
                        <td class="uk-text-center">{{tras.cod_barra}}</td>
                        <td class="uk-text-center">{{tras.modelo}}</td>
                        <td class="uk-text-center">{{tras.tienda_origen}}</td>
                        <td class="uk-text-center">{{tras.tienda_destino}}</td>
                        <td class="uk-text-center">{{tras.cantidad_productos}}</td>
                        <td class="uk-text-center">{{tras.created_at | fechaSinHora}}</td>
                        <td  class="uk-text-center">
                            <div class="uk-button-group">
                                <button class="uk-button uk-button-default">OPCIONES</button>
                                <div class="uk-inline">
                                    <button class="uk-button uk-button-default" type="button"><i class="fas fa-chevron-circle-down"></i></button>
                                    <div uk-dropdown="mode: click; boundary: ! .uk-button-group; boundary-align: true;">
                                        <ul class="uk-nav uk-dropdown-nav">
                                            <li>
                                                <button class="uk-button uk-button-link uk-text-danger uk-text-bolder" @click="delete_traslado(index, tras.id_producto_tienda)" v-bind:id="'delete-' + tras.id_producto_tienda"><i class="fas fa-trash-alt uk-margin-small-left uk-text-danger" ></i> Eliminar</button>
                                            </li>
                                            <li>
                                                <button class="uk-button uk-button-link uk-text-success uk-text-bolder" @click="editar_traslado(index, tras.id_producto_tienda)"><i class="far fa-edit uk-margin-small-left uk-text-success"></i> Editar</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </article>


    <div id="modal-container" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 class="uk-modal-title uk-form-stacked uk-padding-large uk-padding-remove-top uk-padding-remove-bottom uk-text-uppercase">Traslados</h2>
            <!-- {{tiendas}} -->
            <!-- {{ infoedit }} -->
            <?php
            echo form_open('form_traslados', array('class' => 'uk-form-stacked uk-padding-large uk-padding-remove-top uk-padding-remove-bottom', 'id' => 'form_traslados'));
            ?>

            
            
            <div class="uk-margin" uk-grid>
                <div class="uk-width-1-1@s">
                    <ul class="uk-list uk-list-striped">
                        <li class="uk-text-danger" v-for="error in errores">{{ error }}</li>
                    </ul>
                </div>
            </div>
            <div class="uk-margin" uk-grid>

                <div class="uk-width-1-1@s">
                    <label>Buscar producto <small>(código de barras)</small></label>
                    <input @keyup="buscarCodigoBarra2()" id="searchProduct2" v-model="searchProduct2" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal"  type="text" placeholder="12345">
                    
                </div>
                
                <div class="uk-width-1-2@s">
                    <label class="uk-form-label" for="op_productos">Producto</label>
                    <div class="uk-form-controls">
                        <v-select 
                            :options="productos" 
                            :reduce="producto => producto.id_producto" 
                            label="modelo" 
                            :value="selected" 
                            v-model="op_productos"
                            class="uk-form-width-large uk-width-1-1@m"
                            id="op_productos"
                            @input="onChange2($event)"
                        >
                            <span slot="no-options">
                                No hay datos para su búsqueda.
                            </span>
                        </v-select>
                    </div>
                </div> 

                <div class="uk-width-1-2@s">    
                    <label class="uk-form-label" for="tienda_id">Tienda de origen</label>
                    <div class="uk-form-controls">
                        <select v-model="op_tienda_id" class="uk-select" id="op_tienda_id" name="op_tienda_id" @change="onChange($event)">
                            <option value="">Seleccione una tienda</option>
                            <option v-for="(tienda, index) in tiendas" :key="tiendas.id_tienda" v-bind:value="tienda.id_tienda">
                                {{tienda.nombre_tienda}}
                            </option>
                        </select>
                    </div>
                </div>
                
                <div class="uk-width-1-2@s">
                    <label class="uk-form-label" for="op_cantidad_productos">Cantidad de productos 
                        <template v-if="(op_productos != null && op_productos != '') && 
                            (op_tienda_id !== null && op_tienda_id != '')">
                            <small v-if="op_stock > 0" class="uk-label uk-label-success">Valor máximo: {{ op_stock }}</small>
                            <small v-if="op_stock <= 0" class="uk-label uk-label-danger">Sin stock</small>
                        </template>
                    </label>
                    <input v-model.number="op_cantidad_productos" class="uk-input" id="op_cantidad_productos" name="op_cantidad_productos" type="number" placeholder="Cantidad" :max='op_stock' :min='1' autocomplete="off">
                </div>

                <div class="uk-width-1-2@s">
                    <label class="uk-form-label" for="tienda_destino_id">Tienda de destino</label>
                    <div class="uk-form-controls">
                        <select v-model="op_tienda_destino_id" class="uk-select" id="op_tienda_destino_id" name="op_tienda_destino_id">
                            <option value="">Seleccione una tienda</option>
                            <option v-for="(tienda, index) in tiendas" :key="tiendas.id_tienda" v-bind:value="tienda.id_tienda">
                                {{tienda.nombre_tienda}}
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <button class="uk-button uk-button-danger uk-modal-close" type="button">Cancelar</button>
            <button class="uk-button uk-button-secondary" type="button" @click="onChange">comprobar stock</button>
            <button v-if="action === 'editar' && op_stock >= op_cantidad_productos" class="uk-button uk-button-primary" type="button" @click="update_traslado()">Editar</button>
            <button v-else-if="action === null && op_stock != null && op_stock != 0 && op_cantidad_productos <= op_stock" class="uk-button uk-button-primary" type="button" @click="agregar_traslado()">Guardar</button>
            

            <?php
            echo form_close();
            ?>
        </div>
    </div>
</section> <!-- traslados -->


<script>
    Vue.component('v-select', VueSelect.VueSelect);

    Vue.component('titulo', {
        template: '<h1 class="uk-text-uppercase">{{titulo}}</h1>',
        data: function() {
            return { titulo: 'Traslado de productos' }
        }
    });

    var app = new Vue({
        el      : '#traslados',
        data () {
            return {
                info: null,
                infoedit: null,
                tiendas: null,
                // productos: null,
                selected: null,
                selected2: null,
                op_id_producto_tienda: null,
                op_productos: null,
                op_productos3: null,
                op_cantidad_productos: 1,
                op_tienda_id: null,
                op_tienda_destino_id: null,
                op_stock: null,
                op_stock2: null,
                productos: [],
                productos2: [],
                action: null,
                stocks: null,
                errores: [],
                valorProducto: null,
                valorTienda: null,
                codBarra: null,
                codBarra2: null,
                searchProduct: null,
                searchProduct2: null,
                searchProduct3: null,
                options: [],
                tiendas: [],
                cargando: false,
                cargar: false,
            }
        },
        methods: {
            buscarCodigoBarra: function() {
                var self = this
                self.codBarra = self.searchProduct
                // console.log(self.codBarra)
            },

            async getAllInfo() {
                await axios
                    .get('<?=base_url('rest-traslados')?>')
                    .then(response => {
                        this.info = response.data.data;
                        
                        // $(function() {
                        //     $('#trasladosProductos').DataTable( 
                        //         {
                        //             "order": [ 0, "desc" ],
                        //             "info": false,
                        //             "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
                        //         }
                        //     )
                        // });
                    });
                $(function() {
                    $('#trasladosProductos').DataTable( 
                        {
                            "order": [ 0, "desc" ],
                            "info": false,
                            "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
                        }
                    )
                });
            },

            buscarCodigoBarra2: function() {
                var self = this
                axios
                    .get('<?=base_url("rest-stock/show-codigo")?>/' + self.searchProduct2)
                    .then(response => {
                        self.op_productos = response.data.data[0].producto_id
                        // console.log(response.data.data[0].producto_id)
                    });
            },

            buscarCodigoBarra3: async function(event) {
                let self = this;
                this.cargando = true;
                // Get id of product3
                await axios
                    .get('<?=base_url("rest-stock/show-codigo")?>/' + self.searchProduct3)
                    .then(response => {
                        self.op_productos3 = response.data.data[0].producto_id
                    })
                    .catch(error => {
                        console.log(error);
                        self.op_productos3 = null;
                    })

                const stockTienda = await self.getStocks2();

                stockTienda.forEach(s => {
                    if( self.op_productos3 === s.producto_id && 
                        self.op_tienda_id === s.tienda_id) 
                    {
                        return self.op_stock2 = s.stock;
                    } 
                    self.op_stock2 = 0;
                })
                self.cargando = false;
            },

            getStocks2: async function() {
                var self = this
                self.stocks2 = null; 
                await axios
                    .get('<?=base_url('rest-stock')?>')
                    .then(response => (self.stocks2 = response.data.data));
                
                // Get all stocks of the product3
                const stockTienda = self.stocks2.filter(
                    s => (s.producto_id === self.op_productos3 && s.tienda_id === self.op_tienda_id)
                )
                return stockTienda;
            },

            delete_traslado : function(index, id) {
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
                        axios.delete('<?=base_url('rest-traslados')?>/' + id)
                            .then(response => {
                                this.info.splice(index, 1);
                            });
                            swalWithBootstrapButtons.fire(
                            'Eliminado',
                            'El traslado fue eliminado.',
                            'success'
                            )
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                            'Cancelado',
                            'El traslado se mantiene.',
                            'error'
                            )
                            
                        }
                    });
            },

            // Al presionar el botón de editar un traslado
            editar_traslado : function(index, id) {
                var self = this;
                this.action = 'editar'
                this.errores = null;
                this.op_id_producto_tienda = id;
                axios
                    .get('<?=base_url('rest-traslados/tiendas')?>')
                    .then(response => (this.tiendas = response.data.data));
                axios
                    .get('<?=base_url('rest-traslados/productos')?>')
                    .then(response => {
                        this.productos  = response.data.data
                    });
                axios
                    .get('<?=base_url('rest-traslados')?>/' + id)
                    .then(response => (
                            self.infoedit               = response.data,
                            self.op_productos           = response.data.data.producto_id,
                            self.op_cantidad_productos  = response.data.data.cantidad_productos,
                            self.op_tienda_id           = response.data.data.tienda_id,
                            self.op_tienda_destino_id   = response.data.data.tienda_destino_id
                        )
                    )

                var modal = UIkit.modal("#modal-container").show();
            },

            // Hacer el update para guardar cambios
            update_traslado : function() {
                // console.log('guardando...');
                id = this.op_id_producto_tienda;                
                const params = new URLSearchParams();

                if(this.op_productos !== null) {
                    params.append('producto_id', this.op_productos);
                }
                if(this.op_tienda_id !== null) {
                    params.append('tienda_id', this.op_tienda_id);
                }
                if(this.op_tienda_destino_id !== null) {
                    params.append('tienda_destino_id', this.op_tienda_destino_id);
                }
                if(this.op_cantidad_productos !== null) {
                    params.append('cantidad_productos', this.op_cantidad_productos);
                }
                // const config = { headers: {'Content-Type': 'application/json'} };
                axios
                    .put('<?=base_url('rest-traslados')?>/' + id, params)
                    .then(
                        response => {
                            // this.info.push(response.data.data);
                            // UIkit.modal("#modal-container").hide();

                            // console.log(response.data);

                            if(response.data.code === 500) {
                                // console.log(response.data.msj);
                                this.errores = response.data.msj;
                            } else {
                                axios
                                    .get('<?=base_url('rest-traslados')?>')
                                    .then(response => (this.info = response.data.data));
                                axios
                                    .get('<?=base_url('rest-stock')?>')
                                    .then(response => (this.stocks = response.data.data));
                                this.errores = null;
                                UIkit.modal("#modal-container").hide();
                            }
                        }
                    );
            },

            // Al presionar el botón de nuevo
            nuevo_traslado : function() {
                var modal = UIkit.modal("#modal-container").show();
                axios
                    .get('<?=base_url('rest-traslados')?>/tiendas')
                    .then(response => (this.tiendas = response.data.data));
                axios
                    .get('<?=base_url('rest-traslados')?>/productos')
                    .then(response => (this.productos = response.data.data));

                axios
                    .get('<?=base_url('rest-stock')?>')
                    .then(response => (this.stocks = response.data.data));
                
                this.action = null;
                this.errores = null;
                this.op_productos = "";
                this.op_cantidad_productos = "";
                this.op_tienda_id = "";
                this.op_tienda_destino_id = "";
                this.searchProduct2 = "";
                
            },

            agregar_traslado : function() {
                
                const params = new URLSearchParams();

                if(this.op_productos !== null) {
                    params.append('producto_id', this.op_productos);
                }
                if(this.op_tienda_id !== null) {
                    params.append('tienda_id', this.op_tienda_id);
                }
                if(this.op_tienda_destino_id !== null) {
                    params.append('tienda_destino_id', this.op_tienda_destino_id);
                }
                if(this.op_cantidad_productos !== null) {
                    params.append('cantidad_productos', this.op_cantidad_productos);
                }

                axios
                    .post('<?=base_url('rest-traslados')?>', params)
                    .then(
                        response => {
                            // this.info.push(response.data.data);
                            // UIkit.modal("#modal-container").hide();

                            // console.log(response.data);
                            if(response.data.code === 500) {
                                // console.log(response.data.msj);
                                this.errores = response.data.msj;
                            } else {
                                //this.info.push(response.data.data);
                                axios
                                    .get('<?=base_url('rest-traslados')?>')
                                    .then(response => (this.info = response.data.data));
                                this.errores = null;
                                UIkit.modal("#modal-container").hide();
                                // console.log(response.data.data);
                            }
                        }
                    );
            },
            
            agregar_traslado2 : async function() {
                
                const params = new URLSearchParams();

                if(this.op_productos3 !== null) {
                    params.append('producto_id', this.op_productos3);
                }
                if(this.op_tienda_id !== null) {
                    params.append('tienda_id', this.op_tienda_id);
                }
                if(this.op_tienda_destino_id !== null) {
                    params.append('tienda_destino_id', this.op_tienda_destino_id);
                }
                if(this.op_cantidad_productos !== null) {
                    params.append('cantidad_productos', this.op_cantidad_productos);
                }

                await axios
                    .post('<?=base_url('rest-traslados')?>', params)
                    .then(
                        response => {
                            if(response.data.code === 500) {
                                this.errores = response.data.msj;
                                console.log(response.data.msj);
                            } else {
                                axios
                                    .get('<?=base_url('rest-traslados')?>')
                                    .then(response => {
                                        this.info = response.data.data
                                    })
                                this.errores = null;
                            }
                        }
                    );
                this.searchProduct3 = null;
                this.op_productos3  = null;
                this.op_stock2      = null;

            },

            onChange : function(event)  {
                // console.log('producto: ' + this.op_productos);
                // console.log('tienda: ' + this.op_tienda_id);
                for(st of this.stocks) {
                    if(this.op_productos === st.producto_id && this.op_tienda_id === st.tienda_id) {
                        return this.op_stock = st.stock;
                        // return console.log(this.op_stock);
                    } 
                    this.op_stock = 0;
                }
            },

            onChange2 : async function(event)  {
                // Get all stocks
                let self = this;
                this.cargando = true;
                self.stocks2 = null; 
                await axios
                    .get('<?=base_url('rest-stock')?>')
                    .then(response => (self.stocks2 = response.data.data));
                
                // Get all stocks of the product3
                const stockTienda = self.stocks2.filter(
                    s => (s.producto_id === self.op_productos3 && s.tienda_id === self.op_tienda_id)
                )


                if(stockTienda.length > 0) {
                    stockTienda.forEach(s => {
                        if( self.op_productos3 === s.producto_id && 
                            self.op_tienda_id === s.tienda_id) 
                        {
                            return self.op_stock2 = s.stock;
                        } 
                        self.op_stock2 = 0;
                    })
                } else {
                    self.op_stock2 = 0;
                };
                self.cargando = false;
                
            },

            limpiarFiltro: function() {
                this.valorProducto = null;
                this.valorTienda = null;
                this.codBarra = null;
                this.searchProduct = null;
            }

        },

        filters: {
            fechaSinHora: function(value) {
                if(!value) return '';
                return moment(String(value)).format('DD/MM/YYYY');
            }
        },

        async mounted () {
            this.cargar = true;
            await axios
            .get('<?=base_url('rest-traslados')?>')
            .then(response => (this.info = response.data.data));

            await axios
            .get('<?=base_url('rest-stock')?>')
            .then(response => (this.stocks = response.data.data));

            await axios
            .get('<?=base_url('rest-traslados/productos')?>')
            .then(response => (this.options = response.data.data));

            await axios
                .get('<?=base_url('rest-traslados/tiendas')?>')
                .then(response => (this.tiendas = response.data.data));

            await axios
                .get('<?=base_url('rest-traslados/productos')?>')
                .then(response => {
                    this.productos2  = response.data.data
                });
            
            await this.getAllInfo();

            this.cargar = false;

        }
    });
</script>

<?= $this->endSection();?>