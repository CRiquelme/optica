<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Libros
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>

<section id="libros">
  <article class=" flex flex-wrap justify-between | mb-2 mx-10 mt-10">
    <h1 class="text-4xl uppercase">
      Libros 
      <i class="fas fa-sync cursor-pointer text-xl" @click="getInfo()" uk-tooltip="title: Refrescar la información; pos: right"></i>
    </h1>
    <div class="w-full md:w-1/3 mb-6 md:mb-0">
      <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="fecha" type="date" placeholder="Fecha" v-model="fecha" @change="getInfo">
    </div>
  </article>

  <div v-if="cargar" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
  
  <ul v-if="!cargar" role="list" class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2 | mb-2 mx-10 mt-10">
    <li v-for="registro in libros.data" :key="registro.id_libro" class="col-span-1 bg-white rounded-lg shadow-md divide-y divide-gray-800">
      <div class="w-full flex items-center justify-between p-6 space-x-6">
        <div class="flex-1 truncate">
          <div class="flex justify-between space-x-3">
            <h3 class="text-gray-900 text-md font-bold truncate">{{ registro.nombre_cliente }} - {{ registro.rut }}</h3>
            <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-bold bg-green-100 rounded-full">
              {{ registro.created_at | fecha }}
            </span>
          </div>
          <!-- <p class="mt-1 text-gray-500 text-sm truncate">{{ registro.created_at }}</p> -->
          <table class="w-full">
            <!-- Lejos -->
            <tr>
              <td colspan="7" class="border-b-2 border-gray-200 font-bold text-center | pt-3 | uppercase">
                Lejos
              </td>
            </tr>
            <!-- Lejos OD -->
            <tr>
              <td class="font-bold">OD</td>
              <td>
                <strong>Esferico:</strong> {{ registro.lejosODEsferico ? registro.lejosODEsferico : '---' }}
              </td>
              <td>
                <strong>Cilindrico:</strong> {{ registro.lejosODCilindrico ? registro.lejosODCilindrico : '---' }}
              </td>
              <td>
                <strong>Eje:</strong> {{ registro.lejosODEje ? registro.lejosODEje : '---' }}
              </td>
              <td>
                <strong>△:</strong> {{ registro.lejosODTriangulo ? registro.lejosODTriangulo : '---' }}
              </td>
              <td>
                <strong>Base:</strong> {{ registro.lejosODBase ? registro.lejosODBase : '---' }}
              </td>
              <td>
                <strong>DP:</strong> {{ registro.lejosODDp ? registro.lejosODDp : '---' }}
              </td>
            </tr>
            <!-- Lejos OI -->
            <tr>
              <td class="font-bold">OI</td>
              <td>
                <strong>Esferico:</strong> {{ registro.lejosOIEsferico ? registro.lejosOIEsferico : '---' }}
              </td>
              <td>
                <strong>Cilindrico:</strong> {{ registro.lejosOICilindrico ? registro.lejosOICilindrico : '---' }}
              </td>
              <td>
                <strong>Eje:</strong> {{ registro.lejosOIEje ? registro.lejosOIEje : '---' }}
              </td>
              <td>
                <strong>△:</strong> {{ registro.lejosOITriangulo ? registro.lejosOITriangulo : '---' }}
              </td>
              <td>
                <strong>Base:</strong> {{ registro.lejosOIBase ? registro.lejosOIBase : '---' }}
              </td>
              <td>
                <strong>DP:</strong> {{ registro.lejosOIDp ? registro.lejosOIDp : '---' }}
              </td>
            </tr>
            <!-- Cerca -->
            <tr>
              <td colspan="7" class="border-b-2 border-gray-200 font-bold text-center | pt-3 | uppercase">
                Cerca
              </td>
            </tr>
            <!-- Cerca OD -->
            <tr>
              <td class="font-bold">OD</td>
              <td>
                <strong>Esferico:</strong> {{ registro.cercaODEsferico ? registro.cercaODEsferico : '---' }}
              </td>
              <td>
                <strong>Cilindrico:</strong> {{ registro.cercaODCilindrico ? registro.cercaODCilindrico : '---' }}
              </td>
              <td>
                <strong>Eje:</strong> {{ registro.cercaODEje ? registro.cercaODEje : '---' }}
              </td>
              <td>
                <strong>△:</strong> {{ registro.cercaODTriangulo ? registro.cercaODTriangulo : '---' }}
              </td>
              <td>
                <strong>Base:</strong> {{ registro.cercaODBase ? registro.cercaODBase : '---' }}
              </td>
              <td>
                <strong>DP:</strong> {{ registro.cercaODDp ? registro.cercaODDp : '---' }}
              </td>
            </tr>
            <!-- Cerca OI -->
            <tr>
              <td class="font-bold">OI</td>
              <td>
                <strong>Esferico:</strong> {{ registro.cercaOIEsferico ? registro.cercaOIEsferico : '---' }}
              </td>
              <td>
                <strong>Cilindrico:</strong> {{ registro.cercaOICilindrico ? registro.cercaOICilindrico : '---' }}
              </td>
              <td>
                <strong>Eje:</strong> {{ registro.cercaOIEje ? registro.cercaOIEje : '---' }}
              </td>
              <td>
                <strong>△:</strong> {{ registro.cercaOITriangulo ? registro.cercaOITriangulo : '---' }}
              </td>
              <td>
                <strong>Base:</strong> {{ registro.cercaOIBase ? registro.cercaOIBase : '---' }}
              </td>
              <td>
                <strong>DP:</strong> {{ registro.cercaOIDp ? registro.cercaOIDp : '---' }}
              </td>
            </tr>
          </table>

          <div class="grid grid-cols-1 gap-1 sm:grid-cols-2 lg:grid-cols-2 | pt-4">
            <div>
              <strong>Dr.:</strong> {{ registro.doctor ? registro.doctor : '---' }}
            </div>
            <div>
              <strong>Armazón:</strong> {{ registro.armazon ? registro.armazon : '---' }}
            </div>
            <div>
              <strong>Cristales:</strong> {{ registro.cristales ? registro.cristales : '---' }}
            </div>
            <div>
              <strong>Observaciones:</strong> {{ registro.observaciones ? registro.observaciones : '---' }}
            </div>
          </div>
        </div>
      </div>
    </li>

  </ul>
  
  <div class="mx-10" v-if="!cargar">
    <p v-if="libros?.data?.length === 0" class="w-full py-2 | text-center text-sm font-bold | text-white bg-yellow-500">
      El día seleccionado no tiene registros.
    </p>
  </div>

</section>

<script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
<script>
  let app = new Vue({
    el: '#libros',
    data() {
      return {
        libros  : [],
        fecha   : null,
        cargar  : true,
      }
    },
    created () {
        this.fecha = new Date().toJSON().slice(0,10)
        this.getInfo()
    },
    methods: {
      getInfo () {
        this.cargar   = true
        let fecha     = moment(this.fecha).format('YYYY-MM-DD');
        axios.get(`<?=base_url('rest-libros')?>/fecha/` + fecha)
        .then(response => {
          this.libros = response.data;
          this.cargar = false;
        })
        .catch(error => {
          console.log(error);
        })
      }
    },
    filters: {
      fecha: function (date) {
        return moment(date).format('DD/MM/YYYY hh:mm');
      }
    }
  });
</script>

<?= $this->endSection();?>