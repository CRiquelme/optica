<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Convenios
<?= $this->endSection();?>

<!-- Contenido de la página -->
<?= $this->section('page_content'); ?>

<section id="convenios">
  <article class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
    <!-- Formularios -->
    <div class="uk-width-1-4 uk-margin-large-bottom">
      <!-- Nuevo/Editar -->
      <form class="uk-card uk-card-default uk-card-body">
        <h2 class="text-xl font-bold mb-5 uppercase">Nuevo convenio</h2>
        <fieldset class="uk-fieldset">
          <!-- nombre Empresa -->
          <div class="uk-margin">
            <label class="uk-form-label">Nombre Empresa</label>
            <input v-model="nombre_empresa" class="uk-input" type="text" placeholder="Nombre Empresa">
          </div>
          <!-- Estado -->
          <div class="uk-margin">
            <label class="uk-form-label">Estado</label>
            <div class="uk-form-controls">
              <select v-model="estado" class="uk-select">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
              </select>
            </div>
          </div>
          <!-- Botones de acción -->
          <div class="uk-margin" v-if="action === 'editar'">
            <button class="uk-button uk-button-primary" type="button" @click=agregar() >Editar</button>
            <button class="uk-button uk-button-secondary" type="button" @click=limpiar()>Limpiar</button> 
          </div>
          <div v-if="action==='nuevo'" class="uk-margin">
            <button class="uk-button uk-button-primary uk-width-1-1" type="button" @click="agregar" >Guardar</button>
          </div>
        </fieldset>
      </form>
      <!-- filtros -->
      <div class="uk-card uk-card-default uk-card-body uk-margin-medium-top">
        <h2 class="uk-text-uppercase">FILTROS</h2>
          <!-- Estado -->
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
    <!-- tabla -->
    <div class="uk-width-3-4" uk-grid>

      <table class="uk-table uk-table-divider uk-table-striped uk-table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Empresa</th>
            <th>Estado</th>
            
            <th class="uk-text-center">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- {{valorTienda}} -->
          <tr 
            v-for="(convenio, n) in info" 
            :key="n" 
          >
            <td>
              <button class="uk-button uk-button-link uk-text-success uk-text-bolder" @click="seleccionar(n)">
                <i class="far fa-edit uk-margin-small-left uk-text-success"></i> {{ convenio.id_convenio }}
              </button>
            </td>
            <td>{{ convenio.nombre_empresa}}</td>
            <td>{{ convenio.estado}}</td>
            
            <td class="uk-text-center">
              <i class="fas fa-trash-alt cursor-pointer text-red-500" @click="borrar(convenio.id_convenio)" ></i>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </article>
</section>


<script>
  // Acá se escribe lo de vue (borrar este comentario)
  var app = new Vue({
  el : '#convenios',
  data () {
    return {
        info:[],
        nombre_empresa:null,
        estado:"Activo",
        action:"nuevo",
        id_convenio:null,
        errores:null,
        selected_estado:"Todos"
       }
  },
  created(){
    this.cargar()
  },
  methods:{
    cargar(){
      axios
        .get('<?=base_url('rest-convenios')?>')
        .then(r=>{this.info=r.data.data})
        .catch(e=>console.error(e))
      this.estado="Activo"
      this.nombre_empresa=null
    },
    limpiar(){
      this.action="nuevo"
    },
    limpiarFiltro(){
      cargar()
    },
    agregar(){
      this.errores=null
      if(!this.nombre_empresa){this.errores="Nombre Empresa no puede estar vacío."}
      if(!this.estado){this.errores="Estado del convenio mal definido."}

      if(this.errores){
        this.alertarError(this.errores,'error')
        return;
      }

      const params = new URLSearchParams();
      params.append('nombre_empresa',this.nombre_empresa)
      params.append('estado',this.estado)
      if(this.action==="nuevo"){
        axios
          .post('<?=base_url('rest-convenios')?>', params)
          .then(
            response => {
            if(response.data.code === 500) {
              console.error(response.data.msj)
              this.alertarError("Hubo un problema, intenta nuevamente",'error')
            }else{
              this.cargar()
            }
          })
      }else if(this.action="editar"){
        axios
          .put('<?=base_url('rest-convenios')?>/' + this.id_convenio, params)
          .then(
            response => {
            if(response.data.code === 500) {
              console.error(response.data.msj)
              this.alertarError("Hubo un problema, intenta nuevamente",'error')
            }else{
              this.cargar()
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
          axios.delete('<?=base_url('rest-convenios')?>/' + id)
            .then(()=>{this.cargar()})
        }
      })
    },
    limpiar(){
      this.nombre_empresa=null
      this.id_convenio=null
      this.estado=="Activo"
      this.action="nuevo"
    },
    seleccionar(n){
      this.nombre_empresa=this.info[n].nombre_empresa
      this.id_convenio=this.info[n].id_convenio
      this.estado=this.info[n].estado
      this.action="editar"
    },
    alertarError(title,icon){
      Swal.fire({
          position: 'top-end',
          icon: icon,
          title: title,
          showConfirmButton: false,
          timer: 1500
      })
    }
  },
  watch:{
    selected_estado(val){
      this.cargar()
      if(val!="Todos"){
        this.info=this.info.filter(c=>c.estado===val)
      }
    }
  }
  })
</script>

<?= $this->endSection();?>