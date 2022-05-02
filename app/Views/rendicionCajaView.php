<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Rendición de caja
<?= $this->endSection(); ?>

<?= $this->section('page_content'); ?>

<section class="m-10" id="sobre">
  <h1 class="text-4xl uppercase border-b-2 pb-5 border-gray-100 mb-4">Rendición de caja</h1>

  <div class="grid md:grid-cols-5 gap-4">
    <!-- <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
      <?//= $this->include('components/sidebar') ?>
    </div> -->

    <div class="md:row-span-1 md:col-span-5">
      <div v-if="cargarForm" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      <div class="flex justify-between">
        <!-- <h2 class="text-lg font-medium">Agregar registro</h2> -->

        <?php
          $labelClass = "block text-sm font-medium text-gray-700 uppercase";
          $inputClass = "block w-full p-2 | text-xs | font-bold | shadow-sm | border-b-2 border-gray-300 border-gray-200 rounded-sm | focus:outline-none focus:border-b-2 focus:border-gray-500";
          $textareaClass = "shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border px-2 py-2";
				?>

    </div>
    
    <div v-if="!cargarForm" class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-12" ref="formRendicionCaja">

      <input type="hidden" name="id_rendicion_caja" name="id_rendicion_caja" v-model="id_rendicion_caja">
      <div class="sm:col-span-4">
        <label class="<?= $labelClass ?>" for="fecha">fecha</label>
        <div class="mt-1">
          <input type="date" v-model="fecha" class="<?= $inputClass ?>" id="fecha" name="fecha" @change="getRendicionCaja">
        </div>
      </div>
      <div class="sm:col-span-4">
        <label class="<?= $labelClass ?>" for="rut">rut</label>
        <div class="mt-1">
          <input type="text" v-model="rut" class="<?= $inputClass ?>" id="rut" name="rut" @change="getName($event)">
        </div>
      </div>
      <div class="sm:col-span-4">
        <label class="<?= $labelClass ?>" for="nombreCliente">nombre de cliente</label>
        <div class="mt-1">
          <input type="text" v-model="nombreCliente" class="<?= $inputClass ?>" id="nombreCliente" name="nombreCliente">
        </div>
      </div>
      
      <!-- Folio -->
      <div class="sm:col-span-3">
        <label class="<?= $labelClass ?>" for="totalFolio">Total folio</label>
        <div class="mt-1">
          <input type="text" v-model="totalFolio" class="<?= $inputClass ?>" id="totalFolio" name="totalFolio" @change="updateSaldo($event)">
        </div>
      </div>
      
      <!-- <div class="sm:col-span-4">
        <label class="<?= $labelClass ?>" for="saldoFolio">
          Saldo folio <i class="fas fa-question-circle cursor-pointer text-sm" @click="getRendicionCaja()" uk-tooltip="title: Sumatoria de los abonos; pos: right"></i> <span v-if="oldSaldoFolio > 0">Ha pagado: {{oldSaldoFolio}}</span>
        </label>
        <div class="mt-1">
          <input type="text" v-model="saldoFolio" class="<?= $inputClass ?>" id="saldoFolio" name="saldoFolio" @change="updateSaldo($event)" disabled>
        </div>
      </div> -->
      
      <div class="sm:col-span-3">
        <label class="<?= $labelClass ?>" for="numeroFolio">Número folio</label>
        <div class="mt-1">
          <input type="text" v-model="numeroFolio" class="<?= $inputClass ?>" id="numeroFolio" name="numeroFolio">
        </div>
      </div>
      
      <div class="sm:col-span-3">
        <label class="<?= $labelClass ?>" for="n_voucher_efectivo">Número voucher efectivo</label>
        <div class="mt-1">
          <input type="text" v-model="n_voucher_efectivo" class="<?= $inputClass ?>" id="n_voucher_efectivo" name="n_voucher_efectivo">
        </div>
      </div>
      
      <div class="sm:col-span-3">
        <label class="<?= $labelClass ?>" for="n_voucher_tarjeta">Número voucher tarjeta</label>
        <div class="mt-1">
          <input type="text" v-model="n_voucher_tarjeta" class="<?= $inputClass ?>" id="n_voucher_tarjeta" name="n_voucher_tarjeta">
        </div>
      </div>

      <div class="sm:col-span-3">
        <label class="<?= $labelClass ?>" for="numeroBoleta">Número boleta</label>
        <div class="mt-1">
          <input type="text" v-model="numeroBoleta" class="<?= $inputClass ?>" id="numeroBoleta" name="numeroBoleta">
        </div>
      </div>
      
      <div class="sm:col-span-3">
        <label class="<?= $labelClass ?>" for="numeroOperacionTbk">Número operación TBK</label>
        <div class="mt-1">
          <input type="text" v-model="numeroOperacionTbk" class="<?= $inputClass ?>" id="numeroOperacionTbk" name="numeroOperacionTbk">
        </div>
      </div>

      <div class="sm:col-span-3">
        <label class="<?= $labelClass ?>" for="numeroGuiaDespacho">Número guía despacho</label>
        <div class="mt-1">
          <input type="text" v-model="numeroGuiaDespacho" class="<?= $inputClass ?>" id="numeroGuiaDespacho" name="numeroGuiaDespacho">
        </div>
      </div>

      <div class="sm:col-span-3">
        <label class="<?= $labelClass ?>" for="numeroFactura">Número factura</label>
        <div class="mt-1">
          <input type="text" v-model="numeroFactura" class="<?= $inputClass ?>" id="numeroFactura" name="numeroFactura">
        </div>
      </div>

      <!-- Pagos -->
      <div class="sm:col-span-2">
        <label class="<?= $labelClass ?>" for="efectivo">Efectivo</label>
        <div class="mt-1">
          <input type="text" v-model="efectivo" class="<?= $inputClass ?>" id="efectivo" name="efectivo" @change="updateSaldo($event)">
        </div>
      </div>
      
      <div class="sm:col-span-2">
        <label class="<?= $labelClass ?>" for="tbk">tbk</label>
        <div class="mt-1">
          <input type="text" v-model="tbk" class="<?= $inputClass ?>" id="tbk" name="tbk" @change="updateSaldo($event)">
        </div>
      </div>
      
      <div class="sm:col-span-2">
        <label class="<?= $labelClass ?>" for="cheques">cheques</label>
        <div class="mt-1">
          <input type="text" v-model="cheques" class="<?= $inputClass ?>" id="cheques" name="cheques" @change="updateSaldo($event)">
        </div>
      </div>
      
      <div class="sm:col-span-2">
        <label class="<?= $labelClass ?>" for="webpay">webpay</label>
        <div class="mt-1">
          <input type="text" v-model="webpay" class="<?= $inputClass ?>" id="webpay" name="webpay" @change="updateSaldo($event)">
        </div>
      </div>
      
      <div class="sm:col-span-2">
        <label class="<?= $labelClass ?>" for="tf">tf</label>
        <div class="mt-1">
          <input type="text" v-model="tf" class="<?= $inputClass ?>" id="tf" name="tf" @change="updateSaldo($event)">
        </div>
      </div>
      
      <div class="sm:col-span-2">
        <label class="<?= $labelClass ?>" for="oc">oc</label>
        <div class="mt-1">
          <input type="text" v-model="oc" class="<?= $inputClass ?>" id="oc" name="oc" @change="updateSaldo($event)">
        </div>
      </div>

      <!-- Saldo y guardar -->
      <div class="sm:col-span-4">
        <label class="<?= $labelClass ?>" for="saldo">
          saldo <i class="fas fa-question-circle cursor-pointer text-sm" @click="getRendicionCaja()" uk-tooltip="title: Diferencia entre total folio y abonos; pos: right"></i>
        </label>
        <div class="mt-1">
          <input type="text" v-model="saldo" class="<?= $inputClass ?>" id="saldo" name="saldo" disabled>
        </div>
      </div>

      <div class="sm:col-span-2">
        <label class="<?= $labelClass ?>" for="tbkSombra">tbk Sombra <i class="fas fa-question-circle cursor-pointer text-sm" @click="getRendicionCaja()" uk-tooltip="title: Sirve para cuadrar caja, luego hay que eliminarlo.; pos: right"></i></label>
        <div class="mt-1">
          <input type="text" v-model="tbkSombra" class="<?= $inputClass ?>" id="tbkSombra" name="tbkSombra">
        </div>
      </div>

      <div class="sm:col-span-2">
        <label>&nbsp;</label>
        <button
          v-if="!edit"
          class="uk-button uk-button-primary | w-full" 
          type="button" 
          @click="guardar()">
              Guardar
        </button>
        <button
          v-if="edit"
          class="uk-button uk-button-secondary | w-full" 
          type="button" 
          @click="guardar()">
              Editar
        </button>
      </div>
      <div class="sm:col-span-2">
        <label>&nbsp;</label>
        <button
          class="uk-button uk-button-secondary | w-full" 
          type="button" 
          @click="deleteTbkSombra()">
              Eliminar tbk sombra
        </button>
      </div>
      
    </div>
      
      <!-- Registro de sobres -->
      <div class="w-full | mt-3">
        <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">
          Registros de rendiciones de caja
          <i class="fas fa-sync cursor-pointer text-sm" @click="getRendicionCaja()" uk-tooltip="title: Refrescar la información; pos: right"></i>
        </h2>
        <div v-if="cargar" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        
        <table v-if="!cargar" class="uk-table uk-table-striped uk-table-hover" id="tableRendicionCaja">
          <thead>
            <tr>
              <th>#</th>
              <th>RUT</th>
              <th>N° Folio</th>
              <th>V. efec.</th>
              <th>V. tarj.</th>
              <th>N° boleta</th>
              <th>N° op. TBK</th>
              <th>N° guía desp.</th>
              <th>N° fact.</th>
              <th>Total Folio</th>
              <!-- <th>Saldo Folio</th> -->
              <th>Efec.</th>
              <th>tbk</th>
              <th>tbk sombra</th>
              <th>cheques</th>
              <th>webpay</th>
              <th>tf</th>
              <th>oc</th>
              <th>saldo</th>
              <th><i class="fas fa-trash-alt uk-margin-small-left"></i></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="rendicion in allRendiciones" :key="rendicion.id_rendicion_caja">
              <td class="text-xs">
                <a class="text-xs text-blue-900" @click="editar(rendicion.id_rendicion_caja)">{{rendicion.id_rendicion_caja}}</a>
              </td>
              <td class="text-xs">{{rendicion.rut}}</td>
              <td class="text-xs">{{rendicion.numero_folio}}</td>
              <td class="text-xs">{{rendicion.n_voucher_efectivo}}</td>
              <td class="text-xs">{{rendicion.n_voucher_tarjeta}}</td>
              <td class="text-xs">{{rendicion.numero_boleta}}</td>
              <td class="text-xs">{{rendicion.numero_operacion_tbk}}</td>
              <td class="text-xs">{{rendicion.numero_guia_despacho}}</td>
              <td class="text-xs">{{rendicion.numero_factura}}</td>
              <td class="text-xs">{{rendicion.total_folio | money}}</td>
              <!-- <td class="text-xs">{{rendicion.saldo_folio | money}}</td> -->
              <td class="text-xs">{{rendicion.efectivo | money}}</td>
              <td class="text-xs">{{rendicion.tbk | money}}</td>
              <td class="text-xs">{{rendicion.tbkSombra | money}}</td>
              <td class="text-xs">{{rendicion.cheques | money}}</td>
              <td class="text-xs">{{rendicion.webpay | money}}</td>
              <td class="text-xs">{{rendicion.tf | money}}</td>
              <td class="text-xs">{{rendicion.oc | money}}</td>
              <td class="text-xs">{{rendicion.saldo | money}}</td>
              <td>
                <a class="uk-button uk-button-link uk-text-danger uk-text-bolder" @click="eliminar(rendicion.id_rendicion_caja)">
                  <i class="fas fa-trash-alt uk-margin-small-left uk-text-danger"></i>
                </a>
              </td>
            </tr>
            <tr>
              <td class="bg-gray-200 font-bold" colspan="10">
                Total: 
                {{parseInt(totalEfectivo) + parseInt(totalTbk) + parseInt(totalTbkSombra) + parseInt(totalCheques) + parseInt(totalWebpay) + parseInt(totalTf) + parseInt(totalOc) | money}}
              </td>
              <td class="bg-gray-200 font-bold">{{totalEfectivo | money}}</td>
              <td class="bg-gray-200 font-bold">{{totalTbk | money}}</td>
              <td class="bg-gray-200 font-bold">{{totalTbkSombra | money}}</td>
              <td class="bg-gray-200 font-bold">{{totalCheques | money}}</td>
              <td class="bg-gray-200 font-bold">{{totalWebpay | money}}</td>
              <td class="bg-gray-200 font-bold">{{totalTf | money}}</td>
              <td class="bg-gray-200 font-bold">{{totalOc | money}}</td>
              <td class="bg-gray-200 font-bold">&nbsp;</td>
              <td class="bg-gray-200 font-bold">&nbsp;</td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>

</section>


<script>
const inputs = [
  "id_rendicion_caja",
  "fecha",
  "rut",
  "nombreCliente",
  "totalFolio",
  "saldoFolio",
  "numeroFolio",
  "n_voucher_efectivo",
  "n_voucher_tarjeta",
  "numeroBoleta",
  "numeroOperacionTbk",
  "numeroGuiaDespacho",
  "numeroFactura",
  "efectivo",
  "tbk",
  "tbkSombra",
  "cheques",
  "webpay",
  "tf",
  "oc",
  "saldo",
];

Vue.use(VueFormWizard);
Vue.component('v-select', VueSelect.VueSelect);

Vue.component('titulo', {
  template: '<h1 class="uk-text-uppercase uk-text-center">{{titulo}}</h1>',
  data: function() {
    return {
      titulo: 'Rendición de caja'
    }
  }
});

var app = new Vue({
  el: '#sobre',
  data() {
    <?php $uri = new \CodeIgniter\HTTP\URI(uri_string(true)); ?>
    return {
      cliente_id            : '<?= $uri->getSegment(2); ?>', // Capturar el id al cargar la pagina
      id_rendicion_caja     : '',
      cargar                : true,
      cargarForm            : true,
      edit                  : false,
      fecha                 : new Date().toJSON().slice(0,10),
      rut                   : '',
      nombreCliente         : '',
      totalFolio            : 0,
      saldoFolio            : 0,
      oldSaldoFolio         : 0,
      numeroFolio           : 0,
      n_voucher_efectivo    : 0,
      n_voucher_tarjeta     : 0,
      numeroBoleta          : 0,
      numeroOperacionTbk    : 0,
      numeroGuiaDespacho    : 0,
      numeroFactura         : 0,
      efectivo              : 0,
      tbk                   : 0,
      tbkSombra             : 0,
      cheques               : 0,
      webpay                : 0,
      tf                    : 0,
      oc                    : 0,
      oldEfectivo           : 0,
      oldTbk                : 0,
      oldTbkSombra          : 0,
      oldCheques            : 0,
      oldWebpay             : 0,
      oldTf                 : 0,
      oldOc                 : 0,
      saldo                 : 0,
      oldSaldo              : 0,
      allRendiciones        : [],
      totalIngresos         : 0,
    }
  },
  methods: {
    updateSaldo() {
      if(parseInt(this.oldSaldo) === 0) {
        this.saldo = parseInt(this.totalFolio) - (parseInt(this.efectivo) + parseInt(this.tbk) + parseInt(this.cheques) + parseInt(this.webpay) + parseInt(this.tf) + parseInt(this.oc));
      } else if(parseInt(this.oldSaldo) > 0) {
        this.saldo = parseInt(this.oldSaldo) - (parseInt(this.efectivo) + parseInt(this.tbk) + parseInt(this.cheques) + parseInt(this.webpay) + parseInt(this.tf) + parseInt(this.oc));
      }
    },

    async guardar() {
      console.log(this.id_rendicion_caja);
      if(this.id_rendicion_caja === '') {
        const params    = new URLSearchParams();

        this.fecha = moment(this.fecha).format('YYYY-MM-DD');

        inputs.forEach(input => {
          if (this[input] !== '') {
            params.append(`${input}`, this[input]);
          }
        });

        await axios
          .post('<?=base_url('rest-rendicion-caja')?>', params)
          .then(
            response => {
              if(response.data.code === 500) {
                  this.errores = response.data.msj;
              } else {
                // Limpiar los v-models de los inputs menos el cliente_id
                inputs.forEach(input => {
                  (input !== 'fecha') && (this[input] = 0);
                });

                this.rut                = '';
                this.nombreCliente      = '';
                this.id_rendicion_caja  = '';
                // this.cliente();
                this.getRendicionCaja();
                Swal.fire({
                    position          : 'top-end',
                    title             : 'Registro realizado',
                    icon              : 'success',
                    showConfirmButton : false,
                    timer             : 1500
                });
              }
            }
          );
          // this.salida();
      } else {
        this.updateRendicion();
        console.log('Actualizando...');
      }
    },

    getRendicionCaja() {
      this.cargar         = true;
      this.totalIngresos  = 0;
      let fecha   = moment(this.fecha).format('YYYY-MM-DD');
      axios.get('<?= base_url('rest-rendicion-caja') ?>/fecha/' + fecha)
        .then( response => {
            const { data } = response.data;
            this.allRendiciones   = data;
            this.cargar           = false;
            this.cargarForm       = false;
        });
      
      $(function() {
        $('#tableRendicionCaja').DataTable( 
          {
            "order": [ 0, "desc" ],
            "info": false,
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
          }
        )
      });
    },

    deleteTbkSombra() {
      this.tbkSombra  = 0;
      let fecha       = moment(this.fecha).format('YYYY-MM-DD');

      Swal.fire({
        title: 'Eliminar registro',
        text: "¿Desea eliminar tdk sombra (todas las de la fecha)?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminarlos!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.put('<?= base_url('rest-rendicion-caja') ?>/eliminar-tbk-sombras/' + fecha)
            .then( response => {
              if(response.data.code === 500) {
                this.errores = response.data.msj;
                Swal.fire({
                    title: 'Registro no eliminado',
                    icon: 'error',
                    confirmButtonText: 'Confirmar'
                });
              } else {
                this.getRendicionCaja();
                Swal.fire({
                  position: 'top-end',
                  title: 'Registro eliminado',
                  icon: 'success',
                  showConfirmButton: false,
                  timer: 1500
                });
              }
            });
        }
      });
    },

    eliminar(id_rendicion_caja) {
      Swal.fire({
        title: 'Eliminar registro',
        text: "¿Desea eliminar este registro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminarlo!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`<?=base_url('rest-rendicion-caja')?>/` + id_rendicion_caja)
            .then(
              response => {
                if(response.data.code === 500) {
                    this.errores = response.data.msj;
                    Swal.fire({
                        title: 'Registro no eliminado',
                        icon: 'error',
                        confirmButtonText: 'Confirmar'
                    });
                } else {
                  // this.edit = false;
                  this.getRendicionCaja();
                  Swal.fire({
                    position: 'top-end',
                    title: 'Registro eliminado',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                  });
                }
              }
            )
        }
      })
    },

    // Conseguir info para editar
    editar(id_rendicion_caja) {
      this.cargarForm = true;
      axios
        .get(`<?=base_url('rest-rendicion-caja')?>/` + id_rendicion_caja)
        .then(
          response => {
            const {
              data
            } = response.data;
            this.id_rendicion_caja      = data.id_rendicion_caja;
            this.fecha                  = data.fecha;
            this.rut                    = data.rut;
            this.nombreCliente          = data.nombre_cliente;
            this.totalFolio             = data.total_folio;
            this.saldoFolio             = data.saldo_folio;
            this.oldSaldoFolio          = data.saldo_folio;
            this.numeroFolio            = data.numero_folio;
            this.n_voucher_efectivo     = data.n_voucher_efectivo;
            this.n_voucher_tarjeta      = data.n_voucher_tarjeta;
            this.numeroBoleta           = data.numero_boleta;
            this.numeroOperacionTbk     = data.numero_operacion_tbk;
            this.numeroGuiaDespacho     = data.numero_guia_despacho;
            this.numeroFactura          = data.numero_factura;
            this.efectivo               = 0;
            this.tbk                    = 0;
            this.tbkSombra              = 0;
            this.cheques                = 0;
            this.webpay                 = 0;
            this.tf                     = 0;
            this.oc                     = 0;
            this.saldo                  = data.saldo;
            this.oldSaldo               = data.saldo;
            this.oldEfectivo            = data.efectivo;
            this.oldTbk                 = data.tbk;
            this.oldTbkSombra           = data.tbk_sombra;
            this.oldCheques             = data.cheques;
            this.oldWebpay              = data.webpay;
            this.oldTf                  = data.tf;
            this.oldOc                  = data.oc;
            this.cargarForm             = false;
            this.edit                   = true;
          }
        )
    },

    // Guardar actualización
    updateRendicion() {
      const self = this;
      const params    = new URLSearchParams();

      this.fecha                = moment(this.fecha).format('YYYY-MM-DD');
      this.efectivo             = parseInt(this.oldEfectivo) + parseInt(this.efectivo);
      this.tbk                  = parseInt(this.oldTbk) + parseInt(this.tbk);
      this.tbkSombra            = (this.oldTbkSombra !== undefined) ? parseInt(this.oldTbkSombra) + parseInt(this.tbkSombra) : parseInt(this.tbkSombra);
      this.cheques              = parseInt(this.oldCheques) + parseInt(this.cheques);
      this.webpay               = parseInt(this.oldWebpay) + parseInt(this.webpay);
      this.tf                   = parseInt(this.oldTf) + parseInt(this.tf);
      this.oc                   = parseInt(this.oldOc) + parseInt(this.oc);
      this.saldo                = parseInt(this.saldo);
      this.totalFolio           = parseInt(this.totalFolio);
      this.saldoFolio           = parseInt(this.saldoFolio);
      this.numeroFolio          = parseInt(this.numeroFolio);
      this.numero_voucher       = parseInt(this.numero_voucher);
      this.numeroBoleta         = parseInt(this.numeroBoleta);
      this.numeroOperacionTbk   = parseInt(this.numeroOperacionTbk);
      this.numeroGuiaDespacho   = parseInt(this.numeroGuiaDespacho);
      this.numeroFactura        = parseInt(this.numeroFactura);
      this.n_voucher_efectivo   = parseInt(this.n_voucher_efectivo);
      this.n_voucher_tarjeta    = parseInt(this.n_voucher_tarjeta);

      inputs.forEach(input => {
        if (this[input] !== '') {
          params.append(`${input}`, this[input]);
        }
      });

      axios
        .put(`<?=base_url('rest-rendicion-caja')?>/` + this.id_rendicion_caja, params)
        .then(
          response => {
            this.getRendicionCaja();
            Swal.fire({
                position: 'top-end',
                title: 'Registro actualizado',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });
            inputs.forEach(input => {
              (input !== 'fecha') && (this[input] = 0);
            });

            this.rut                = '';
            this.nombreCliente      = '';
            this.id_rendicion_caja  = '';
            this.edit               = false;
          }
        )

      
    },

    getName(event) {
      axios
        .get(`<?=base_url('cliente_info')?>/fromRut/` + this.rut)
        .then(
          response => {
            const { data } = response.data;
            this.nombreCliente = data[0].nombre_cliente;
          }
        )
    }
  },

  computed: {
    totalEfectivo: function () {
        let total = 0
        if(this.allRendiciones != null) {
            let efectivo = this.allRendiciones.map((det) => { 
                if(det.efectivo != null ) {
                  return det.efectivo 
                } 
            });
            total = efectivo.length > 0 ? efectivo.reduce((a, b) => parseInt(a) + parseInt(b)) : 0
        }
        this.totalIngresos += total;
        return total;
    },
    totalTbk: function () {
        let total = 0
        if(this.allRendiciones != null) {
            let tbk = this.allRendiciones.map((det) => { 
                if(det.cheques != null ) {
                  return det.tbk 
                } 
            });
            total = tbk.length > 0 ? tbk.reduce((a, b) => parseInt(a) + parseInt(b)) : 0
        }
        this.totalIngresos += total;
        return total;
    },
    totalTbkSombra: function () {
      let total = 0
      if(this.allRendiciones != null) {
        let tbkSombra = this.allRendiciones.map((det) => { 
          if(det.tbkSombra != null ) {
            return det.tbkSombra 
          }
        });
        total = tbkSombra.length > 0 ? tbkSombra.reduce((a, b) => parseInt(a) + parseInt(b)) : 0
      }
      this.totalIngresos += total;
      return total;
    },
    totalCheques: function () {
        let total = 0
        if(this.allRendiciones != null) {
            let cheques = this.allRendiciones.map((det) => { 
                if(det.cheques != null ) {
                  return det.cheques 
                } 
            });
            total = cheques.length > 0 ? cheques.reduce((a, b) => parseInt(a) + parseInt(b)) : 0
        }
        this.totalIngresos += total;
        return total;
    },
    totalWebpay: function () {
        let total = 0
        if(this.allRendiciones != null) {
            let webpay = this.allRendiciones.map((det) => { 
                if(det.webpay != null ) {
                  return det.webpay 
                } 
            });
            total = webpay.length > 0 ? webpay.reduce((a, b) =>parseInt(a) + parseInt(b)) : 0
        }
        this.totalIngresos += total;
        return total;
    },
    totalTf: function () {
        let total = 0
        if(this.allRendiciones != null) {
            let tf = this.allRendiciones.map((det) => { 
                if(det.tf != null ) {
                  return det.tf 
                } 
            });
            total = tf.length > 0 ? tf.reduce((a, b) =>parseInt(a) + parseInt(b)) : 0
        }
        this.totalIngresos += total;
        return total;
    },
    totalOc: function () {
        let total = 0
        if(this.allRendiciones != null) {
            let oc = this.allRendiciones.map((det) => { 
                if(det.oc != null ) {
                  return det.oc 
                } 
            });
            total = oc.length > 0 ? oc.reduce((a, b) => parseInt(a) + parseInt(b)) : 0
        }
        this.totalIngresos += total;
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
  
  mounted() {
    this.getRendicionCaja();
    this.cargarForm = false;
  },

});
</script>

<?= $this->endSection(); ?>