<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Libros
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>

<section id="libros">
  <article class="flex flex-wrap justify-between | mb-2 mx-10 mt-10">
    <h1 class="text-4xl uppercase">Libro de óptica</h1>
    <div class="flex flex-wrap | items-center gap-4">
      <span v-if="clienteInfo.nombre_cliente"><strong>Cliente:</strong> {{clienteInfo.nombre_cliente}}</span>
      <span v-if="clienteInfo.rut"><strong>R.U.T.:</strong> {{clienteInfo.rut}}</span>
      <span v-if="!clienteInfo.rut" class="text-red-800">Debe buscar un cliente válido...</span>
      <a href="<?=base_url('clientes') ?>" class="bg-black text-white hover:no-underline hover:text-gray-300 | px-2 py-1 | rounded-lg">Ir a clientes</a>
    </div>
  </article>

  <section class="flex flex-wrap flex-column justify-between | mx-10">
    <!-- Formulario -->
    <div class="w-full mb-10">
      <form>
        <table class="table table-auto | w-full">
          <thead>
            <?php $classTh = 'bg-black text-white | text-left | py-1 px-2 | uppercase font-sm'; ?>
            <tr>
              <th class="<?=$classTh; ?>">&nbsp;</th>
              <th class="<?=$classTh; ?>">Esferico</th>
              <th class="<?=$classTh; ?>">Cilindrico</th>
              <th class="<?=$classTh; ?>">Eje</th>
              <th class="<?=$classTh; ?>">△</th>
              <th class="<?=$classTh; ?>">Base</th>
              <th class="<?=$classTh; ?>">D.P.</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $classInput = "max-w-lg block w-full p-2 | sm:max-w-xs text-xs | font-bold | shadow-sm | border-b-2 border-gray-300 border-gray-200 rounded-sm | focus:outline-none focus:border-b-2 focus:border-gray-500";
              $classLabel = "text-xs font-bold flex flex-row items-center px-3 justify-center w-full";
            ?>
            <!-- Lejos -->
            <tr>
              <td colspan="7" class="text-center | bg-gray-800 text-white">Lejos</td>
            </tr>
            <!-- OD Lejos -->
            <tr>
              <td>
                <label class="<?=$classLabel?>">
                  OD
                </label>
              </td>
              <td>
                <input type="text" name="lejosODEsferico" id="lejosODEsferico" v-model="lejosODEsferico" class="<?=$classInput ?>" placeholder="O.D."/>
              </td>
              <td>
                <input type="text" name="lejosODCilindrico" id="lejosODCilindrico" v-model="lejosODCilindrico" class="<?=$classInput ?>" placeholder="O.D." />
              </td>
              <td>
                <input type="text" id="lejosODEje" name="lejosODEje" v-model="lejosODEje" class="<?=$classInput ?>" placeholder="O.D." />
              </td>
              <td>
                <input type="text" id="lejosODTriangulo" name="lejosODTriangulo" v-model="lejosODTriangulo" class="<?=$classInput ?>" placeholder="O.D." />
              </td>
              <td>
                <input type="text" id="lejosODBase" name="lejosODBase" v-model="lejosODBase" class="<?=$classInput ?>" placeholder="O.D." />
              </td>
              <td>
                <input type="text" id="lejosODDp" name="lejosODDp" class="<?=$classInput ?>" v-model="lejosODDp" placeholder="O.D." />
              </td>
            </tr>
            <!-- OI Lejos -->
            <tr>
              <td>
                <label class="<?=$classLabel?>">
                  OI
                </label>
              </td>
              <td>
                <input type="text" name="lejosOIEsferico" id="lejosOIEsferico" v-model="lejosOIEsferico" class="<?=$classInput ?>" placeholder="O.I."/>
              </td>
              <td>
                <input type="text" name="lejosOICilindrico" id="lejosOICilindrico" v-model="lejosOICilindrico" class="<?=$classInput ?>" placeholder="O.I." />
              </td>
              <td>
                <input type="text" id="lejosOIEje" name="lejosOIEje" v-model="lejosOIEje" class="<?=$classInput ?>" placeholder="O.I." />
              </td>
              <td>
                <input type="text" id="lejosOITriangulo" name="lejosOITriangulo" v-model="lejosOITriangulo" class="<?=$classInput ?>" placeholder="O.I." />
              </td>
              <td>
                <input type="text" id="lejosOIBase" name="lejosOIBase" v-model="lejosOIBase" class="<?=$classInput ?>" placeholder="O.I." />
              </td>
              <td>
                <input type="text" id="lejosOIDp" name="lejosOIDp" class="<?=$classInput ?>" v-model="lejosOIDp" placeholder="O.I." />
              </td>
            </tr>
            <!-- Cerca -->
            <tr>
              <td colspan="7" class="text-center | bg-gray-800 text-white">
                Cerca
              </td>
            </tr>
            <!-- OD Cerca -->
            <tr>
              <td>
                <label class="<?=$classLabel?>">
                  OD
                </label>
              </td>
              <td>
                <input type="text" v-model="cercaODEsferico" name="cercaODEsferico" id="cercaODEsferico" class="<?=$classInput ?>" placeholder="O.D."/>
              </td>
              <td>
                <input type="text" v-model="cercaODCilindrico" name="cercaODCilindrico" id="cercaODCilindrico" class="<?=$classInput ?>" placeholder="O.D." />
              </td>
              <td>
                <input type="text" v-model="cercaODEje" id="cercaODEje" name="cercaODEje" class="<?=$classInput ?>" placeholder="O.D." />
              </td>
              <td>
                <input type="text" v-model="cercaODTriangulo" id="cercaODTriangulo" name="cercaODTriangulo" class="<?=$classInput ?>" placeholder="O.D." />
              </td>
              <td>
                <input type="text" v-model="cercaODBase" id="cercaODBase" name="cercaODBase" class="<?=$classInput ?>" placeholder="O.D." />
              </td>
              <td>
                <input type="text" v-model="cercaODDp" id="cercaODDp" name="cercaODDp" class="<?=$classInput ?>" placeholder="O.D." />
              </td>
            </tr>
            <!-- OI Cerca -->
            <tr>
              <td>
                <label class="<?=$classLabel?>">
                  OI
                </label>
              </td>
              <td>
                <input type="text" v-model="cercaOIEsferico" name="cercaOIEsferico" id="cercaOIEsferico" class="<?=$classInput ?>" placeholder="O.I."/>
              </td>
              <td>
                <input type="text" v-model="cercaOICilindrico" name="cercaOICilindrico" id="cercaOICilindrico" class="<?=$classInput ?>" placeholder="O.I." />
              </td>
              <td>
                <input type="text" v-model="cercaOIEje" id="cercaOIEje" name="cercaOIEje" class="<?=$classInput ?>" placeholder="O.I." />
              </td>
              <td>
                <input type="text" v-model="cercaOITriangulo" id="cercaOITriangulo" name="cercaOITriangulo" class="<?=$classInput ?>" placeholder="O.I." />
              </td>
              <td>
                <input type="text" v-model="cercaOIBase" id="cercaOIBase" name="cercaOIBase" class="<?=$classInput ?>" placeholder="O.I." />
              </td>
              <td>
                <input type="text" v-model="cercaOIDp" id="cercaOIDp" name="cercaOIDp" class="<?=$classInput ?>" placeholder="O.I." />
              </td>
            </tr>
          </tbody>
        </table>

        <input type="hidden" v-model="cliente_id" id="cliente_id" name="cliente_id" class="<?=$classInput ?>" />
        <input type="hidden" v-model="id_libro" id="id_libro" name="id_libro" class="<?=$classInput ?>" />

        <div class="flex flex-row">
          <label for="doctor" class="<?=$classLabel?>">
            Dr.
            <input type="text" v-model="doctor" id="doctor" name="doctor" class="<?=$classInput ?>" />
          </label>
          <label for="armazon" class="<?=$classLabel?>">
            Armazón
            <input type="text" v-model="armazon" id="armazon" name="armazon" class="<?=$classInput ?>" />
          </label>
          <label for="cristales" class="<?=$classLabel?>">
            Cristales
            <input type="text" v-model="cristales" id="cristales" name="cristales" class="<?=$classInput ?>" />
          </label>
          <label for="observaciones" class="<?=$classLabel?>">
            Observaciones
            <input type="text" v-model="observaciones" id="observaciones" name="observaciones" class="<?=$classInput ?>" />
          </label>
        </div>
        <!-- Buttons -->
        <div v-if="clienteInfo.rut" class="flex flex-row justify-between">
          <button
          v-if="!edit"
            type="button"
            class="bg-black text-white | mt-5 px-3 py-1"
            @click="agregar()"
          >
            Guardar
          </button>
          <button
            v-if="edit"
            type="button"
            class="bg-black text-white | mt-5 px-3 py-1"
            @click="update(id_libro)"
          >
            Editar id: {{id_libro}}
          </button>
          <button
            type="button"
            class="bg-gray-600 text-white | mt-5 px-3 py-1"
            @click="limpiar()"
          >
            Limpiar formulario
          </button>
        </div>
      </form>
    </div>
    <!-- Listado de libros -->
    <div v-if="cargar" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    <div v-if="!cargar" class="w-full">
      <h2 class="text-gray-500 text-xs font-medium uppercase tracking-wide">
        Registros en libros
        <i class="fas fa-sync cursor-pointer text-sm" @click="refrescar()" uk-tooltip="title: Refrescar la información; pos: right"></i>
      </h2>
      <ul role="list" class="mt-3 grid grid-cols-1 gap-5 sm:gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <li v-for="libro in timeline" :key="libro.id_libro" class="col-span-1 flex shadow-sm rounded-md">
          <div :class="[id_libro === libro.id_libro ? 'bg-black' : 'bg-blue-500' ,' flex-shrink-0 flex items-center justify-center w-16 text-white text-sm font-medium rounded-l-md cursor-pointer']" @click="editar(libro.id_libro)">
            <i class="fas fa-edit"></i>
          </div>
          <div class="flex-1 flex items-center justify-between border-t border-r border-b border-gray-200 bg-white rounded-r-md truncate">
            <div class="flex-1 px-4 py-2 text-sm truncate">
              <span class="text-gray-900 font-medium hover:text-gray-600">
                {{ libro.created_at | fecha }} <small>ID: {{libro.id_libro}}</small>
              </span>
              <p class="text-gray-500 text-red-700 cursor-pointer" @click="delete_registro(libro.id_libro)"><i class="fas fa-trash-alt"></i> Borrar</p>
            </div>
          </div>
        </li>
      </ul>
      <p v-if="timeline.length === 0" class="w-full py-2 | text-center text-sm font-bold | text-white bg-yellow-500">
        No hay registros de este cliente en libros
      </p>
    </div>
  </section>
</section>

<script>
  const inputs = [
    'id_libro',
    'cliente_id',
    'lejosODEsferico',
    'lejosODCilindrico',
    'lejosODEje',
    'lejosODTriangulo',
    'lejosODBase',
    'lejosODDp',
    'cercaODEsferico',
    'cercaODCilindrico',
    'cercaODEje',
    'cercaODTriangulo',
    'cercaODBase',
    'cercaODDp',
    'lejosOIEsferico',
    'lejosOICilindrico',
    'lejosOIEje',
    'lejosOITriangulo',
    'lejosOIBase',
    'lejosOIDp',
    'cercaOIEsferico',
    'cercaOICilindrico',
    'cercaOIEje',
    'cercaOITriangulo',
    'cercaOIBase',
    'cercaOIDp',
    'doctor',
    'armazon',
    'cristales',
    'observaciones'
  ];
  let app = new Vue({
    el: '#libros',
    data() {
      <?php $uri = new \CodeIgniter\HTTP\URI(uri_string(true)); ?>
      return {
        cliente_id: '<?=$uri->getSegment(2);?>', // Capturar el id al cargar la pagina
        cargar: true,
        edit: false,
        clienteInfo: [],
        id_libro: '',
        lejosODEsferico: '',
        lejosODCilindrico: '',
        lejosODEje: '',
        lejosODTriangulo: '',
        lejosODBase: '',
        lejosODDp: '',
        cercaODEsferico: '',
        cercaODCilindrico: '',
        cercaODEje: '',
        cercaODTriangulo: '',
        cercaODBase: '',
        cercaODDp: '',
        lejosOIEsferico: '',
        lejosOICilindrico: '',
        lejosOIEje: '',
        lejosOITriangulo: '',
        lejosOIBase: '',
        lejosOIDp: '',
        cercaOIEsferico: '',
        cercaOICilindrico: '',
        cercaOIEje: '',
        cercaOITriangulo: '',
        cercaOIBase: '',
        cercaOIDp: '',
        errores: null,
        doctor: '',
        armazon: '',
        cristales: '',
        observaciones: '',
        timeline: [],
      }
    },
    methods: {
      agregar: function (){
        const params = new URLSearchParams();
        // Adjuntar al params los valores de los inputs
        if(clienteInfo.rut !== '') { 
          inputs.forEach(input => {
              if(this[input] !== ''){ {
                params.append(`${input}`, this[input]);
              }
            }
          });

          axios
            .post('<?=base_url('rest-libros')?>', params)
            .then(
              response => {
                // console.log(response.data);
                if(response.data.code === 500) {
                    console.log(response.data.msj);
                    this.errores = response.data.msj;
                } else {
                  // Limpiar los v-models de los inputs menos el cliente_id
                  inputs.forEach(input => {
                    (input !== 'cliente_id') && (this[input] = '');
                  });
                  this.refrescar();
                }
              }
            )
        } else {
          this.errores = 'Debe seleccionar un cliente';
          console.log('Debe seleccionar un cliente');
        }
      },
      editar: function(id_libro) {
        this.id_libro = id_libro;
        this.edit = true;

        axios
          .get(`<?=base_url('rest-libros')?>/` + this.id_libro)
          .then(
            response => {
              if(response.data.code === 500) {
                  console.log(response.data.msj);
                  this.errores = response.data.msj;
              } else {
                const {data} = response.data;
                this.lejosODEsferico = data.lejosODEsferico !== null ? data.lejosODEsferico : '';
                this.lejosODCilindrico = data.lejosODCilindrico !== null ? data.lejosODCilindrico : '';
                this.lejosODEje = data.lejosODEje !== null ? data.lejosODEje : '';
                this.lejosODTriangulo = data.lejosODTriangulo !== null ? data.lejosODTriangulo : '';
                this.lejosODBase = data.lejosODBase !== null ? data.lejosODBase : '';
                this.lejosODDp = data.lejosODDp !== null ? data.lejosODDp : '';
                this.cercaODEsferico = data.cercaODEsferico !== null ? data.cercaODEsferico : '';
                this.cercaODCilindrico = data.cercaODCilindrico !== null ? data.cercaODCilindrico : '';
                this.cercaODEje = data.cercaODEje !== null ? data.cercaODEje : '';
                this.cercaODTriangulo = data.cercaODTriangulo !== null ? data.cercaODTriangulo : '';
                this.cercaODBase = data.cercaODBase !== null ? data.cercaODBase : '';
                this.cercaODDp = data.cercaODDp !== null ? data.cercaODDp : '';
                this.lejosOIEsferico = data.lejosOIEsferico !== null ? data.lejosOIEsferico : '';
                this.lejosOICilindrico = data.lejosOICilindrico !== null ? data.lejosOICilindrico : '';
                this.lejosOIEje = data.lejosOIEje !== null ? data.lejosOIEje : '';
                this.lejosOITriangulo = data.lejosOITriangulo !== null ? data.lejosOITriangulo : '';
                this.lejosOIBase = data.lejosOIBase !== null ? data.lejosOIBase : '';
                this.lejosOIDp = data.lejosOIDp !== null ? data.lejosOIDp : '';
                this.cercaOIEsferico = data.cercaOIEsferico !== null ? data.cercaOIEsferico : '';
                this.cercaOICilindrico = data.cercaOICilindrico !== null ? data.cercaOICilindrico : '';
                this.cercaOIEje = data.cercaOIEje !== null ? data.cercaOIEje : '';
                this.cercaOITriangulo = data.cercaOITriangulo !== null ? data.cercaOITriangulo : '';
                this.cercaOIBase = data.cercaOIBase !== null ? data.cercaOIBase : '';
                this.cercaOIDp = data.cercaOIDp !== null ? data.cercaOIDp : '';
                this.doctor = data.doctor !== null ? data.doctor : '';
                this.armazon = data.armazon !== null ? data.armazon : '';
                this.cristales = data.cristales !== null ? data.cristales : '';
                this.observaciones = data.observaciones !== null ? data.observaciones : '';
              }
            }
          )
      },
      update: function(id_libro) {
        const params = new URLSearchParams();
        // Adjuntar al params los valores de los inputs
        inputs.forEach(input => {
            if(this[input] !== null){ {
              console.log(`${input}`, this[input]);
              params.append(`${input}`, this[input]);
            }
          }
        });
        
        axios
          .put(`<?=base_url('rest-libros')?>/` + this.id_libro, params)
          .then(
            response => {
              if(response.data.code === 500) {
                  console.log(response.data.msj);
                  this.errores = response.data.msj;
                  Swal.fire({
                      title: 'Registro no actualizado',
                      icon: 'error',
                      confirmButtonText: 'Confirmar'
                  });
              } else {
                this.limpiar();
                this.refrescar();
                Swal.fire({
                  position: 'top-end',
                  title: 'Registro en libro actualizado',
                  icon: 'success',
                  showConfirmButton: false,
                  timer: 1500
                });
                this.edit = false;
              }
            }
          )

      },
      delete_registro: function(id_libro) {
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
              .delete(`<?=base_url('rest-libros')?>/` + id_libro)
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
                    this.edit = false;
                    this.refrescar();
                    Swal.fire({
                      position: 'top-end',
                      title: 'Registro en libro eliminado',
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
      limpiar: function (){
        inputs.forEach(input => {
          (input !== 'cliente_id') && (this[input] = '');
        });
        this.edit = false;
      },
      refrescar: async function (){
        this.cargar = true;
        await this.librosUsuarios();
        this.cargar = false;
      },
      librosUsuarios: function (){
        axios.get('<?=base_url('rest-libros/cliente') ?>/' + this.cliente_id)
        .then(
          response => {
            // const { data } = response.data;
            this.timeline = response.data.data;
          }
        )
      },
      cliente: function () {
        axios.get('<?=base_url('rest-clientes') ?>/' + this.cliente_id)
        .then(
          response => {
            const { data } = response.data;
            
            this.clienteInfo = data;
          }
        )

      }
    },
    filters: {
      fecha: function (value) {
        return moment(String(value)).format('MM/DD/YYYY hh:mm')
      }
    },
    created () {
      this.librosUsuarios();
      this.cliente();
      console.log(this.clienteNombre)
      this.cargar = false;
    }
  });
</script>

<?= $this->endSection();?>