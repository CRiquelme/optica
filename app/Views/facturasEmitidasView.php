<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Facturas emitidas
<?= $this->endSection();?>

<!-- Contenido de la página -->
<?= $this->section('page_content'); ?>

<section id="facturasEmitidas">

  <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
    <!-- Formularios -->
    <div class="uk-width-1-4 uk-margin-large-bottom">
      <form class="uk-card uk-card-default uk-card-body">
        <h2 class="text-xl font-bold mb-5 uppercase">
          Nuevo Registro
        </h2>
        <fieldset class="uk-fieldset">
          <!-- Botones -->
          <div class="uk-margin">
            <button 
              class="uk-button uk-button-primary uk-width-1-1" 
              type="button" 
              @click="showEditarFacturas=true">
                Nuevo
            </button>
          </div>
        </fieldset>
      </form>
      <!-- Filtros -->
      <div class="uk-card uk-card-default uk-card-body uk-margin-medium-top">
        <h2 class="uk-text-uppercase">FILTROS</h2>
          
          <div class="uk-margin">
            <label class="uk-form-label">Estado</label>
            <div class="uk-form-controls">
              <select v-model="selected_estado" class="uk-select">
                <option value="Todos">Todos</option>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
              </select>
            </div>
          </div>
        
        <button @click="limpiarFiltro" class="uk-button uk-button-secondary uk-margin-medium-top uk-align-center">Limpiar filtros</button>
      </div>
    </div>
    <!-- Tabla -->
    <div class="uk-width-3-4" uk-grid>
      <table class="uk-table uk-table-divider uk-table-striped uk-table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Factura No</th>
            <th>Monto</th>
            <th>Estado</th>
            <th class="uk-text-center">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <tr 
            v-for="(f, n) in facturasEmitidas" 
            :key="n" 
          >
            <td>
              <button class="uk-button uk-button-link uk-text-success uk-text-bolder" @click="seleccionar(n)">
                <i class="far fa-edit uk-margin-small-left uk-text-success"></i> id
              </button>
            </td>
            <td> {{ f.id_factura_emitida }} </td>
            <td>${{ new Intl.NumberFormat("es-CO").format(f.monto)  }}</td>
            <td > <!-- {{f.anula_Factura  }} --> {{ estados[f.anula_factura] }} </td>
            <td class="uk-text-center">
              <i class="fas fa-trash-alt cursor-pointer text-red-500" @click="borrar(f.id_factura_emitida)" ></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Editar -->
    <div 
      v-if="showEditarFacturas"
      class=" bg-gray-900 absolute bg-opacity-50 w-full h-full top-0 left-0 p-10 " style="">
      <div class=" bg-white px-2">
        <div class="w-full flex justify-end p-2">
          <i 
            class="fas fa-times text-2xl cursor-pointer" 
            @click="limpiar()"></i>
        </div>
        <div class="px-20 pb-10">
          <h1 class=" text-3xl">EDITAR FACTURAS EMITIDAS</h1>
          <div class="grid grid-cols-2 gap-4">
            <!-- Columna1 -->
            <div>
              <!-- Id Registro -->
              <div >
                <label class="uk-form-label">Id Registro</label>
                <input  
                  disabled
                  v-model="id_factura_emitida"
                  class="uk-input" 
                  type="text">
              </div>
              <!-- Número Factura -->
              <div class="">
                <label class="uk-form-label">Número Factura</label>
                <input  
                  v-model="numero_factura"
                  class="uk-input" 
                  type="text" 
                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                  placeholder="0000">
              </div>
              <!-- Cliente ID -->
              <div>
                <label class="uk-form-label">Cliente ID</label>
                <input  
                  list="listaClientes"
                  v-model="cliente_id"
                  class="uk-input" 
                  type="text" 
                  placeholder="00">
                <datalist id="listaClientes">
                  <option 
                    v-for="(i,n) in clientes_empresas"
                    :key="n"
                    :value="i.nombre+' - ID: '+i.id_cliente_empresa"/>
                <datalist/>
              </div>
              <!-- Tiendas ID -->
              <div class="">
                <label class="uk-form-label">Tiendas ID</label>
                <div class="uk-form-controls">
                  <select v-model="tienda_id" class="uk-select">
                    <option 
                    v-for="(i,n) in tiendas"
                    :key="n"
                    :value="i.id_tienda">
                      {{ i.nombre_tienda }} - ID: {{ i.id_tienda }}
                    </option>
                  </select>
                </div>
              </div>
              <!-- Fecha Vencimiento-->
              <div class="">
                <label class="uk-form-label">Fecha Vencimiento</label>
                <input  
                  v-model="fecha_vencimiento"
                  class="uk-input"
                  type="date" 
                  min="2010-01-01"
                  max="2030-01-01"
                  >
              </div>
              <!-- Monto -->
              <div>
                <label class="uk-form-label">Monto</label>
                <input  
                  v-model="monto"
                  class="uk-input" 
                  type="text" 
                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')"
                  placeholder="$0.00">
              </div>
            </div>
            <!-- Columna2 -->
            <div>
              <!-- Estado -->
              <div class="">
                <label class="uk-form-label">Estado</label>
                <div class="uk-form-controls">
                  <select v-model="estado" class="uk-select">
                    <option v-for="(e,n) in estados" 
                      :key=n
                      :value=n> {{ e }} </option>
                  </select>
                </div>
              </div>
              <!-- Nota Crédito -->
              <div class="" >
                <label class="uk-form-label">Nota Crédito</label>
                <input  
                  v-model="nc"
                  class="uk-input" 
                  type="text" 
                  placeholder="0000"
                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
              </div>
              <!-- Fecha Emisión-->
              <div class="">
                <label class="uk-form-label">Fecha Emisión</label>
                <input  
                  v-model="fecha_emision"
                  class="uk-input"
                  type="date" 
                  min="2010-01-01"
                  max="2030-01-01"
                  >
              </div>
              <!-- Fecha recepción-->
              <div class="">
                <label class="uk-form-label">Fecha recepción</label>
                <input  
                  v-model="fecha_recibo_documento"
                  class="uk-input"
                  type="date" 
                  min="2010-01-01"
                  max="2030-01-01"
                  >
              </div>
              <!-- Forma de Pago -->
              <div class="">
                <label class="uk-form-label">Forma de Pago</label>
                <div class="uk-form-controls">
                  <select v-model="estado" class="uk-select">
                    <option value=0>Transferencia</option>
                    <option value=1>Cheque</option>
                    <option value=2>Efectivo</option>
                    <option value=3>Otra</option>
                  </select>
                </div>
              </div>
              <!-- Número Documento -->
              <div class="">
                <label class="uk-form-label">Número Documento</label>
                <input 
                  v-model="numero_documento" 
                  class="uk-input" 
                  type="text" 
                  placeholder="0000"
                  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
              </div>
              <!-- Comentario -->
              <div>
                <label class="uk-form-label">Comentario</label>
                <input  
                  v-model="comentario"
                  class="uk-input" 
                  type="text" 
                  placeholder="Comentario">
              </div>
            </div>
          </div>
          <!-- Botones -->
          <div>
            <button
              @click="limpiar()" 
              class="uk-button uk-button-danger mt-2" type="button"  >Cancelar</button>
            <button 
              class="uk-button uk-button-primary mt-2" 
              type="button"
              @click="agregar"
                >Guardar</button>
          </div>
        </div>
      </div>
    </div>
  </article>
</section>

<script>
<<<<<<< HEAD
var app = new Vue({
    el      : '#facturasEmitidas',
    data () {
        return {

        }
    },
    created () {
        console.log('hola')
    }
});
||||||| merged common ancestors
=======
var app = new Vue({
    el      : '#facturasEmitidas',
    data () {
        return {
          id_factura_emitida:null,
          numero_factura: "",
          cliente_id: null,
          tienda_id: null,
          monto: null,
          comentario:"",
          estado:0,
          nc:0,
          fecha_vencimiento: "",
          fecha_emision: "",
          fecha_recibo_documento:"",
          numero_documento: "",

          facturasEmitidas:[],
          clientes_empresas:[],
          tiendas:[],
          estados:[
            "Emitida",
            "Pagada",
            "Anulada",
          ],

          showEditarFacturas:false,
          errores:null,
        }
    },
    
    created () {
      this.cargarClientes_empresas()
      this.cargarTiendas()
      this.cargarFacturasEmitidas()
    },
    methods: {
      async cargarClientes_empresas(){
        await axios
          .get('<?=base_url('rest-clientes-empresas')?>')
          .then(r=>{
            this.clientes_empresas=r.data.data
          })
          .catch(e=>console.error(e))
      },
      cargarTiendas(){
        axios
          .get('<?=base_url('rest-traslados/tiendas')?>')
          .then(r=>{
            this.tiendas=r.data.data
          })
          .catch(e=>console.error(e))
      },
      cargarFacturasEmitidas(){
        axios
          .get('<?=base_url('rest-facturas-emitidas')?>')
          .then(r=>{
            this.facturasEmitidas=r.data.data
          })
          .catch(e=>console.error(e))
      },
      agregar(){
        this.errores=null
        if(!this.monto){this.errores="Digita un monto para la factura."}
        if(!this.fecha_vencimiento){this.errores="Selecciona una fecha de vencimiento."}
        if(!this.cliente_id){this.errores="Cliente ID no puede estar vacío."}
        if(!this.tienda_id){this.errores="Tienda ID no puede estar vacío."}
        
        if(this.errores){
          this.alertarError(this.errores,'error')
          return;
        }
        const params = new URLSearchParams();
        if(this.numero_factura){
          params.append('numero_factura',this.numero_factura)
        }
        params.append(
          'cliente_id',
          this.formatoClienteID(this.cliente_id)
        )
        params.append('tienda_id',this.tienda_id)

        params.append('monto',this.monto) 
        params.append('nc',this.nc) 
        params.append('comentario',this.comentario)
        params.append('anula_factura',this.estado)
        params.append('fecha',this.fecha_vencimiento)
        params.append('fecha_emision',this.fecha_emision)
        params.append('fecha_recibo_documento',this.fecha_recibo_documento)
        if(this.numero_documento){
          params.append('numero_documento',this.numero_documento)
        }

        if(!this.id_factura_emitida){
          /* Agregar Nuevo */
          axios
            .post('<?=base_url('rest-facturas-emitidas')?>', params)
            .then(
              response => {
              if(response.data.code === 500) {
                console.error(response.data.msj)
                this.alertarError("Hubo un problema, intenta nuevamente",'error')
              }else{
                this.cargarFacturasEmitidas()
                this.limpiar()
                this.alertarError("Registro de factura realizado con éxito.","success")
              }
            })
        }else{
          /* Editar Existente */
          console.log("empezó a editar")
          console.log(this.id_factura_emitida)
          axios
            .put('<?=base_url('rest-facturas-emitidas')?>/' + this.id_factura_emitida, params)
            .then(
              response => {
              if(response.data.code === 500) {
                console.error(response.data.msj)
                this.alertarError("Hubo un problema, intenta nuevamente",'error')
              }else{
                this.cargarFacturasEmitidas()
                this.limpiar()
              }
            })
        }
      },
      borrar(id){
        Swal.fire({
            title: '¿Está seguro que desea eliminarlo?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, quiero eliminarlo',
            cancelButtonText: 'No, cancelar',
            cancelButtonColor: '#3085d6',
            confirmButtonColor: '#d33',
            reverseButtons: true
        }).then(r=>{
          if(r.value){
            axios.delete('<?=base_url('rest-facturas-emitidas')?>/' + id)
              .then(()=>{this.cargarFacturasEmitidas()})
          }
        })
      },
      async seleccionar(n){
        await this.cargarClientes_empresas()
        this.showEditarFacturas=true
        const idCliente=this.facturasEmitidas[n].cliente_id
        const nombreCliente=this.clientes_empresas.filter(c=>c.id_cliente_empresa===idCliente)[0].nombre

        this.id_factura_emitida=this.facturasEmitidas[n].id_factura_emitida
        this.numero_factura=this.facturasEmitidas[n].numero_factura
        this.cliente_id=nombreCliente +' - ID: '+ idCliente
        this.tienda_id=this.facturasEmitidas[n].tienda_id
        this.monto=this.facturasEmitidas[n].monto
        this.comentario=this.facturasEmitidas[n].comentario
        this.estado=this.facturasEmitidas[n].anula_factura
        this.fecha_vencimiento=this.facturasEmitidas[n].fecha
        this.fecha_emision=this.facturasEmitidas[n].fecha_emision
        this.fecha_recibo_documento=this.facturasEmitidas[n].fecha_recibo_documento
        this.numero_documento=this.facturasEmitidas[n].numero_documento
      },
      formatoClienteID(val){
        if(val.split(" - ID: ")[1]){
          return val.split(" - ID: ")[1]
        }else{
          /* Crear nuevo cliente si no existe */
          return val
        }
      },
      alertarError(title,icon){
        Swal.fire({
            position: 'top-end',
            icon: icon,
            title: title,
            showConfirmButton: false,
            timer: 1500
        })
      },
      limpiar(){
        this.showEditarFacturas=false

        this.id_factura_emitida=null
        this.numero_factura= null
        this.cliente_id= null
        this.tienda_id= null
        this.monto= null
        this.comentario=null
        this.estado=0
        this.fecha_vencimiento= null
        this.fecha_emision= null
        this.fecha_recibo_documento=null
        this.numero_documento= 0
      },
      limpiarFiltro(){

      },
      selected_estado(){

      }
    }
});
>>>>>>> c8483cc7470e7d2d3300e4521c958b01fb947511

</script>

<?= $this->endSection();?>