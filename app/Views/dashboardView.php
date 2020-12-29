<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Dashboard
<?= $this->endSection();?>


<?= $this->section('page_content'); ?>

<section class="m-10" id="dashboard">
    <h1 class="text-4xl uppercase border-b-2 pb-5 border-gray-100 mb-4">Dashboard</h1>

    <div class="grid md:grid-cols-5 gap-4">
        <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
            <?= $this->include('components/sidebar') ?>
        </div>
        
        <div class="md:row-span-1 md:col-span-4">
            <div class="grid md:grid-cols-5 gap-4">
            <!-- <div class="grid grid-rows-4 grid-flow-col gap-4"> -->
                <div class="md:row-span-4 md:col-span-2 px-4">
                    <h2 class="my-4 flex-none uppercase">Buscar producto <small>(código de barras)</small></h2>
                    <input @keyup="buscarCodigoBarra()" id="searchProduct" v-model="searchProduct" class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="text" placeholder="12345">
                    <button @click="limpiar_buscador_productos" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white focus:outline-none py-2 px-4 border border-blue-500 hover:border-transparent rounded-lg my-3">Limpiar</button>
                </div>
                <div class="md:row-span-4 md:col-span-2 px-4">

                    <div 
                        class="pt-4"
                        v-for="(i, index) in info" 
                        v-if="i.cod_barra === searchProduct "
                    >
                        <h3 class="text-lg uppercase font-bold">{{ i.modelo }} - {{ i.nombre_marca }} - {{ i.precio_venta | clp }}</h3>
                    </div>
                    <ul v-if="buscarStock != 0">
                        <li
                            class=""
                            v-for="(s, index) in buscarStock" 
                            :key="`${s.cod_barra}${index}`" 
                        >
                            <!-- <template v-if="s.cod_barra === searchProduct"> -->
                                {{ s.tienda }}, <span class="">stock: <b>{{ s.stock }}</b></span> 
                                <!-- <span v-if="s.stock <= s.stock_critico">🤏 </span>
                                <span v-else-if="s.stock == 0">👎 </span>
                                <span v-else>👍</span> -->
                            <!-- </template> -->
                        </li>
                    </ul>
                    <ul v-else>
                        <li>Sin información del producto</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="md:row-span-1 md:col-span-4 ">
            <div class="grid grid-rows-4 grid-flow-col gap-4">
                <div class="md:row-span-4 md:col-span-1 px-4">
                    <h2 class="my-4  flex-none uppercase">Productos con stock igual o bajo el crítico</h2>
                    <ul class="my-4 "  >
                        <li v-for="(s, index) in stock" :key="index.producto_id">
                            <template v-if="parseInt(s.stock) <= parseInt(s.stock_critico)">
                                {{ s.producto }} en {{ s.tienda }}, <span class="text-pink-600">stock: <b>{{ s.stock }}</b></span> || <span class="text-pink-800">stock crítico: <b>{{ s.stock_critico }}</b></span>
                                <!-- <span v-if="parseInt(s.stock) < parseInt(s.stock_critico)">Es menor</span>
                                <span v-if="parseInt(s.stock) === parseInt(s.stock_critico)">Es igual</span>
                                <span v-if="parseInt(s.stock) > parseInt(s.stock_critico)">Es mayor</span> -->
                            </template >
                        </li>
                    </ul>
                </div>

                <div class="md:row-span-4 md:col-span-2 px-4">
                    
                </div>
            </div>
        </div>


    </div>
</section>


<script>
    var app = new Vue({
        el      : '#dashboard',
        data () {
            return {
                info: null,
                marcas: null,
                marcasUnicas: null,
                stock: null,
                searchProduct: null,
                searchProducts: null,
                buscarStock: null
            }
        },
        
        methods: {
            limpiar_buscador_productos: function () {
                this.searchProduct = null;
                this.buscarStock = null
                document.getElementById("searchProduct").focus();
            },

            buscarCodigoBarra: function() {
                var self = this
                if(self.searchProduct != '') {
                    self.searchProducts = self.searchProduct
                } else {
                    self.searchProducts = 0; 
                }
                axios
                    .get('<?=base_url("rest-stock/show-codigo")?>/' + self.searchProducts)
                    .then(response => (self.buscarStock = response.data.data));
            }
        },

        filters: {
            clp: function(value) {
                if(!value) return ''
                return new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(value)
            }
        },

        created () {
            const self = this
            axios
                .get('<?=base_url('rest-productos')?>')
                .then(response => (
                        this.info = response.data.data,
                        this.marcas = response.data.data.map(marca => marca.nombre_marca),
                        this.marcasUnicas = [...new Set(this.marcas)]
                    )
                )
            axios
                .get('<?=base_url('rest-stock')?>')
                .then(response => (self.stock = response.data.data));
        },

        mounted () {
            this.limpiar_buscador_productos()
            
        }
    })
</script>
<?= $this->endSection();?>