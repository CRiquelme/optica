<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Registro en sobre
<?= $this->endSection(); ?>

<?= $this->section('page_content'); ?>

<section class="m-10" id="sobre">
  <h1 class="text-4xl uppercase border-b-2 pb-5 border-gray-100 mb-4">Registro sobre</h1>

  <div class="grid md:grid-cols-5 gap-4">
    <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
      <?= $this->include('components/sidebar') ?>
    </div>

    <div class="md:row-span-1 md:col-span-4">
      <div v-if="cargarForm" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      <div v-if="id_sobre" class="flex justify-between">
        <h2 class="text-lg font-medium">
          Editar registro <small class="text-xs font-bold">ID: {{ id_sobre }}</small>
        </h2>
        <button class="bg-black text-white text-xs | px-4 py-1 | rounded-md" @click="limpiar()">
          Limpiar formulario
        </button>
      </div>
      <h2 v-else class="text-lg font-medium">Agregar registro</h2>
      <form-wizard v-if="!cargarForm" next-button-text="Siguiente" back-button-text="Anterior" finish-button-text="Guardar" title=""
        subtitle="" color="#009db0" shape="circle" step-size="sm" @on-complete="onComplete" ref="formWiz">
        <?php
          $labelClass = "block text-sm font-medium text-gray-700 uppercase";
          $inputClass = "block w-full p-2 | text-xs | font-bold | shadow-sm | border-b-2 border-gray-300 border-gray-200 rounded-sm | focus:outline-none focus:border-b-2 focus:border-gray-500";
          $textareaClass = "shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md border px-2 py-2";
				?>

        <tab-content title="" class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
          <!-- nombre, rut, tipo_de_lente, numero_pedido, fono, email, -->
          <div class="sm:col-span-3">
            <input type="hidden" name="id_sobre" name="id_sobre" v-model="id_sobre">
            <label class="<?= $labelClass ?>" for="rut">rut</label>
            <div class="mt-1">
              <input type="hidden" v-model="cliente_id" id="cliente_id" name="cliente_id">
              <input type="search" v-model="rut" class="<?= $inputClass ?>" id="rut" name="rut" placeholder="RUT">
            </div>
          </div>
          <div class="sm:col-span-3">
            <label class="<?= $labelClass ?>" for="nombre">Nombre</label>
            <div class="mt-1">
              <input type="text" v-model="nombre" id="nombre" name="nombre" class="<?= $inputClass ?>"
                placeholder="Nombre">
            </div>
          </div>
          <div class="sm:col-span-1">
            <div class="<?= $labelClass ?>">Tipo de lente</div>
            <div class="mt-1">
              <label>
                <input class="uk-radio" type="radio" name="tipo_de_lente" value="optico" v-model="tipo_de_lente">
                Óptico
              </label>
              <br />
              <label>
                <input class="uk-radio" type="radio" name="tipo_de_lente" value="contacto" v-model="tipo_de_lente">
                Contacto
              </label>
            </div>
          </div>
          <div class="sm:col-span-1">
            <label class="<?= $labelClass ?>" for="numero_pedido">número pedido</label>
            <div class="mt-1">
              <input v-model="numero_pedido" class="<?= $inputClass ?>" id="numero_pedido" name="numero_pedido"
                type="text" placeholder="Número pedido">
            </div>
          </div>
          <div class="sm:col-span-2">
            <label class="<?= $labelClass ?>" for="fono">Fono (celular)</label>
            <div class="mt-1">
              <input v-model="fono" class="<?= $inputClass ?>" id="fono" name="fono" type="text" placeholder="Fono">
            </div>
          </div>
          <div class="sm:col-span-2">
            <label class="<?= $labelClass ?>" for="email">Email</label>
            <div class="mt-1">
              <input v-model="email" class="<?= $inputClass ?>" id="email" name="email" type="text" placeholder="Email">
            </div>
          </div>
        </tab-content>

        <tab-content title="" class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
          <!-- Lejos -->
          <div class="sm:col-span-6">
            <h2 class="uk-text-center uk-text-uppercase uk-heading-line"><span>Lejos</span></h2>
          </div>
          <!-- OI, ESF1, CIL1 -->
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="lejos_od">od</label>
            <!-- <div class="mt-1 w-full pl-5"> -->
              <input v-model="lejos_od" class="<?= $inputClass ?>" id="lejos_od" name="lejos_od" type="text"
                placeholder="OD">
            <!-- </div> -->
          </div>
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="lejos_esf1">ESF</label>
            <input v-model="lejos_esf1" class="<?= $inputClass ?>" id="lejos_esf1" name="lejos_esf1" type="text"
              placeholder="ESF">
          </div>
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="lejos_cil1">cil</label>
            <input v-model="lejos_cil1" class="<?= $inputClass ?>" id="lejos_cil1" name="lejos_cil1" type="text"
              placeholder="CIL">
          </div>
          <!-- OI, ESF2, CIL2 -->
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="lejos_oi">oi</label>
            <input v-model="lejos_oi" class="<?= $inputClass ?>" id="lejos_oi" name="lejos_oi" type="text"
              placeholder="OI">
          </div>
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="lejos_esf2">ESF</label>
            <input v-model="lejos_esf2" class="<?= $inputClass ?>" id="lejos_esf2" name="lejos_esf2" type="text"
              placeholder="ESF">
          </div>
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="lejos_cil2">cil</label>
            <input v-model="lejos_cil2" class="<?= $inputClass ?>" id="lejos_cil2" name="lejos_cil2" type="text"
              placeholder="CIL">
          </div>
        </tab-content>

        <tab-content title="" class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
          <!-- Cerca -->
          <div class="sm:col-span-6">
            <h2 class="uk-text-center uk-text-uppercase uk-heading-line"><span>Cerca</span></h2>
          </div>
          <!-- OI, ESF1, CIL1 -->
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="cerca_od">od</label>
            <input v-model="cerca_od" class="<?= $inputClass ?>" id="cerca_od" name="cerca_od" type="text"
              placeholder="OD">
          </div>
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="cerca_esf1">ESF</label>
            <input v-model="cerca_esf1" class="<?= $inputClass ?>" id="cerca_esf1" name="cerca_esf1" type="text"
              placeholder="ESF">
          </div>
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="cerca_cil1">cil</label>
            <input v-model="cerca_cil1" class="<?= $inputClass ?>" id="cerca_cil1" name="cerca_cil1" type="text"
              placeholder="CIL">
          </div>
          <!-- OI, ESF2, CIL2 -->
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="cerca_oi">oi</label>
            <input v-model="cerca_oi" class="<?= $inputClass ?>" id="cerca_oi" name="cerca_oi" type="text"
              placeholder="OI">
          </div>
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="cerca_esf2">ESF</label>
            <input v-model="cerca_esf2" class="<?= $inputClass ?>" id="cerca_esf2" name="cerca_esf2" type="text"
              placeholder="ESF">
          </div>
          <div class="sm:col-span-2 flex items-center">
            <label class="<?= $labelClass ?>" for="cerca_cil2">cil</label>
            <input v-model="cerca_cil2" class="<?= $inputClass ?>" id="cerca_cil2" name="cerca_cil2" type="text"
              placeholder="CIL">
          </div>
        </tab-content>

        <tab-content title="" class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
          <!-- ADD, DP, H -->
          <div class="sm:col-span-2">
            <label class="<?= $labelClass ?>" for="cerca_add">ADD</label>
            <input v-model="cerca_add" class="<?= $inputClass ?>" id="cerca_add" name="cerca_add" type="text"
              placeholder="ADD">
          </div>
          <div class="sm:col-span-2">
            <label class="<?= $labelClass ?>" for="cerca_dp">D.P</label>
            <input v-model="cerca_dp" class="<?= $inputClass ?>" id="cerca_dp" name="cerca_dp" type="text"
              placeholder="D.P">
          </div>
          <div class="sm:col-span-2">
            <label class="<?= $labelClass ?>" for="cerca_h">H</label>
            <input v-model="cerca_h" class="<?= $inputClass ?>" id="cerca_h" name="cerca_h" type="text" placeholder="H">
          </div>

          <!-- Tipo_de_cristal, lejos, cerca -->
          <div class="sm:col-span-6">
            <label class="<?= $labelClass ?>" for="tipo_de_cristal">Tipo de cristal</label>
            <textarea v-model="tipo_de_cristal" class="<?= $textareaClass ?>" id="tipo_de_cristal"
              name="tipo_de_cristal"></textarea>
          </div>
          <!-- <div class="sm:col-span-2">
            <label class="<?= $labelClass ?>" for="lejos">Lejos</label>
            <textarea v-model="lejos" class="<?= $textareaClass ?>" id="lejos" name="lejos"></textarea>
          </div>
          <div class="sm:col-span-2">
            <label class="<?= $labelClass ?>" for="cerca">Cerca</label>
            <textarea v-model="cerca" class="<?= $textareaClass ?>" id="cerca" name="cerca"></textarea>
          </div> -->
          <div class="sm:col-span-3">
            <label class="<?= $labelClass ?>" for="profesional">Profesional</label>
            <input v-model="profesional" class="<?= $inputClass ?>" id="profesional" name="profesional" type="text"
              placeholder="Profesional">
          </div>
          <div class="sm:col-span-3">
            <label class="<?= $labelClass ?>" for="fecha_de_receta">fecha de receta</label>
            <input v-model="fecha_de_receta" class="<?= $inputClass ?>" id="fecha_de_receta" name="fecha_de_receta"
              type="date" placeholder="fecha de receta">
          </div>
          <!-- Armazón lejos -->
          <h2 class="sm:col-span-6 font-bold text-xl">Armazón lejos</h2>
            <div class="sm:col-span-1">
              <label for="buscadorArmazonLejos"  class="<?= $labelClass ?>">Buscador</label>
              <input v-model="buscadorArmazonLejos" @keyup="buscarArmazonLejos($event)" @change="onChange($event)" class="<?= $inputClass ?>"  id="buscadorArmazonLejos" type="text" placeholder="Buscador" :disabled="edit">
            </div>
            <div class="sm:col-span-3">
              <label class="<?= $labelClass ?>" for="armazon_lejos">armazon lejos</label>
              <input v-model="armazon_lejos" class="<?= $inputClass ?>" id="armazon_lejos" name="armazon_lejos" type="text" placeholder="Armazon lejos" :disabled="edit">
              <input v-model="armazon_lejos_id" class="<?= $inputClass ?>" id="armazon_lejos_id" name="armazon_lejos_id" type="hidden" >
              <input v-model="armazon_lejos_precio_venta" class="<?= $inputClass ?>" id="armazon_lejos_precio_venta" name="armazon_lejos_precio_venta" type="hidden" >
            </div>
            <div class="sm:col-span-1">
              <label for="tienda_armazon_lejos" class="<?= $labelClass ?>">Tienda</label>
              <select v-model="tienda_armazon_lejos" @change="onChange($event)" class="uk-select" id="tienda_armazon_lejos" name="tienda_armazon_lejos" :disabled="edit">
                <option value="">Tienda</option>
                <option v-for="(tienda, index) in tiendas" :key="tiendas.id_tienda" :value="tienda.id_tienda">
                    {{tienda.nombre_tienda}}
                </option>
              </select>
            </div>
            <div class="sm:col-span-1">
              <label for="armazon_lejos_cantidad"  class="<?= $labelClass ?>">Cantidad <span v-if="op_stocks_lejos >= 0" class="text-sm">stock: {{op_stocks_lejos}}</span></label>
              <input v-model="armazon_lejos_cantidad" class="<?= $inputClass ?>" id="armazon_lejos_cantidad" type="number" placeholder="Cantidad" min="0" :max="op_stocks_lejos" @change="totalPrecio($event)" :disabled="edit">
            </div>
            
            <!-- Armazon cerca -->
            <h2 class="sm:col-span-6 font-bold text-xl">Armazón cerca</h2>
            <div class="sm:col-span-1">
              <label for="buscadorArmazonCerca"  class="<?= $labelClass ?>">Buscador</label>
              <input v-model="buscadorArmazonCerca" @keyup="buscarArmazonCerca($event)" @change="onChange2($event)" class="<?= $inputClass ?>" id="buscadorArmazonCerca" type="text" placeholder="Buscador" :disabled="edit">
            </div>
            <div class="sm:col-span-3">
              <label class="<?= $labelClass ?>" for="armazon_cerca">armazon cerca</label>
              <input v-model="armazon_cerca" class="<?= $inputClass ?>" id="armazon_cerca" name="armazon_cerca" type="text" placeholder="Armazon cerca" :disabled="edit">
              <input v-model="armazon_cerca_id" class="<?= $inputClass ?>" id="armazon_cerca_id" name="armazon_cerca_id" type="hidden" >

              <input v-model="armazon_cerca_precio_venta" class="<?= $inputClass ?>" id="armazon_cerca_precio_venta" name="armazon_cerca_precio_venta" type="hidden" >
            </div>
            <div class="sm:col-span-1">
              <label for="tienda_armazon_cerca" class="<?= $labelClass ?>">Tienda</label>
              <select v-model="tienda_armazon_cerca" @change="onChange2($event)" class="uk-select" id="tienda_armazon_cerca" name="tienda_armazon_cerca" :disabled="edit">
                <option value="">Tienda</option>
                <option v-for="(tienda, index) in tiendas" :key="tiendas.id_tienda" :value="tienda.id_tienda">
                    {{tienda.nombre_tienda}}
                </option>
              </select>
            </div>
            <div class="sm:col-span-1">
              <label for="armazon_cerca_cantidad"  class="<?= $labelClass ?>">Cantidad <span v-if="op_stocks_cerca >= 0" class="text-sm">stock: {{op_stocks_cerca}}</span></label>
              <input v-model="armazon_cerca_cantidad" class="<?= $inputClass ?>" id="armazon_cerca_cantidad" type="number" placeholder="Cantidad" min="0" :max="op_stocks_cerca" @change="totalPrecio($event)" :disabled="edit">
            </div>
        </tab-content>

        <tab-content title="" class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">

          <div class="sm:col-span-3">
            <div>
              <div class="flex flex-row gap-y-6 gap-x-4 items-center">
                <label class="<?= $labelClass ?>">Forma de pago</label>
                <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" id="CH" value="CH" :disabled="abonoTotal === total && total > 0"> CH </label>
                <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" id="OC" value="OC" :disabled="abonoTotal === total && total > 0"> OC </label>
                <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" id="EF" value="EF" :disabled="abonoTotal === total && total > 0"> EF </label>
                <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" id="TF" value="TF" :disabled="abonoTotal === total && total > 0"> TF </label>
                <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" id="TBK" value="TBK" :disabled="abonoTotal === total && total > 0"> TBK </label>
                <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" id="CD" value="CD" :disabled="abonoTotal === total && total > 0"> CD </label>
              </div>
            </div>

            <div class="sm:col-span-3 | flex flex-col gap-y-3 gap-x-4 | pt-4">
              <div>
                <label class="<?= $labelClass ?>" for="total">Total</label>
                <input v-model="total" class="<?= $inputClass ?>" id="total" name="total" type="text" placeholder="Total" :disabled="edit">
              </div>
              <div>
                <label class="<?= $labelClass ?>" for="abono">abono
                  <span class="text-sm" v-if="abonoTotal > 0 && abono_pagar">: {{abonoTotal}} (abonado) + {{ abono }} = {{ parseInt(abonoTotal) + parseInt(abono) }}</span></label>
                <input v-model="abono" class="<?= $inputClass ?>" id="abono" name="abono" type="number" placeholder="Abono" min="0" :max="saldo ? saldo : total" @change="abonar($event)" :disabled="abonoTotal === total && total > 0">
                
                <input v-model="abono_pagar" class="<?= $inputClass ?>" id="abono_pagar" name="abono_pagar" type="hidden" placeholder="abono_pagar">
                
                <button v-if="abonoTotal < 1" @click="abonarTotal()" class="uk-button uk-button-primary uk-button-small" title="Presionar este botón cuando se paga el total.">Abonar total</button>
                
                <button v-if="abonoTotal >= 1 && abonoTotal !== total" @click="saldoTotal()" class="uk-button uk-button-secondary uk-button-small" title="Presionar este botón cuando se paga el total del saldo.">Abonar saldo</button>              
              </div>
              <div>
                <label class="<?= $labelClass ?>" for="saldo">saldo</label>
                <input v-model="saldo" class="<?= $inputClass ?>" id="saldo" name="saldo" type="text"
                  placeholder="Saldo" :disabled="abonoTotal === total && total > 0">

                <input v-model="saldo_diferencia" class="<?= $inputClass ?>" id="saldo_diferencia" name="saldo_diferencia" type="hidden" placeholder="saldo_diferencia">
                <span v-if="abonoTotal === total && total !== 0" class="bg-blue-800 text-white | text-sm px-5 py-2 mt-2 w-full">Pagado en su totalidad.</span>
              </div>
            </div>
          </div>

          <div class="sm:col-span-3">
            <label class="<?= $labelClass ?>" for="observaciones">observaciones</label>
            <textarea v-model="observaciones" rows="10" class="<?= $textareaClass ?>" id="observaciones"
              name="observaciones"></textarea>
          </div>

        </tab-content>

      </form-wizard>
      
      <!-- Registro de sobres -->
      <div class="w-full | mt-3">
        <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">
          Registros de sobres
          <i class="fas fa-sync cursor-pointer text-sm" @click="getSobres()" uk-tooltip="title: Refrescar la información; pos: right"></i>
        </h2>
        <div v-if="cargar" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
          <ul v-if="!cargar" role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <li v-for="libro in allSobres" :key="libro.id_sobre" class="col-span-1 flex shadow-sm rounded-md">
              <div :class="[id_sobre === libro.id_sobre ? 'bg-black' : 'bg-blue-500' ,' flex-shrink-0 flex items-center justify-center w-16 text-white text-sm font-medium rounded-l-md cursor-pointer']"  @click="editar(libro.id_sobre)"> <!-- @click="editar(libro.id_sobre)" -->
                <i class="fas fa-edit"></i>
              </div>
              <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
                <div class="flex-1 px-4 py-2 text-sm truncate">
                  <span class="text-gray-900 font-medium hover:text-gray-600">
                    {{ libro.created_at | fecha }} <small>ID: {{libro.id_sobre}}</small>
                  </span>
                  <p class="text-gray-500 text-red-700 cursor-pointer" @click="delete_registro(libro.id_sobre)"><i class="fas fa-trash-alt"></i> Borrar</p> <!-- @click="delete_registro(libro.id_libro)" -->
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</section>


<script>
const inputs = [
  "id_sobre",
  "cliente_id",
  "rut",
  "nombre",
  "tipo_de_lente",
  "numero_pedido",
  "fono",
  "email",
  "lejos_od",
  "lejos_esf1",
  "lejos_cil1",
  "lejos_oi",
  "lejos_esf2",
  "lejos_cil2",
  "cerca_od",
  "cerca_esf1",
  "cerca_cil1",
  "cerca_oi",
  "cerca_esf2",
  "cerca_cil2",
  "cerca_add",
  "cerca_dp",
  "cerca_h",
  "tipo_de_cristal",
  "lejos",
  "cerca",
  "profesional",
  "fecha_de_receta",
  "buscadorArmazonLejos",
  "buscadorArmazonCerca",
  "tienda_lejos",
  "tienda_cerca",
  "armazon_lejos",
  "armazon_lejos_id",
  "armazon_lejos_cantidad",
  "op_stocks_cerca",
  "op_stocks_lejos",
  "armazon_lejos_precio_venta",
  "armazon_cerca",
  "armazon_cerca_id",
  "armazon_cerca_cantidad",
  "armazon_cerca_precio_venta",
  "total",
  "abono",
  "abono_pagar",
  "abonoTotal",
  "saldo",
  "saldo_diferencia",
  "observaciones",
  "forma_de_pago",
];

Vue.use(VueFormWizard);
Vue.component('v-select', VueSelect.VueSelect);

Vue.component('titulo', {
  template: '<h1 class="uk-text-uppercase uk-text-center">{{titulo}}</h1>',
  data: function() {
    return {
      titulo: 'Registro sobre'
    }
  }
});

var app = new Vue({
  el: '#sobre',
  data() {
    <?php $uri = new \CodeIgniter\HTTP\URI(uri_string(true)); ?>
    return {
      cliente_id                  : '<?= $uri->getSegment(2); ?>', // Capturar el id al cargar la pagina
      cargar                      : true,
      cargarForm                  : true,
      edit                        : false,
      id_sobre                    : '',
      ruts                        : [],
      rut                         : '',
      nombre                      : '',
      tipo_de_lente               : '',
      numero_pedido               : '',
      fono                        : '',
      email                       : '',
      lejos_od                    : '',
      lejos_esf1                  : '',
      lejos_cil1                  : '',
      lejos_oi                    : '',
      lejos_esf2                  : '',
      lejos_cil2                  : '',
      cerca_od                    : '',
      cerca_esf1                  : '',
      cerca_cil1                  : '',
      cerca_oi                    : '',
      cerca_esf2                  : '',
      cerca_cil2                  : '',
      cerca_add                   : '',
      cerca_dp                    : '',
      cerca_h                     : '',
      tipo_de_cristal             : '',
      lejos                       : '',
      cerca                       : '',
      profesional                 : '',
      fecha_de_receta             : '',
      armazon_lejos               : '',
      armazon_lejos_id            : '',
      armazon_cerca               : '',
      armazon_cerca_id            : '',
      total                       : 0,
      abono                       : 0,
      abono_pagar                 : 0,
      abonoTotal                  : 0,
      saldo                       : 0,
      saldo_diferencia            : 0,
      observaciones               : '',
      forma_de_pago               : [],
      forma_de_pago_old           : [],
      allSobres                   : [],
      tiendas                     : [],
      tienda_armazon_lejos        : '',
      buscadorArmazonLejos        : '',
      armazon_lejos               : '',
      armazon_lejos_cantidad      : '',
      buscadorArmazonCercaDisabled: false,
      stocks_lejos                : '',
      op_stocks_lejos             : '',
      armazon_lejos_cantidad      : 0,
      armazon_lejos_precio_venta  : 0,
      tienda_armazon_cerca        : '',
      buscadorArmazonCerca        : '',
      armazon_cerca_precio_venta  : 0,
      armazon_cerca               : '',
      armazon_cerca_cantidad      : '',
      stocks_cerca                : '',
      op_stocks_cerca             : '',
      cantidadArmazonCerca        : 0,
      idSobre                     : '',
      cercaId                     : '',
      lejosId                     : '',
    }
  },
  methods: {
    // Info del cliente
    cliente: function() {
      axios.get('<?= base_url('rest-clientes') ?>/' + this.cliente_id)
        .then(
          response => {
            const { data }  = response.data;
            this.nombre     = data.nombre_cliente;
            this.rut        = data.rut;
            this.fono       = data.celular;
          }
        )
    },
    // get all sobres
    getSobres: function() {
      this.cargar = true;
      axios.get('<?= base_url('rest-sobre') ?>/cliente/' + this.cliente_id)
        .then(
          response => {
            const {
              data
            } = response.data;
            this.allSobres  = data;
            this.cargar     = false;
            this.cargarForm = false;
          }
        )
    },
    // Guardar al completar el formulario
    onComplete: async function() {
      if(this.id_sobre === '') {
        const params = new URLSearchParams();
        let idSobre;

        inputs.forEach(input => {
          if (this[input] !== '') {
            params.append(`${input}`, this[input]);
          }
        });

        if (this.rut !== '') {
          await axios
              .post('<?=base_url('rest-sobre')?>', params)
              .then(
                response => {
                  if(response.data.code === 500) {
                      this.errores = response.data.msj;
                  } else {
                    idSobre = response.data.data.id_sobre;
                    // // Limpiar los v-models de los inputs menos el cliente_id
                    // inputs.forEach(input => {
                    //   (input !== 'cliente_id') && (this[input] = '');
                    // });
                    // this.$refs.formWiz.reset();
                    this.cliente();
                    this.getSobres();
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
              this.id_sobre = idSobre;
              await this.salida();
              // Limpiar los v-models de los inputs menos el cliente_id
              inputs.forEach(input => {
                (input !== 'cliente_id') && (this[input] = '');
              });
              this.$refs.formWiz.reset();
          } else {
            this.errores = 'Debe seleccionar un cliente';
          }
      } else {
        this.updateSobre();
      }
    },

    // Guardar salida
    salida: function() {
      let self = this;
      console.log(this.cercaId, this.lejosId);
      if(self.armazon_cerca_id > 0) {
        this.salidaProducto(self.armazon_cerca_id, self.armazon_cerca_cantidad, self.tienda_armazon_cerca, self.id_sobre);
        console.log('cerca');
      }
      if(self.armazon_lejos_id > 0) {
        this.salidaProducto(self.armazon_lejos_id, self.armazon_lejos_cantidad, self.tienda_armazon_lejos, self.id_sobre);
        console.log('lejos');
      }
    },

    // Función que agrega una salida
    salidaProducto: function(id, cantidad, tienda, id_sobre) {
      const params = new URLSearchParams();
      if(id !== null) {
          params.append('producto_id', id);
      }
      if(tienda !== null) {
          params.append('tienda_id', tienda);
      }
      if(cantidad !== null) {
          params.append('cantidad_producto', cantidad);
      }
      if(id_sobre !== null) {
          params.append('sobre_id', id_sobre);
      }

      axios
        .post('<?=base_url('rest-salida-productos')?>', params)
        .then(
          response => {
            // console.log(response.data);
            if(response.data.code === 500) {
              console.log(response.data.msj);
              this.errores = response.data.msj;
            } else {
              axios
                .get('<?=base_url('rest-salida-productos')?>')
                .then(response => (this.info = response.data.data));
            }
          }
        );
    },

    // Al presionar en botón para editar
    editar: function(id_sobre) {
      this.id_sobre = id_sobre;
      this.edit     = true;
      // this.cargarForm = true;
      
      axios
        .get(`<?=base_url('rest-sobre')?>/` + this.id_sobre)
        .then(
          response => {
            if(response.data.code === 500) {
                console.log(response.data.msj);
                this.errores = response.data.msj;
            } else {
              const {data} = response.data;
              this.tipo_de_lente              = data.tipo_de_lente;
              this.numero_pedido              = data.numero_pedido !== null ? data.numero_pedido : '';
              this.fono                       = data.fono !== null ? data.fono : '';
              this.email                      = data.email !== null ? data.email : '';
              this.lejos_od                   = data.lejos_od !== null ? data.lejos_od : '';
              this.lejos_esf1                 = data.lejos_esf1 !== null ? data.lejos_esf1 : '';
              this.lejos_cil1                 = data.lejos_cil1 !== null ? data.lejos_cil1 : '';
              this.lejos_oi                   = data.lejos_oi !== null ? data.lejos_oi : '';
              this.lejos_esf2                 = data.lejos_esf2 !== null ? data.lejos_esf2 : '';
              this.lejos_cil2                 = data.lejos_cil2 !== null ? data.lejos_cil2 : '';
              this.cerca_od                   = data.cerca_od !== null ? data.cerca_od : '';
              this.cerca_esf1                 = data.cerca_esf1 !== null ? data.cerca_esf1 : '';
              this.cerca_cil1                 = data.cerca_cil1 !== null ? data.cerca_cil1 : '';
              this.cerca_oi                   = data.cerca_oi !== null ? data.cerca_oi : '';
              this.cerca_esf2                 = data.cerca_esf2 !== null ? data.cerca_esf2 : '';
              this.cerca_cil2                 = data.cerca_cil2 !== null ? data.cerca_cil2 : '';
              this.cerca_add                  = data.cerca_add !== null ? data.cerca_add : '';
              this.cerca_dp                   = data.cerca_dp !== null ? data.cerca_dp : '';
              this.cerca_h                    = data.cerca_h !== null ? data.cerca_h : '';
              this.tipo_de_cristal            = data.tipo_de_cristal !== null ? data.tipo_de_cristal : '';
              this.lejos                      = data.lejos !== null ? data.lejos : '';
              this.cerca                      = data.cerca !== null ? data.cerca : '';
              this.profesional                = data.profesional !== null ? data.profesional : '';
              this.fecha_de_receta            = data.fecha_de_receta !== null ? data.fecha_de_receta : '';
              this.armazon_lejos              = data.armazon_lejos !== null ? data.armazon_lejos : '';
              this.armazon_lejos_cantidad     = data.armazon_lejos_cantidad !== null ? data.armazon_lejos_cantidad : '';
              this.armazon_cerca              = data.armazon_cerca !== null ? data.armazon_cerca : '';
              this.armazon_cerca_cantidad     = data.armazon_cerca_cantidad !== null ? data.armazon_cerca_cantidad : '';
              this.total                      = data.total !== null ? data.total : '';
              this.abonoTotal                 = data.abono !== null ? data.abono : '';
              this.saldo                      = data.saldo !== null ? data.total - data.abono : '';
              this.observaciones              = data.observaciones !== null ? data.observaciones : '';
              this.forma_de_pago              = data.forma_de_pago !== null ? data.forma_de_pago.split(',') : [];
              this.forma_de_pago_old          = data.forma_de_pago !== null ? data.forma_de_pago.split(',') : [];
              this.$refs.formWiz.activateAll();
            }
          }
        )
    },

    // Guardar datos actualizados
    updateSobre: function() {
      let diferencia_seleccion_forma_de_pago =  [];
      const params = new URLSearchParams();
      inputs.forEach(input => {
        if(input === 'forma_de_pago') {
          if(this[input].length > 0) {
            params.append(`${input}`, this[input].join(','));
          } else {
            params.append(`${input}`, '');
          }
        } else { // (this[input] !== null)
          params.append(`${input}`, this[input]);
          console.log(`${input}`, this[input]);
        }
      });
      axios
        .put(`<?=base_url('rest-sobre')?>/` + this.id_sobre, params)
        .then(
          response => {
            this.getSobres();
            Swal.fire({
                position: 'top-end',
                title: 'Registro actualizado',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });
          }
        )
        .catch(
          error => {
            console.log(error);
          }
        )
      // console.log(this.forma_de_pago);
      // console.log(this.forma_de_pago_old);
      // console.log(this.forma_de_pago.filter(e => !this.forma_de_pago_old.includes(e)));
      diferencia_seleccion_forma_de_pago = this.forma_de_pago.filter(e => !this.forma_de_pago_old.includes(e))
    },

    delete_registro: function(id_sobre) {
      Swal.fire({
        title: 'Eliminar registro',
        text: "¿Desea eliminar este registro?, si está haciendo un registro por favor cambie y vuelva a la tienda correcta para asegurar el stock correcto.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminarlo!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`<?=base_url('rest-sobre')?>/` + id_sobre)
            .then(
              response => {
                if(response.data.code === 500) {
                    this.errores = response.data.msj;
                    Swal.fire({
                        title: 'Ingreso no eliminado',
                        icon: 'error',
                        confirmButtonText: 'Confirmar'
                    });
                } else {
                  this.getSobres();
                  Swal.fire({
                    position: 'top-end',
                    title: 'Registro en libro eliminado',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                  });
                  this.limpiar();
                }
              }
            )
            .catch(
              error => {
                console.log(error);
              }
            )
        }
      })
    },

    // Limpiar formulario para crear un nuevo registro
    limpiar: async function() {
      this.cargarForm                   = true;
      this.id_sobre                     = '';
      this.buscadorArmazonCerca         = '';
      this.buscadorArmazonLejos         = '';
      this.buscadorArmazonCercaDisabled = false;
      this.edit                         =  false;

      inputs.forEach(input => {
        (input !== 'cliente_id') && (this[input] = '');
      });

      this.total = 0;
      await this.cliente();
      this.cargarForm = false;
    },

    buscarArmazonLejos: async function(event) {
      let self      = this;
      this.cargando = true;
      await axios
        .get('<?=base_url("rest-stock/show-codigo")?>/' + self.buscadorArmazonLejos)
        .then(response => {
            self.armazon_lejos              = response.data.data[0].modelo;
            self.armazon_lejos_id           = response.data.data[0].producto_id;
            self.armazon_lejos_precio_venta = response.data.data[0].precio_venta;
        })
        .catch(error => {
            console.log(error);
            self.armazon_lejos = null;
        })
    },
    
    buscarArmazonCerca: async function(event) {
      let self      = this;
      this.cargando = true;
      await axios
        .get('<?=base_url("rest-stock/show-codigo")?>/' + self.buscadorArmazonCerca)
        .then(response => {
            self.armazon_cerca              = response.data.data[0].modelo
            self.armazon_cerca_id           = response.data.data[0].producto_id
            self.armazon_cerca_precio_venta = response.data.data[0].precio_venta;
        })
        .catch(error => {
            console.log(error);
            self.armazon_cerca = null;
        })
    },

    onChange : async function(event)  {
      let self      = this;
      this.cargando = true;
      self.stocks   = null;

      await axios
          .get('<?=base_url('rest-stock')?>')
          .then(response => (self.stocks_lejos = response.data.data));
          
      const stockLejos = self.stocks_lejos.filter(
          s => (s.cod_barra === self.buscadorArmazonLejos && s.tienda_id === self.tienda_armazon_lejos)
      );

      if(stockLejos.length > 0) {
        stockLejos.forEach(s => {
          if( self.buscadorArmazonLejos === s.cod_barra && 
              self.tienda_armazon_lejos === s.tienda_id) 
          {
              return self.op_stocks_lejos = s.stock;
          } 
          self.op_stocks_lejos = 0;
        })
      } else {
          self.op_stocks_lejos = 0;
      };
      self.cargando = false;
    },
    
    onChange2 : async function(event)  {
      let self      = this;
      self.stocks   = null;

      await axios
          .get('<?=base_url('rest-stock')?>')
          .then(response => (self.stocks_cerca = response.data.data));
          
      const stockCerca = self.stocks_cerca.filter(
          s => (s.cod_barra === self.buscadorArmazonCerca && s.tienda_id === self.tienda_armazon_cerca)
      );

      if(stockCerca.length > 0) {
        stockCerca.forEach(s => {
          if( self.buscadorArmazonCerca === s.cod_barra && 
              self.tienda_armazon_cerca === s.tienda_id) 
          {
              return self.op_stocks_cerca = s.stock;
          } 
          self.op_stocks_cerca = 0;
        })
      } else {
          self.op_stocks_cerca = 0;
      };
      self.cargando = false;
    },

    totalPrecio: function(event) {
      // Sumar totales
      let self = this;
      self.total = (self.armazon_cerca_cantidad * self.armazon_cerca_precio_venta) + 
                   (self.armazon_lejos_cantidad * self.armazon_lejos_precio_venta);
      // console.log(self.total);
    },

    abonarTotal: function(event) {
      let self = this;
      self.abono = self.total;
      this.abonar(event);
      this.saldar(event);
    },

    saldoTotal: function(event) {
      let self = this;
      self.abono = self.saldo;
      this.abonar(event);
      this.saldar(event);
    },

    abonar: function(event) {
      let self = this;
      if(self.abonoTotal > 0){
        self.abono_pagar = parseInt(self.abono) + parseInt(self.abonoTotal);
        this.saldar(event);
      } else {
        self.abono_pagar = parseInt(self.abono);
        this.saldar(event);
      }
    },

    saldar: function(event) {
      let self = this;
      self.saldo_diferencia = self.total - self.abono_pagar;
    }
  },

  filters: {
    fecha: function (value) {
      return moment(String(value)).format('MM/DD/YYYY hh:mm')
    },
    grados: function (value) {
      return value + '°';
    }
  },

  // watch: {
  //   lejos_od(newValue, oldValue) {
  //     if (newValue && newValue !== oldValue) {
  //       console.log('yes, differs, do it once!');
  //       this.$v.$touch();

  //       // if valid, emit value
  //       if (this.$v.price.$invalid) {
  //         return;
  //       }
  //       this.$emit('input', newValue);
  //     }
  //   },
  // },

  created() {
    this.cliente();
    this.getSobres();

    axios
      .get('<?=base_url('rest-traslados/tiendas')?>')
      .then(response => (this.tiendas = response.data.data));
  }

});
</script>

<?= $this->endSection(); ?>