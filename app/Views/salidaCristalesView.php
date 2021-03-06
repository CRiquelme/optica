<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Cristales
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
<section id="cristales">
    <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
        <titulo class="text-4xl"></titulo>
    </article>

    <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
        <div class="uk-width-1-4 uk-margin-large-bottom">
            <form class="uk-card uk-card-default uk-card-body">
                <h2 class="uk-text-uppercase">Salida de cristales</h2>
                <fieldset class="uk-fieldset">
                    <div class="uk-margin">
                        <label class="uk-form-label" for="cajon">Cajón</label>
                        <input v-model="op_cajon" class="uk-input" id="cajon" name="cajon" type="text" placeholder="Nombre del cajón">
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
                        <label class="uk-form-label" for="material">Material</label>
                        <input v-model="op_material" class="uk-input" id="material" name="material" type="text" placeholder="Material">
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="potencia1">Potencia 1</label>
                        <input v-model="op_potencia1" class="uk-input" id="potencia1" name="potencia1" type="text" placeholder="Potencia 1">
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="potencia2">Potencia 2</label>
                        <input v-model="op_potencia2" class="uk-input" id="potencia2" name="potencia2" type="text" placeholder="Potencia 2">
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="cantidad">Cantidad</label>
                        <input v-model="op_cantidad" class="uk-input" id="cantidad" name="cantidad" type="number" placeholder="Cantidad" :min="1" autocomplete="off">
                    </div>

                    
                    <div class="uk-margin" v-if="op_cajon && op_material && op_potencia1 && op_potencia2 && op_cantidad && action === 'editar'">
                        <button class="uk-button uk-button-primary" type="button" @click="update_ingreso()">Editar</button>
                        <button class="uk-button uk-button-secondary" type="button" @click="limpiar_form()">Limpiar</button> 
                    </div>
                    <div class="uk-margin" v-else-if="op_cajon && op_material && op_potencia1 && op_potencia2 && op_cantidad">
                        <button class="uk-button uk-button-primary uk-width-1-1" type="button" @click="agregar()">Guardar</button>
                    </div>
                </fieldset>
            </form>

            <div class="uk-card uk-card-default uk-card-body uk-margin-medium-top">
                <h2 class="uk-text-uppercase">FILTROS</h2>
                <label>Cajón</label>
                <v-select 
                    :options="listaCajonesUnicos" 
                    label="cajon" 
                    :value="selected" 
                    v-model="valorCajon"
                    class="uk-form-width-large uk-width-1-1@m"
                >
                    <span slot="no-options">No hay datos para su búsqueda.</span>
                </v-select>
                <button @click="limpiarFiltro" class="uk-button uk-button-secondary uk-margin-medium-top uk-align-center">Limpiar filtros</button>
            </div>
        </div>

        <div class="uk-width-3-4" uk-grid>
            
            <div v-if="cargar" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

            <table v-else class="uk-table uk-table-divider uk-table-striped uk-table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cajón</th>
                        <th>Tienda</th>
                        <th>Material</th>
                        <th>Potencia 1</th>
                        <th>Potencia 2</th>
                        <th>Cantidad salida</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- {{valorTienda}} -->
                    <tr 
                        v-for="(ingresos, idinfo) in info" 
                        :key="ingresos.id_cristal" 
                        v-if="(ingresos.cajon === valorCajon || !valorCajon)"
                    >
                        <td>
                            <button class="uk-button uk-button-link uk-text-success uk-text-bolder" @click="editar_ingreso(idinfo, ingresos.id_cristal)">
                                <i class="far fa-edit uk-margin-small-left uk-text-success"></i> {{ ingresos.id_cristal }}
                            </button>
                        </td>
                        <td>{{ ingresos.cajon }}</td>
                        <td>{{ ingresos.nombre_tienda }}</td>
                        <td>{{ ingresos.material }}</td>
                        <td>{{ ingresos.potencia1 }}</td>
                        <td>{{ ingresos.potencia2 }}</td>
                        <td>{{ ingresos.cantidad }}</td>
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
            return { titulo: 'Cristales' }
        }
    });

    var app = new Vue({
        el      : '#cristales',
        data () {
            return {
                info: null,
                infoedit: null,
                op_cajon: null,
                op_material: null,
                op_potencia1: null,
                op_potencia2: null,
                op_cantidad: null,
                op_tienda_id: 1,
                action: null,
                valorCajon: null,
                selected: 1,
                listaCajones: [],
                listaCajonesUnicos: [],
                id_cristal: null,
                cargar: true,
                tiendas: [],
            }
        },
        methods: {
            agregar: function() {
                const params = new URLSearchParams();

                if(this.op_cajon !== null) {
                    params.append('cajon', this.op_cajon);
                }
                if(this.op_material !== null) {
                    params.append('material', this.op_material);
                }
                if(this.op_potencia1 !== null) {
                    params.append('potencia1', this.op_potencia1);
                }
                if(this.op_potencia2 !== null) {
                    params.append('potencia2', this.op_potencia2);
                }
                if(this.op_cantidad !== null) {
                    params.append('cantidad', this.op_cantidad);
                }
                axios
                    .post('<?=base_url('rest-cristales')?>', params)
                    .then(
                        response => {
                            console.log(response.data);
                            if(response.data.code === 500) {
                                console.log(response.data.msj);
                                this.errores = response.data.msj;
                            } else {
                                axios
                                    .get('<?=base_url('rest-cristales')?>')
                                    .then(response => (this.info = response.data.data));
                                this.errores        = null;
                                this.op_cajon       = null;
                                this.op_material    = null;
                                this.op_potencia1   = null;
                                this.op_potencia2   = null;
                            }
                        }
                    );
                Swal.fire({
                    position: 'top-end',
                    title: 'Ingreso de cristal registrado',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
            }, // agregar
            limpiarFiltro: function() {
                this.valorCajon  = null
            },
            editar_ingreso : function(index, id_cristal) {
                this.action     = 'editar'
                this.errores    = null;
                this.id_cristal = id_cristal;
                
                axios
                .get('<?=base_url('rest-cristales')?>/' + id_cristal)
                .then(response => (
                        this.infoedit       = response.data,
                        this.op_cajon       = response.data.data.cajon,
                        this.op_tienda_id   = response.data.data.tienda_id,
                        this.op_material    = response.data.data.material,
                        this.op_potencia1   = response.data.data.potencia1,
                        this.op_potencia2   = response.data.data.potencia2,
                        this.op_cantidad    = response.data.data.cantidad
                    ));
            },
            update_ingreso: function() {
                console.log('guardando...');
                id = this.id_cristal;

                const params = new URLSearchParams();
                if(this.op_cajon !== null) {
                    params.append('cajon', this.op_cajon);
                }
                if(this.op_tienda_id !== null) {
                    params.append('tienda_id', this.op_tienda_id);
                }
                if(this.material !== null) {
                    params.append('material', this.op_material);
                }
                if(this.op_potencia1 !== null) {
                    params.append('potencia1', this.op_potencia1);
                }
                if(this.op_potencia2 !== null) {
                    params.append('potencia2', this.op_potencia2);
                }
                if(this.op_cantidad !== null) {
                    params.append('cantidad', this.op_cantidad);
                }
                axios
                    .put('<?=base_url('rest-cristales')?>/' + id, params)
                    .then(
                        response => {
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
                                    .get('<?=base_url('rest-cristales')?>')
                                    .then(response => (this.info = response.data.data));
                                this.errores = null;

                                Swal.fire({
                                    position: 'top-end',
                                    title: 'Cristal actualizado',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        }
                    );
            },
            limpiar_form: function() {
                this.op_cajon  = null,
                this.op_material = null,
                this.op_potencia1 = null,
                this.op_potencia2 = null,
                this.op_cantidad = null

            },
            delete_ingreso: function(index, id) {
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
                            axios.delete('<?=base_url('rest-cristales')?>/' + id)
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
            }
        },
        created () {
            axios
                .get('<?=base_url('rest-cristales')?>')
                .then(response => (this.info = response.data.data))
                .then(response => ( 
                                    this.listaCajones = this.info.map(c => c.cajon),
                                    this.listaCajonesUnicos = [...new Set(this.listaCajones)] 
                                ) )
                .then(response => (this.cargar = false))
            
            axios
                .get('<?=base_url('rest-traslados/tiendas')?>')
                .then(response => (this.tiendas = response.data.data));
        }


    });
</script>
<?= $this->endSection();?>