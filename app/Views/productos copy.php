<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Productos
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>

<section class="m-10" id="productos">
    <div class="mb-4" uk-grid>
        <div>
            <h1 class="text-4xl uppercase">Productos</h1>
        </div> 
        <div class="uk-width-1-6 pos_relative">
            <a class="uk-button uk-button-secondary uk-button-small uk-text-middle uk-position-center" href="#modal-container" uk-toggle onclick="add_producto()">Nuevo</a>
        </div>
    </div>


    <div class="grid md:grid-cols-5 gap-4">
        <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-5 ">
            <?= $this->include('components/sidebar') ?>
        </div>

        <div class="md:row-span-1 md:col-span-4 pt-5 pr-10">
            <table class="uk-table uk-table-striped uk-table-hover" id="table_productos">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Proveedor(es)</th>
                        <th>marca</th>
                        <th>Precio compra</th>
                        <!-- <th>Precio venta</th> -->
                        <th>Stock crítico</th>
                        <th>Código de barra</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($productos as $producto) : ?>
                        <tr>
                            <td>
                                <button class="uk-button uk-button-link uk-text-primary uk-text-bolder" onclick="edit_producto(<?php echo $producto['id_producto'];?>)">
                                    <i class="far fa-edit"></i>
                                    <?=$producto['modelo'];?>
                                </button>
                            </td>
                            <td><?=$producto['nombre_cat_pro'];?></td>
                            <td><?=str_replace(",", "<br>", $producto['nombre_proveedor']);?></td>
                            <td><?=$producto['nombre_marca'];?></td>
                            <td>$<?=$producto['precio_unitario'];?></td>
                            <!-- <td>$<?//=$producto['precio_venta'];?></td> -->
                            <td><?=$producto['stock_critico'];?></td>
                            <!-- https://doersguild.github.io/jQuery.print/ -->
                            <td class="print_barcode" id="<?=$producto['cod_barra']?>" onclick="printBarCode(this.id)">
                            <!-- <td class="uk-text-center" onclick="jQuery.print(this)"> -->
                                <div style="display:flex; align-items: center; justify-content: space-between;">
                                    <div class="print_barcode--barcode">
                                        <?=barcode($producto['cod_barra']);?>
                                        <?=$producto['cod_barra']?>
                                    </div>
                                    <div class="print_barcode--espacio">&nbsp;</div>
                                    <div class="print_barcode--precio">$ <?=number_format($producto['precio_venta'], 0, '0', '.');?></div>
                                </div>
                            </td>
                            <td class="text-center">
                                <button class="uk-button uk-button-link uk-text-danger uk-text-bolder" onclick="delete_producto(<?php echo $producto['id_producto'];?>)"><i class="fas fa-trash-alt uk-margin-small-left uk-text-danger" ></i> Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            
        </div>
    </div>

    <div id="modal-container" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 class="uk-modal-title uk-form-stacked uk-padding-large uk-padding-remove-top uk-padding-remove-bottom uk-text-uppercase">Producto</h2>

            <?php
            // Clases
            $class_productoL    = isset($errores['producto']) ? 'uk-form-label uk-text-danger uk-text-uppercase' : 'uk-form-label uk-text-uppercase';
            $class_producto     = isset($errores['producto']) ? 'uk-input uk-form-danger' : 'uk-input typeahead uk-width-1-1';
            $class_marca_idL       = isset($errores['marca_id']) ? 'uk-form-label uk-text-danger uk-text-uppercase' : 'uk-form-label uk-text-uppercase';
            $class_marca_id        = isset($errores['marca_id']) ? 'uk-input uk-form-danger' : 'uk-input typeahead uk-width-1-1';
            $class_cat_prod_idL = isset($errores['cat_prod_id']) ? 'uk-form-label uk-text-danger uk-text-uppercase' : 'uk-form-label uk-text-uppercase';
            $class_cat_prod_id  = isset($errores['cat_prod_id']) ? 'uk-input uk-form-danger' : 'uk-input typeahead uk-width-1-1';
            
            // Formulario
            echo form_open('login', array('class' => 'uk-form-stacked uk-padding-large uk-padding-remove-top uk-padding-remove-bottom', 'id' => 'form_producto', 'name' => 'form_producto'));
                
                echo '<div class="uk-margin uk-grid-small" uk-grid>';
                    // echo form_hidden(array('name' => 'id_cliente', 'id' => 'id_cliente', 'class' => '', 'value' => ''));
                    echo '<input type="hidden" name="id_producto" id="id_producto" value="" />';
                    
                    echo '<div class="uk-width-1-3@s">';
                        echo form_label('Producto', 'modelo');
                        echo form_input(array('name' => 'modelo', 'id' => 'modelo', 'class' => $class_producto));
                    echo '</div>';
                    
                    echo '<div class="uk-width-1-3@s">';
                        echo form_label('Marca', 'marca_id');
                        echo form_input(array('name' => 'marca_id', 'id' => 'marca_id', 'class' => $class_marca_id));
                    echo '</div>';
                    
                    echo '<div class="uk-width-1-3@s">';
                        echo form_label('Categoría', 'cat_prod_id');
                        echo form_input(array('name' => 'cat_prod_id', 'id' => 'cat_prod_id', 'class' => $class_cat_prod_id));
                    echo '</div>';
                    
                    echo '<div class="uk-width-1-1@s">';
                        echo form_label('Proveedores', 'proveedor_id');               
                        echo    '<select class="js-example-basic-multiple uk-select" id="proveedor_id" name="proveedor_id[]" multiple="multiple" style="width: 100%">';
                                    foreach ($proveedores as $proveedor) :
                                        echo '<option value="'.$proveedor['id_proveedor'].'">'
                                            .$proveedor['nombre_proveedor'].
                                        '</option>';
                                    endforeach;
                                echo '</select>';
                    echo '</div>';
                    
                    echo '<div class="uk-width-1-4@s">';
                        echo form_label('Precio unitario', 'precio_unitario');
                        echo form_input(array('name' => 'precio_unitario', 'id' => 'precio_unitario', 'class' => 'uk-input uk-width-1-1'));
                    echo '</div>';
                    
                    echo '<div class="uk-width-1-4@s">';
                        echo form_label('Precio de venta', 'precio_venta');
                        echo form_input(array('name' => 'precio_venta', 'id' => 'precio_venta', 'class' => 'uk-input uk-width-1-1'));
                    echo '</div>';
                    
                    echo '<div class="uk-width-1-4@s">';
                        echo form_label('Stock crítico', 'stock_critico');
                        echo form_input(array('name' => 'stock_critico', 'id' => 'stock_critico', 'class' => 'uk-input uk-width-1-1'));
                    echo '</div>';
                    
                    echo '<div class="uk-width-1-4@s">';
                        echo form_label('Stock inicial', 'stock');
                        echo form_input(array('name' => 'stock', 'id' => 'stock', 'class' => 'uk-input uk-width-1-1'));
                    echo '</div>';
                    
                echo '</div>';

                echo '<button class="uk-button uk-button-danger uk-modal-close" type="button">Cancelar</button>';
                echo '<button class="uk-button uk-button-primary" type="button" onclick="save()">Guardar</button>';
            echo form_close();
            ?>
        </div>
    </div>
    
</section>

<script type="text/javascript">
    $(document).ready( function () {

        // $(".print_barcode").on('click', function() {
        //     $(".print_barcode").print({
        //         globalStyles : true,
        //         mediaPrint : true
        //     })
        // });
        
        var table = $('#table_productos').DataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            // "scrollY":          "50vh",
            // "scrollCollapse":   true,
            "paging":           true,
            "order":            [[ 0, "asc" ]],
            "info"          : false,
            "responsive"    : true
        });

        $( '#table_productos_filter' ).addClass( "dataTables_filter uk-search uk-search-default" );
        $( '[type="search"]' ).addClass( "uk-search-input" );

        var modelo = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace('modelo'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote:{
                url:'<?php echo base_url(); ?>/ProductosController/autocompletar_producto/%QUERY',
                wildcard:'%QUERY'
            }
        });
        
        var cat_prod_id = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace('cat_prod_id'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote:{
                url:'<?php echo base_url(); ?>/ProductosController/autocompletar_cat_prod_id/%QUERY',
                wildcard:'%QUERY'
            }
        });
        
        var marca_id = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace('marca_id'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote:{
                url:'<?php echo base_url(); ?>/ProductosController/autocompletar_marcas/%QUERY',
                wildcard:'%QUERY'
            }
        });
        
        $('#modelo').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            },
            {
                name: 'modelo-complete',
                source: modelo
            }
        );
       
        $('#cat_prod_id').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            },
            {
                name: 'cat_prod_id-complete',
                source: cat_prod_id
            }
        );
        
        $('#marca_id').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            },
            {
                name: 'marca_id-complete',
                source: marca_id
            }
        );

        $('.twitter-typeahead').addClass('uk-width-1-1');
        $('.tt-menu').addClass('uk-width-1-1');

        $('#proveedor_id').select2({
            tags: true,
            multiple: true,
            tokenSeparators: [';']
        });

        $("#proveedor_id").on("change", function(e) {
            console.log( $(this).val() );
        });

        
    } ); // ready

    // const number = 123456.789;
    function convertirMiles(number) {
        console.log(new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(number));
        return (new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(number));
    }


    function printBarCode(id) {
        // alert(id);
        // $("#"+id).print();
        // $("#"+id).print({
        //     globalStyles: true,
        // 	mediaPrint: true,
        // 	stylesheet: null,
        // 	noPrintSelector: ".no-print",
        // 	iframe: true,
        // 	append: null,
        // 	prepend: null,
        // 	manuallyCopyFormValues: true,
        // 	deferred: $.Deferred(),
        // 	timeout: 50,
        // 	title: null,
        // 	doctype: '<!doctype html>'
        // });

        $("#"+id).printThis({
            debug: false,               // show the iframe for debugging
            importCSS: true,            // import parent page css
            importStyle: false,         // import style tags
            printContainer: true,       // print outer container/$.selector
            loadCSS: "<?=base_url('public/css/printBarCode.css');?>",                // path to additional css file - use an array [] for multiple
            pageTitle: "",              // add title to print page
            removeInline: false,        // remove inline styles from print elements
            removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
            printDelay: 333,            // variable print delay
            header: null,               // prefix to html
            footer: null,               // postfix to html
            base: false,                // preserve the BASE tag or accept a string for the URL
            formValues: true,           // preserve input/form values
            canvas: false,              // copy canvas content
            //doctypeString: '...',       // enter a different doctype for older markup
            removeScripts: false,       // remove script tags from print content
            copyTagClasses: false,      // copy classes from the html & body tag
            beforePrintEvent: null,     // function for printEvent in iframe
            beforePrint: null,          // function called before iframe is filled
            afterPrint: null            // function called before iframe is removed
        });
    }

    var save_method; //for save method string

    function add_producto() {
        save_method = 'add';
        $('input').removeClass('uk-form-danger');
        $('label').removeClass('uk-form-danger');
        $('#form_producto')[0].reset(); // reset form on modals
        $('#proveedor_id').val(null).trigger('change');
        $('.uk-modal-title').text('Agregar producto');
    }

    function save() {
        if(save_method == 'add') {
            url = "<?php echo site_url('ProductosController/producto_add')?>";
        } else {
            url = "<?php echo site_url('ProductosController/producto_update')?>";
        }

        var modal = UIkit.modal("#modal-container");

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_producto').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                //console.log(data.mensaje);
                if(data.status===true) {
                    location.reload();
                    UIkit.notification(data.mensaje, { status: 'success' });
                    modal.hide();
                    // $("#table_clientes").load(window.location + " #table_clientes");
                } else {
                    UIkit.notification.closeAll()
                    UIkit.notification(data.mensaje, { status: 'danger', pos: 'top-right' });
                    $('input').removeClass('uk-form-danger');
                    $('label').removeClass('uk-form-danger');
                    for (var key in data.errores) {
                        // console.log("key " + key + " has value " + data.errores[key]);
                        UIkit.notification('<i class="fas fa-angle-double-right"></i> '+data.errores[key], { status: 'danger', pos: 'top-right' });
                        $('#'+key).addClass('uk-form-danger');
                        $('label[for="'+key+'"]').addClass('uk-form-danger');
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                UIkit.notification(data.mensaje, { status: 'warning' });
            }
        });
    }

    function edit_producto(id) {
        save_method = 'update';
        $('#form_producto')[0].reset(); // reset form on modals
        <?php header('Content-type: application/json'); ?>
        var modal = UIkit.modal("#modal-container");
        $.ajax({
            url : "<?php echo site_url('ProductosController/ajax_edit')?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                // console.log(data);
                $('[name="id_producto"]').val(data.id_producto);
                $('[name="modelo"]').val(data.modelo);
                $('[name="marca_id"]').val(data.marca_id);
                $('[name="cat_prod_id"]').val(data.cat_prod_id);
                var array_prov = data.proveedor_id.split(',');
                $('[name="proveedor_id[]"]').val(array_prov).change();
                $('[name="precio_unitario"]').val(data.precio_unitario);
                $('[name="precio_venta"]').val(data.precio_venta);
                $('[name="stock_critico"]').val(data.stock_critico);
                $('[name="stock"]').prop( "disabled", true );
    
                modal.show();
                $('.uk-modal-title').text('Editar datos del producto');
    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(jqXHR);
                alert('Error');
            }
        });
    }

    function delete_producto(id) {
        UIkit.modal.confirm('¿Deseas borrar esta información?', {
            labels: {
                cancel: 'Cancelar',
                ok: 'Sí, borrar'
            }
        }).then(function () 
        {
            console.log('Confirmed.');
            $.ajax({
                url : "<?php echo site_url('productosController/producto_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    console.log(data);
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error');
                }
            });
        }, 
        function () {
            console.log('Rejected.');
        });
    }

    var app = new Vue({
        el      : '#productos',
        data () {
            return {
                
            }
        }
    });

</script>



<?= $this->endSection();?>