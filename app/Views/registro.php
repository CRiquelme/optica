<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Registro de usuario
<?= $this->endSection();?>


<?= $this->section('page_content'); ?>

<section class="m-10" id="registro">
    <h1 class="text-4xl uppercase border-b-2 pb-5 border-gray-100 mb-4">Registro de usuario</h1>

    <div class="grid md:grid-cols-5 gap-4">
        <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
            <?= $this->include('components/sidebar') ?>
        </div>

        <div class="md:row-span-1 md:col-span-4 ">
            <template class="w-full max-w-4xl mx-auto pt-10">
                <dl v-for="e in errores" class="mb-2 bg-red-100 py-2">
                    <dt class="text-red-700 border-l-4 border-red-600 pl-3">{{ e }}</dt>
                </dl>
            </template>

            <form class="w-full max-w-4xl mx-auto pt-10">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">Nombre</label>
                        <input v-model="nombre" type="text" id="nombre" name="nombre" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ap_pat">Apellido paterno</label>
                        <input v-model="ap_pat" type="text" id="ap_pat" name="ap_pat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ap_mat">Apellido materno</label>
                        <input v-model="ap_mat" type="text" id="ap_mat" name="ap_mat" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
                    
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">E-mail</label>
                        <input v-model="email" type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    </div> 

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="username">Nombre de usuario</label>
                        <input v-model="username" type="username" id="username" name="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0 ">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="tipo_de_usuario">Tipo de usuario</label>
                        <div class="relative">
                            <select v-model="tipo_de_usuario" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="tipo_de_usuario">
                                <option v-for="(tu, itu ) in tipo_usuario" :value="itu">{{ tu }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">Password</label>
                        <input v-model="password" type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password_confirm">Confirmación de password</label>
                        <input v-model="password_confirm" type="password" id="password_confirm" name="password_confirm" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>

                <div v-if="action === 'editar'">
                    <button class="uppercase bg-blue-800 hover:bg-blue-300 text-blue-200 hover:text-blue-800 font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded" type="button" @click="update(id_usuario)"><i class="far fa-edit"></i> Editar datos del usuario</button>
                    <button class="uppercase bg-gray-800 hover:bg-gray-700 text-white font-bold py-2 px-4 border-b-4 border-gray-700 hover:border-gray-500 rounded" type="button" @click="limpiar_form()"><i class="fas fa-eraser"></i> Limpiar formulario para agregar nuevo usuario</button> 
                </div>
                <div v-else>
                    <button @click="registrar" class="uppercase font-medium bg-blue-900 hover:bg-blue-200 text-blue-200 hover:text-blue-900 py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="button">
                        <i class="far fa-save"></i> Registrar usuario
                    </button>
                </div>
            </form>
        
            <div v-if="cargar" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

            <table v-else class="uk-table uk-table-divider uk-table-striped uk-table-hover w-full">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>E-mail</th>
                        <th>Nombre de usuario</th>
                        <th>Tipo de usuario</th>
                        <th class="uk-text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-for="(i, idinfo) in info" 
                        :key="i.id_usuario" 
                    >
                        <td><span @click="editar(idinfo, i.id_usuario)" class="text-green-700 hover:no-underline hover:text-green-900 outline-none cursor-pointer"><i class="far fa-edit text-green-700 hover:text-green-900"></i> {{ i.nombre }} {{ i.ap_pat }}</span></td>
                        <td>{{ i.email }}</td>
                        <td>{{ i.username }}</td>
                        <td>{{ tipo(i.tipo_de_usuario) }}</td>
                        <td class="uk-text-center">
                            <button @click="delete_usuario(idinfo, i.id_usuario)" class="uk-button uk-button-link uk-text-danger uk-text-bolder"><i class="fas fa-trash-alt uk-margin-small-left uk-text-danger"></i> Eliminar usuario</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</section>

<script>
    var app = new Vue({
        el      : '#registro',
        data () {
            return {
                info: null,
                id_usuario: '',
                nombre: '',
                ap_pat: '',
                ap_mat: '',
                email: '',
                username: '',
                tipo_de_usuario: '',
                password: '',
                password_confirm: '',
                errores: [],
                error: false,
                cargar: true,
                tipo_usuario: ['Admin', 'ventas', 'Consultas'],
                action: 'guardar',
                infoedit: '',
                usernames: []
            }
        },
        computed: {
        },
        methods: {
            tipo(id) {
                if (id == 0) return 'Admin'
                if (id == 1) return 'ventas'
                if (id == 2) return 'Consultas'
                return '---'
            },
            limpiar_form: function() {
                let self = this
                this.action  = 'guardar',
                self.id_usuario = '',
                self.nombre = '',
                self.ap_pat = '',
                self.ap_mat = '',
                self.email = '',
                self.username = '',
                self.password = '',
                self.password_confirm = ''
            },
            registrar () {
                let self = this

                this.errores = []
                
                const params = new URLSearchParams();

                if(this.nombre !== '') {
                    params.append('nombre', this.nombre);
                }
                if(this.ap_pat !== '') {
                    params.append('ap_pat', this.ap_pat);
                }
                if(this.ap_mat !== '') {
                    params.append('ap_mat', this.ap_mat);
                }
                if(this.email !== '') {
                    params.append('email', this.email);
                }
                if(this.username !== '') {
                    params.append('username', this.username);
                }
                if(this.tipo_de_usuario !== '') {
                    params.append('tipo_de_usuario', this.tipo_de_usuario);
                }
                if(this.password !== '') {
                    params.append('password', this.password);
                }

                // Validaciones
                if(this.username === '' ) {
                     this.error = true
                     this.errores.push("Requiere un nombre de usuario")
                } else {
                    this.error = false
                    for(let i = 0; i < this.usernames.length; i++) {
                        // console.log(this.usernames[i])
                        if(this.username === this.usernames[i] ) {
                            this.error = true
                            this.errores.push("El nombre de usuario ya existe")
                        } else {
                            this.error = false
                        }
                    }
                }
                
                if(this.password === '' ) {
                     this.error = true
                     this.errores.push("Requiere password")
                } else {
                    this.error = false
                }
                
                if(this.password != this.password_confirm ) {
                     this.error = true
                     this.errores.push("La confirmación es diferente al password")
                } else {
                    this.error = false
                }


                if(this.errores.length === 0) {
                    axios
                        .post('<?=base_url('rest-usuario')?>', params)
                        .then(
                            response => {
                                console.log(response.data);
                                if(response.data.code === 500) {
                                    // console.log(response.data.msj);
                                    this.errores = response.data.msj;
                                } else {
                                    axios
                                        .get('<?=base_url('rest-usuario')?>')
                                        .then(response => (this.info = response.data.data));
                                    self.nombre             = null;
                                    self.ap_pat             = null;
                                    self.ap_mat             = null;
                                    self.email              = null;
                                    self.username           = null;
                                    self.tipo_de_usuario    = null;
                                    self.password           = null;
                                    self.password_confirm   = null;
                                }
                            }
                        );
                    Swal.fire({
                        position: 'top-end',
                        title: 'Ingreso de usuario',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        position: 'top-end',
                        title: 'No se ingresó al usuario',
                        icon: 'info',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },
            editar (index, id_usuario) {
                let self = this
                this.action     = 'editar'
                // this.errores    = null;
                // this.id_usuario = id_usuario;
                
                axios
                    .get('<?=base_url('rest-usuario')?>/' + id_usuario)
                    .then(response => (
                        self.id_usuario = response.data.data.id_usuario,
                        self.nombre = response.data.data.nombre,
                        self.ap_pat = response.data.data.ap_pat,
                        self.ap_mat = response.data.data.ap_mat,
                        self.email = response.data.data.email,
                        self.username = response.data.data.username,
                        self.tipo_de_usuario = response.data.data.tipo_de_usuario
                    ));
                console.log(id_usuario)
            },
            update: function(id) {
                console.log('guardando...');
                const params = new URLSearchParams();
                if(this.nombre !== null) {
                    params.append('nombre', this.nombre);
                }
                if(this.ap_pat !== null) {
                    params.append('ap_pat', this.ap_pat);
                }
                if(this.ap_mat !== null) {
                    params.append('ap_mat', this.ap_mat);
                }
                if(this.email !== null) {
                    params.append('email', this.email);
                }
                if(this.username !== null) {
                    params.append('username', this.username);
                }
                if(this.tipo_de_usuario !== null) {
                    params.append('tipo_de_usuario', this.tipo_de_usuario);
                }
                if(this.password !== null) {
                    params.append('password', this.password);
                }
                axios
                    .put('<?=base_url('rest-usuario')?>/' + id, params)
                    .then(
                        response => {
                            console.log(response.data);

                            if(response.data.code === 500) {
                                console.log(response.data.msj);
                                this.errores = response.data.msj;
                                Swal.fire({
                                    title: 'No se ha actualizado',
                                    icon: 'error',
                                    confirmButtonText: 'Confirmar'
                                });
                            } else {
                                axios
                                    .get('<?=base_url('rest-usuario')?>')
                                    .then(response => (this.info = response.data.data));
                                this.errores = null;

                                Swal.fire({
                                    position: 'top-end',
                                    title: 'Actualizado',
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                        }
                    );
            },
            delete_usuario: function(index, id) {
                console.log(index);
                console.log(id);
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
                            axios.delete('<?=base_url('rest-usuario')?>/' + id)
                            .then(response => {
                                this.info.splice(index, 1);
                            });

                            swalWithBootstrapButtons.fire(
                            'Eliminado',
                            'El usuario fue eliminado.',
                            'success'
                            )
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                            'Cancelado',
                            'El usuario se mantiene.',
                            'error'
                            )
                            
                        }
                    });
            }
        },
        created () {
            axios
                .get('<?=base_url('rest-usuario')?>')
                .then(response => (this.info = response.data.data))
                .then(response => (this.cargar = false))
                .then(response => ( 
                                    this.usernames = this.info.map(i => i.username)
                                ) )
        }
    })
</script>

<?= $this->endSection(); // page_content ?>