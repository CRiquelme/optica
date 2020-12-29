<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Cambio de contraseña
<?= $this->endSection();?>


<?= $this->section('page_content'); ?>

<section class="m-10" id="passowrd">
    <h1 class="text-4xl uppercase border-b-2 pb-5 border-gray-100 mb-4">Cambio de contraseña</h1>

    <div class="grid md:grid-cols-5 gap-4">
        <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
            <?= $this->include('components/sidebar') ?>
        </div>

        <div class="md:row-span-1 md:col-span-4 ">
            <div class="w-full max-w-md">
                <form class="bg-white px-8 pt-6 pb-8 mb-4">
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Contraseña
                        </label>
                        <input v-model="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************" name="password">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirm">
                            Confirmar contraseña
                        </label>
                        <input v-model="password_confirm" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password_confirm" type="password" placeholder="******************" name="password_confirm">

                        <button @click="actualizar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>


<script>
    var app = new Vue({
        el      : '#passowrd',
        data () {
            return {
                password: null,
                password_confirm: null,
                validarPassword: false,
                id: <?=$id_usuario?>,
                errores: null
            }
        },

        methods: {
            actualizar () {
                let self = this
                // console.log("actualizando")
                
                if(this.password === "") {
                    this.password = null
                }
                
                if(this.password_confirm === "") {
                    this.password_confirm = null
                }
                
                if(this.password != null && this.password_confirm != null) {

                    // console.log("Pasó")

                    if(this.password === this.password_confirm) {

                        // console.log(`Son iguales ${this.password} y ${this.password_confirm}`)

                        const params = new URLSearchParams();

                        if(this.passowrd !== null) {
                            params.append('password', this.password);
                        }

                        id = this.id;

                        axios
                        .put('<?=base_url('rest-usuario')?>/' + id, params)
                        .then(
                            response => {
                                // console.log(response.data);

                                if(response.data.code === 500) {
                                    // console.log(response.data.msj);
                                    this.errores = response.data.msj;
                                    Swal.fire({
                                        title: 'No actualizado',
                                        icon: 'error',
                                        confirmButtonText: 'Confirmar'
                                    });
                                } else {
                                    this.errores = null;

                                    Swal.fire({
                                        position: 'top-end',
                                        title: 'Contraseña actualizada',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            }
                        );
                    } else {
                        // console.log(`Son diferentes ${this.password} y ${this.password_confirm}`)
                        Swal.fire({
                            position: 'top-end',
                            title: 'Debe ingresar la misma contraseña',
                            icon: 'info',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }


                
            }
        }
    })
</script>

<?= $this->endSection();?>