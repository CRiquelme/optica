<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Registro en sobre
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
<!-- <section id="sobre">
    <article class="uk-margin-medium-right -left uk-margin-medium-top uk-text-center">
        <titulo></titulo>
    </article> -->

<section class="m-10" id="sobre">
    <h1 class="text-4xl uppercase border-b-2 pb-5 border-gray-100 mb-4">Registro sobre</h1>

    <div class="grid md:grid-cols-5 gap-4">
        <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
            <?= $this->include('components/sidebar') ?>
        </div>

        <div class="md:row-span-1 md:col-span-4 ">
            <form-wizard next-button-text="Siguiente" back-button-text="Anterior" finish-button-text="Terminar" title="" subtitle="" color="#009db0" shape="circle" step-size="sm">
                <tab-content title="" class="uk-width-1-1" uk-grid>
                    <!-- nombre, rut, tipo_de_lente, numero_pedido, fono, email, -->
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label uk-text-uppercase" for="rut">rut</label>
                        <input @change="todos_sobres" v-model="rut" class="uk-input" id="rut" name="rut" type="text" placeholder="rut">
                    </div>            
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label uk-text-uppercase" for="nombre">Nombre</label>
                        <input v-model="nombre" class="uk-input" id="nombre" name="nombre" type="text" placeholder="Nombre">
                    </div>            
                    <div class="uk-width-1-4@s">
                        <div class="uk-form-label uk-text-uppercase">Tipo de lente</div>
                        <div class="uk-form-controls uk-form-controls-text">
                            <label><input class="uk-radio" type="radio" name="tipo_de_lente" value="optico" v-model="tipo_de_lente"> Óptico</label><br>
                            <label><input class="uk-radio" type="radio" name="tipo_de_lente" value="contacto" v-model="tipo_de_lente"> Contacto</label>
                        </div>
                    </div>
                    <div class="uk-width-1-4@s">
                        <label class="uk-form-label uk-text-uppercase" for="numero_pedido">número pedido</label>
                        <input v-model="numero_pedido" class="uk-input" id="numero_pedido" name="numero_pedido" type="text" placeholder="Número pedido">
                    </div>            
                    <div class="uk-width-1-4@s">
                        <label class="uk-form-label uk-text-uppercase" for="fono">Fono</label>
                        <input v-model="fono" class="uk-input" id="fono" name="fono" type="text" placeholder="Fono">
                    </div>            
                    <div class="uk-width-1-4@s">
                        <label class="uk-form-label uk-text-uppercase" for="email">Email</label>
                        <input v-model="email" class="uk-input" id="email" name="email" type="text" placeholder="Email">
                    </div>
                </tab-content>

                <tab-content title="" class="uk-width-1-1" uk-grid>
                    <!-- Lejos -->
                    <div class="uk-width-1-1">
                        <h2 class="uk-text-center uk-text-uppercase uk-heading-line"><span>Lejos</span></h2>
                    </div>
                    <!-- OI, ESF1, CIL1 -->
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="lejos_od">od</label>
                        <input v-model="lejos_od" class="uk-input" id="lejos_od" name="lejos_od" type="text" placeholder="OD">
                    </div>
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="lejos_esf1">ESF</label>
                        <input v-model="lejos_esf1" class="uk-input" id="lejos_esf1" name="lejos_esf1" type="text" placeholder="ESF">
                    </div>
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="lejos_cil1">cil</label>
                        <input v-model="lejos_cil1" class="uk-input" id="lejos_cil1" name="lejos_cil1" type="text" placeholder="CIL">
                    </div>
                    <!-- OI, ESF2, CIL2 -->
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="lejos_oi">oi</label>
                        <input v-model="lejos_oi" class="uk-input" id="lejos_oi" name="lejos_oi" type="text" placeholder="OI">
                    </div>
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="lejos_esf2">ESF</label>
                        <input v-model="lejos_esf2" class="uk-input" id="lejos_esf2" name="lejos_esf2" type="text" placeholder="ESF">
                    </div>
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="lejos_cil2">cil</label>
                        <input v-model="lejos_cil2" class="uk-input" id="lejos_cil2" name="lejos_cil2" type="text" placeholder="CIL">
                    </div>
                </tab-content>

                <tab-content title="" class="uk-width-1-1" uk-grid>
                    <!-- Cerca -->
                    <div class="uk-width-1-1 ">
                        <h2 class="uk-text-center uk-text-uppercase uk-heading-line"><span>Cerca</span></h2>
                    </div>
                    <!-- OI, ESF1, CIL1 -->
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="cerca_od">od</label>
                        <input v-model="cerca_od" class="uk-input" id="cerca_od" name="cerca_od" type="text" placeholder="OD">
                    </div>
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="cerca_esf1">ESF</label>
                        <input v-model="cerca_esf1" class="uk-input" id="cerca_esf1" name="cerca_esf1" type="text" placeholder="ESF">
                    </div>
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="cerca_cil1">cil</label>
                        <input v-model="cerca_cil1" class="uk-input" id="cerca_cil1" name="cerca_cil1" type="text" placeholder="CIL">
                    </div>
                    <!-- OI, ESF2, CIL2 -->
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="cerca_oi">oi</label>
                        <input v-model="cerca_oi" class="uk-input" id="cerca_oi" name="cerca_oi" type="text" placeholder="OI">
                    </div>
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="cerca_esf2">ESF</label>
                        <input v-model="cerca_esf2" class="uk-input" id="cerca_esf2" name="cerca_esf2" type="text" placeholder="ESF">
                    </div>
                    <div class="uk-width-1-3@s ">
                        <label class="uk-form-label uk-text-uppercase" for="cerca_cil2">cil</label>
                        <input v-model="cerca_cil2" class="uk-input" id="cerca_cil2" name="cerca_cil2" type="text" placeholder="CIL">
                    </div>
                </tab-content>

                <tab-content title="" class="uk-width-1-1" uk-grid>
                    <!-- ADD, DP, H -->
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label uk-text-uppercase" for="cerca_add">ADD</label>
                        <input v-model="cerca_add" class="uk-input" id="cerca_add" name="cerca_add" type="text" placeholder="ADD">
                    </div>
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label uk-text-uppercase" for="cerca_dp">D.P</label>
                        <input v-model="cerca_dp" class="uk-input" id="cerca_dp" name="cerca_dp" type="text" placeholder="D.P">
                    </div>
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label uk-text-uppercase" for="cerca_h">H</label>
                        <input v-model="cerca_h" class="uk-input" id="cerca_h" name="cerca_h" type="text" placeholder="H">
                    </div>
                    
                    <!-- Tipo_de_cristal, lejos, cerca -->
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label uk-text-uppercase" for="tipo_de_cristal">Tipo de cristal</label>
                        <textarea v-model="tipo_de_cristal" class="uk-textarea" id="tipo_de_cristal" name="tipo_de_cristal"></textarea>
                    </div>
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label uk-text-uppercase" for="lejos">Lejos</label>
                        <textarea v-model="lejos" class="uk-textarea" id="lejos" name="lejos"></textarea>
                    </div>
                    <div class="uk-width-1-3@s">
                        <label class="uk-form-label uk-text-uppercase" for="cerca">Cerca</label>
                        <textarea v-model="cerca" class="uk-textarea" id="cerca" name="cerca"></textarea>
                    </div>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label uk-text-uppercase" for="profesional">Profesional</label>
                        <input v-model="profesional" class="uk-input" id="profesional" name="profesional" type="text" placeholder="Profesional">
                    </div>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label uk-text-uppercase" for="fecha_de_receta">fecha de receta</label>
                        <input v-model="fecha_de_receta" class="uk-input" id="fecha_de_receta" name="fecha_de_receta" type="date" placeholder="fecha de receta">
                    </div>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label uk-text-uppercase" for="armazon_lejos">armazon lejos</label>
                        <input v-model="armazon_lejos" class="uk-input" id="armazon_lejos" name="armazon_lejos" type="text" placeholder="Armazon lejos">
                    </div>
                    <div class="uk-width-1-2@s">
                        <label class="uk-form-label uk-text-uppercase" for="armazon_cerca">Armazon cerca</label>
                        <input v-model="armazon_cerca" class="uk-input" id="armazon_cerca" name="armazon_cerca" type="text" placeholder="armazon cerca">
                    </div>
                </tab-content>

                <tab-content title="" class="uk-width-1-1" uk-grid>

                    <div class="uk-child-width-1-2 uk-width-1-1 uk-text-center" uk-grid>
                        <div>
                            <label class="uk-form-label uk-text-uppercase">Forma de pago</label>
                            <br>
                            <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" value="CH"> CH </label>
                            <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" value="OC"> OC </label>
                            <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" value="EF"> EF </label>
                            <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" value="TF"> TF</label>
                            <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" value="TBK"> TBK</label>
                            <label class="uk-margin-small-right"><input class="uk-checkbox" type="checkbox" v-model="forma_de_pago" value="CD"> CD</label>
                            
                        </div>

                        <div class="uk-child-width-1-3" uk-grid>
                            <div>
                                <label class="uk-form-label uk-text-uppercase" for="total">Total</label>
                                <input v-model="total" class="uk-input" id="total" name="total" type="text" placeholder="Total">
                            </div>
                            <div>
                                <label class="uk-form-label uk-text-uppercase" for="abono">abono</label>
                                <input v-model="abono" class="uk-input" id="abono" name="abono" type="text" placeholder="Abono">
                            </div>
                            <div>
                                <label class="uk-form-label uk-text-uppercase" for="saldo">saldo</label>
                                <input v-model="saldo" class="uk-input" id="saldo" name="saldo" type="text" placeholder="Saldo">
                            </div>
                        </div>
                    </div>

                    <div class="uk-width-1-1@s">
                        <label class="uk-form-label uk-text-uppercase" for="observaciones">observaciones</label>
                        <textarea v-model="observaciones" class="uk-textarea" id="observaciones" name="observaciones"></textarea>
                    </div>

                </tab-content>
                
                </form-wizard>
            </form>
        </div>
    </div>

</section>


<script>
Vue.use(VueFormWizard);
Vue.component('v-select', VueSelect.VueSelect);

Vue.component('titulo', {
    template: '<h1 class="uk-text-uppercase uk-text-center">{{titulo}}</h1>',
    data: function() {
        return { titulo: 'Registro sobre' }
    }
});

var app = new Vue({
    el      : '#sobre',
    data () {
        return {
            rut  : '',
            nombre: '',
            tipo_de_lente : '',
            numero_pedido: '',
            fono: '',
            email: '',
            lejos_od: '',
            lejos_esf1: '',
            lejos_cil1: '',
            lejos_oi: '',
            lejos_esf2: '',
            lejos_cil2: '',
            cerca_od: '',
            cerca_esf1: '',
            cerca_cil1: '',
            cerca_oi: '',
            cerca_esf2: '',
            cerca_cil2: '',
            cerca_add: '',
            cerca_dp: '',
            cerca_h: '',
            tipo_de_cristal: '',
            lejos: '',
            cerca: '',
            profesional: '',
            fecha_de_receta: '',
            armazon_lejos: '',
            armazon_cerca: '',
            total: '',
            abono: '',
            saldo: '',
            observaciones: '',
            forma_de_pago: [],
            allSobres: null
        }
    },
    methods: {
        todos_sobres () {
            let self = this
            let rut = self.rut
            axios
                .get('<?=base_url('rest-sobre')?>/' + rut)
                .then(response => (
                        self.allSobres       = response.data.data
                    ));
        }
    }

});


</script>

<?= $this->endSection();?>