<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Infome de stock precios
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
<section id="informe">

    <article class="mx-20 my-5">
        <h1 class="text-4xl uppercase">Informe de precios stock <i class="fas fa-sync cursor-pointer text-2xl" @click="getInfo()" uk-tooltip="title: Refrescar la información; pos: right"></i></h1>
    </article>

    <div v-if="cargar" class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>

    <div v-if="!cargar" class="flex flex-wrap mb-2 mx-20 my-5">
        <div class="flex-1 bg-green-800 text-white px-10 py-5">
            <h2 class="text-2xl font-bold text-white">UV OPTIK PUQ</h2>
            <div class="flex flex-wrap pt-3">
                <div class="flex-1 text-lg">
                   Stock precio de compra:<br><b class="text-2xl">{{ totalST1Compra | money }}</b>
                </div>
                <div class="flex-1 text-lg">
                    Stock precio de venta:<br><b class="text-2xl">{{ totalST1Venta | money }}</b>
                </div>
            </div>
        </div>
        <div class="flex-1 bg-blue-800 text-white px-10 py-5">
            <h2 class="text-2xl font-bold text-white">UV OPTIK NATALES</h2>
            <div class="flex flex-wrap pt-3">
                <div class="flex-1 text-lg">
                   Stock precio de compra:<br><b class="text-2xl">{{ totalST2Compra | money }}</b>
                </div>
                <div class="flex-1 text-lg">
                    Stock precio de venta:<br><b class="text-2xl">{{ totalST2Venta | money }}</b>
                </div>
            </div>
        </div>
        <div class="flex-1 bg-red-800 text-white px-10 py-5">
            <h2 class="text-2xl font-bold text-white">OM</h2>
            <div class="flex flex-wrap pt-3">
                <div class="flex-1 text-lg">
                   Stock precio de compra:<br><b class="text-2xl">{{ totalST3Compra | money }}</b>
                </div>
                <div class="flex-1 text-lg">
                    Stock precio de venta:<br><b class="text-2xl">{{ totalST3Venta | money }}</b>
                </div>
            </div>
        </div>
    </div>
    
    <h2 v-if="!cargar" class="text-3xl | mt-10 mx-20">Detalle por tienda</h2>
    <ul uk-accordion v-if="!cargar" class="flex flex-wrap mb-2 mx-20 my-5">
        <?php for ($i = 1; $i <= 3; $i++) : ?>
            <li class="w-full bg-gray-200 px-3 py-2">
                <?php if($i === 1) : ?>
                    <a class="uk-accordion-title" href="#">UV OPTIK PUQ</a>
                    <?php $tienda = "uv_optik_puq"; ?>
                <?php elseif($i === 2) : ?>
                    <a class="uk-accordion-title" href="#">UV OPTIK NATALES</a>
                    <?php $tienda = "uv_optik_natales"; ?>
                <?php elseif($i === 3) : ?>
                    <a class="uk-accordion-title" href="#">OM</a>
                    <?php $tienda = "om"; ?>
                <?php endif; ?>
                <div class="uk-accordion-content">
                    <table  class="uk-table uk-table-striped uk-table-hover" id="<?=$tienda?>">
                        <thead>
                            <tr>
                                <th>Código de barras</th>
                                <th>Producto</th>
                                <th>Precio de compra</th>
                                <th>Precio de venta</th>
                                <th>Stock</th>
                                <th>Total precio de compra</th>
                                <th>Total precio de venta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($i === 1) : ?>
                                <tr v-for="(st1, idDetalle1) in stockTienda1" :key="idDetalle1">
                            <?php elseif($i === 2) : ?>
                                <tr v-for="(st1, idDetalle2) in stockTienda2" :key="idDetalle2">
                            <?php elseif($i === 3) : ?>
                                <tr v-for="(st1, idDetalle3) in stockTienda3" :key="idDetalle3">
                            <?php endif; ?>
                                <td>{{ st1.cod_barra }}</td>
                                <td>{{ st1.modelo }}</td>
                                <td>{{ st1.precio_unitario | money }}</td>
                                <td>{{ st1.precio_venta | money }}</td>
                                <td>{{ st1.stock }}</td>
                                <td>{{ st1.total_precio_compra_stock | money }}</td>
                                <td>{{ st1.total_precio_venta_stock | money }}</td>
                            </tr>
                        <tbody>
                    </table>
                </div>
            </li>
        <?php endfor; ?>
    </ul>
</section>

<script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>
<script>
var app = new Vue({
    el      : '#informe',
    data () {
        return {
            info: null,
            cargar: true,
            stockTienda1: null,
            stockTienda2: null,
            stockTienda3: null,
        }
    },
    methods: {
        getInfo: function() {
            this.cargar = true;
            let url = "<?=base_url('rest-stock/estadisticaStock')?>";
            axios
                .get(url)
                .then(response => {
                    this.info = response.data.data;
                    this.cargar = false;
                    this.stockTienda1 = this.info.filter(st => st.tienda_id === "1");
                    this.stockTienda2 = this.info.filter(st => st.tienda_id === "2");
                    this.stockTienda3 = this.info.filter(st => st.tienda_id === "3");

                    $(function() {
                        var table = $('#uv_optik_puq').DataTable( 
                            {
                                "order": [ 0, "desc" ],
                                "info": false,
                                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
                            }
                        )
                    });
                    
                    $(function() {
                        var table = $('#uv_optik_natales').DataTable( 
                            {
                                "order": [ 0, "desc" ],
                                "info": false,
                                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
                            }
                        )
                    });
                    
                    
                    $(function() {
                        var table = $('#om').DataTable( 
                            {
                                "order": [ 0, "desc" ],
                                "info": false,
                                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                                "language": { "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json" }
                            }
                        )
                    });

                })
        },
    },

    computed: {
        totalST1Compra: function(){
            let total_compra_st1 = this.stockTienda1.reduce((a, {total_precio_compra_stock}) => a + parseInt(total_precio_compra_stock), 0)
            return total_compra_st1;
        },
        totalST1Venta: function(){
            let total_st1 = this.stockTienda1.reduce((a, {total_precio_venta_stock}) => a + parseInt(total_precio_venta_stock), 0)
            return total_st1;
        },
        totalST2Compra: function(){
            let total_compra_st2 = this.stockTienda2.reduce((a, {total_precio_compra_stock}) => a + parseInt(total_precio_compra_stock), 0)
            return total_compra_st2;
        },
        totalST2Venta: function(){
            let total_st2 = this.stockTienda2.reduce((a, {total_precio_venta_stock}) => a + parseInt(total_precio_venta_stock), 0)
            return total_st2;
        },
        totalST3Compra: function(){
            let total_compra_st3 = this.stockTienda3.reduce((a, {total_precio_compra_stock}) => a + parseInt(total_precio_compra_stock), 0)
            return total_compra_st3;
        },
        totalST3Venta: function(){
            let total_st3 = this.stockTienda3.reduce((a, {total_precio_venta_stock}) => a + parseInt(total_precio_venta_stock), 0)
            return total_st3;
        },
    },

    created () {
        this.getInfo()
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

})
</script>

<?= $this->endSection();?>