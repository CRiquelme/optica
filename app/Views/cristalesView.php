<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Cristales
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
<section id="cristales">
	<article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
		<titulo class="text-4xl"></titulo>
	</article>

	<article class="m-10">
		<div class="grid md:grid-cols-5 gap-4">
			<div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
					<form class="uk-card uk-card-default uk-card-body">
							<h2 class="text-xl font-bold mb-5 uppercase">Nuevo cristal</h2>
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
			</div>

			<div class="md:row-span-1 md:col-span-4">
					
				<div v-if="cargar" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

				<table v-if="!cargar" class="uk-table uk-table-divider uk-table-striped uk-table-hover" id="table_cristales">
						<thead>
								<tr>
										<th>ID</th>
										<th>Cajón</th>
										<th>Tienda</th>
										<th>Material</th>
										<th>Potencia 1</th>
										<th>Potencia 2</th>
										<th>Cantidad</th>
										<th class="uk-text-center">Opciones</th>
								</tr>
						</thead>
						<tbody>
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
										<td class="uk-text-center">
												<i class="fas fa-trash-alt cursor-pointer text-red-500" @click="delete_ingreso(idinfo, ingresos.id_cristal)" title="Borrar cristal"></i>

												<i class="fas fa-sign-out-alt ml-5 cursor-pointer text-green-800" @click="salida(idinfo, ingresos.id_cristal, ingresos.tienda_id, ingresos.cantidad)" title="Registrar salida"></i>

												<i class="fas fa-reply-all ml-5 cursor-pointer text-orange-800" title="Deshacer última salida" @click="deshacer(ingresos.id_cristal, ingresos.cajon, ingresos.tienda_id, ingresos.material, ingresos.potencia1, ingresos.potencia2, ingresos.cantidad)"></i>
										</td>
								</tr>
						</tbody>
				</table>

				<h2 v-if="!cargar" class="text-2xl">Resumen de cristales</h2>

				<table v-if="!cargar" class="uk-table uk-table-divider uk-table-striped uk-table-hover" id="resumen_cristales">
					<thead>
						<tr>
							<th>Material</th>
							<th>Potencia 1</th>
							<th>Potencia 2</th>
							<th>Cajón</th>
							<th>Tienda</th>
							<th>Cantidad</th>
						</tr>
					</thead>
					<tbody>
						<tr 
							v-for="(resumen, idResumen) in resumenCristales" 
							:key="resumen.id_cristal" 
						>
							<td>{{ resumen.material }}</td>
							<td>{{ resumen.potencia1 }}</td>
							<td>{{ resumen.potencia2 }}</td>
							<td>{{ resumen.cajon }}</td>
							<td>{{ resumen.nombre_tienda }}</td>
							<td>{{ resumen.cantidad_cristales }}</td>
						</tr>
					</tbody>
				</table>

			</div>
		</div>
	</article>

</section>

<script>
    Vue.component('v-select', VueSelect.VueSelect);

    Vue.component('titulo', {
        template: '<h1 class="uppercase">{{titulo}}</h1>',
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
						ultimo: [],
						errores: null,
						resumenCristales: null
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
														axios
															.get('<?=base_url('resumen-cristales')?>')
															.then(response => (this.resumenCristales = response.data.data));
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

            salida : function(index, id_cristal, tienda_id, stock) {
                Swal.mixin({
                    input: 'text',
                    confirmButtonText: 'Siguiente &rarr;',
                    showCancelButton: true
                }).queue([
                "Cantidad de salida"
                ]).then((result) => {
                    if (result.value) {
                        const params = new URLSearchParams();
                        const answers = JSON.stringify(result.value)
                        params.append('cristal_id', id_cristal);
                        params.append('tienda_id', tienda_id);
                        params.append('stock', stock);
                        params.append('cantidad', result.value[0]);
                        console.log(`id_cristal ${id_cristal} tienda_id ${tienda_id} stock ${stock} result.value[0] ${result.value[0]}`)

                        if(result.value[0] <= stock) {
                            axios
                            .post('<?=base_url('rest-salida-cristales')?>', params)
                            .then(
                                response => {
                                    console.log(response.data);

                                    if(response.data.code === 500) {
                                        console.log(response.data.msj);
                                        this.errores = response.data.msj;
                                        Swal.fire({
                                            title: 'Salida no actualizada',
                                            icon: 'error',
                                            confirmButtonText: 'Confirmar'
                                        });
                                        console.log(this.errores)
                                    } else {
                                        axios
                                            .get('<?=base_url('rest-cristales')?>')
                                            .then(response => (this.info = response.data.data));
                                        this.errores = null;

                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'La salida fue guardada.',
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                    }
                                }
                            );
                        } else {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: 'La salida debe ser menor o igual que el stock.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                })
            },

            deshacer: function(id_cristal, cajon, tienda_id, material, potencia1, potencia2, stock) {
                axios
                .get('<?=base_url('rest-salida-cristales/ultimo')?>/'+id_cristal)
                .then(response =>  {
                    let ultCantidad = response.data.data[0].cantidad;
                    let ultId = response.data.data[0].id_cristal_salida;
                    let ultCreacion = response.data.data[0].created_at;
                    
                    let nuevoStock = parseInt(ultCantidad) + parseInt(stock);

                    const params = new URLSearchParams();

                    params.append('id_cristal', id_cristal);
                    params.append('cajon', cajon);
                    params.append('tienda_id', tienda_id);
                    params.append('material', material);
                    params.append('potencia1', potencia1);
                    params.append('potencia2', potencia2);
                    params.append('cantidad', nuevoStock);

                        Swal.fire({
                            title: '¿Quiere deshacer la última salida registrada?',
                            html:   'Última cantidad registrada ' + ultCantidad +
                                    '<br>Al eliminarlo se sumará a la cantidad actual.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                axios.delete('<?=base_url('rest-salida-cristales')?>/' + ultId)
                                    .then(response => {
                                        axios
                                            .get('<?=base_url('rest-cristales')?>')
                                            .then(response => (this.info = response.data.data))
                                    });
                                
                                axios.put('<?=base_url('rest-cristales')?>/' + id_cristal, params)
                                    .then( )
                            }
                        })
                });
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
                Swal.fire({
                    title: '¿Está seguro que desea eliminarlo?',
                    // text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, quiero eliminarlo',
                    cancelButtonText: 'No, cancelar',
                    cancelButtonColor: '#3085d6',
                    confirmButtonColor: '#d33',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        axios.delete('<?=base_url('rest-cristales')?>/' + id)
                        .then(response => {
                            this.info.splice(index, 1);
                            
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'El ingreso fue eliminado.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        });
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            title: 'El ingreso se mantiene.',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });
            }
        },
        created () {
					axios
							.get('<?=base_url('rest-cristales')?>')
							.then(response => {
									this.info = response.data.data
									$(function() {
											let table = $('#table_cristales').DataTable( 
													{
														"order": [ 0, "desc" ],
														"info": false,
														"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
														"infoFiltered": "(filtrado de un total de _MAX_ registros)",
														"language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
													}
											)
									});
							})
							.then(response => (this.cargar = false))
							
            
            axios
                .get('<?=base_url('rest-traslados/tiendas')?>')
                .then(response => (this.tiendas = response.data.data));

            axios
                .get('<?=base_url('resumen-cristales')?>')
                .then(response => {
                    this.resumenCristales = response.data.data
                    $(function() {
                        let table = $('#resumen_cristales').DataTable(
                            {
                                "order": [ 0, "desc" ],
                                "info": false,
                                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" },
                            }
                        )
                    })
                })
                .then(response => (this.cargar = false))
        }
    });
</script>
<?= $this->endSection();?>