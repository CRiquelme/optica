<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Productos
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>

<div class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
    <div>
        <h1 class="text-4xl uppercase">Productos</h1>
    </div> 
    <div class="uk-width-1-6 pos_relative">
        <a class="uk-button uk-button-secondary uk-button-small uk-text-middle uk-position-center" href="#modal-container" uk-toggle onclick="add_producto()">Nuevo</a>
    </div>
</div>


<section class="m-10" id="sobre">
    <!-- <h1 class="text-4xl uppercase border-b-2 pb-5 border-gray-100 mb-4">Registro sobre</h1> -->

    <div class="grid md:grid-cols-5 gap-4">
        <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
            <?= $this->include('components/sidebar') ?>
        </div>

        <div class="md:row-span-1 md:col-span-4 ">
        <table class="uk-table uk-table-striped uk-table-hover" id="table_productos">
            <thead>
                <tr>
                    <th>Created_at</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Proveedor(es)</th>
                    <th>marca</th>
                    <th>Código de barra</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $producto) : ?>
                    <tr>
                        <td><?=$producto['created_at'];?></td>
                        <td>
                            <?php if( $producto['deleted'] === null ) { ?>
                                <button
                                    class="uk-button uk-button-link uk-text-primary uk-text-bolder"
                                    onclick="edit_producto(<?php echo $producto['id_producto'];?>)"
                                >
                                    <i class="far fa-edit"></i>
                                    <?=$producto['modelo'];?>
                                </button>
                            <?php } else { ?>
                                <span class="font-bold"><?=$producto['modelo'];?></span>
                            <?php } ?>
                        </td>
                        <td><?=$producto['nombre_cat_pro'];?></td>
                        <td><?=str_replace(",", "<br>", $producto['nombre_proveedor']);?></td>
                        <td><?=$producto['nombre_marca'];?></td>
                        <!-- https://doersguild.github.io/jQuery.print/ -->
                        
                        <td class="print_barcode" id="<?=$producto['cod_barra']?>" onclick="getCodePrint(<?=$producto['cod_barra']?>, <?=$producto['precio_venta']?>)">
                            <!-- <div> --> <!-- style="display:flex; align-items: center; justify-content: space-between;" -->
                                <div class="print_barcode--barcode">
                                <!-- <div> -->
                                    <?=barcode($producto['cod_barra']);?>
                                    <?=$producto['cod_barra']?>
                                </div>
                                <div class="print_barcode--espacio">
                                    &nbsp; <!-- style="display:none;" width="200" height="100"   -->
                                    <canvas style="display:none;" id="myCanvas_<?=$producto['cod_barra']?>">Your browser does not support the HTML5 canvas tag.</canvas>
                                </div>
                                <!-- <div> -->
                                <!-- <div class="print_barcode--precio">
                                    $<?//=number_format($producto['precio_venta'], 0, '0', '.');?>
                                </div> -->
                            <!-- </div> -->
                        </td>
                        <td>
                            <?php if( $producto['deleted'] === null ) { ?>
                                <button class="uk-button uk-button-link uk-text-danger uk-text-bolder" onclick="delete_producto(<?php echo $producto['id_producto'];?>,)">
                                    <i class="fas fa-trash-alt uk-margin-small-left uk-text-danger" ></i> Eliminar 
                                </button>
                            <?php } else { ?>
                                <button class="uk-button uk-button-link text-blue-800 uk-text-bolder" onclick="reactivar_producto(<?php echo $producto['id_producto'];?>,)">
                                    <i class="fas fa-trash-alt uk-margin-small-left text-blue-800" ></i> Volver a activar 
                                </button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        
        </table>
    </div>
</section>


<script type="text/javascript">
    $(document).ready( function () {

        
        var table = $('#table_productos').DataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            },
            // "scrollY":          "50vh",
            // "scrollCollapse":   true,
            "paging":           true,
            "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                }
            ],
            "order":            [[ 0, "desc" ]],
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

    function printBarCode(id) {
        var img = document.createElement('img'); 
        img.src = document.getElementById('img_'+id).getAttribute('src');
       
        document.getElementById('sobre').appendChild(img);
        

        // $("#"+id).printThis({
        //     debug: true,               // show the iframe for debugging
        //     importCSS: true,            // import parent page css
        //     importStyle: true,         // import style tags
        //     // printContainer: false,       // print outer container/$.selector
        //     loadCSS: "http://localhost/sis_uvoptik/public/css/printBarCode.css", // path to additional css file - use an array [] for multiple
        //     // pageTitle: "",              // add title to print page
        //     // removeInline: false,        // remove inline styles from print elements
        //     // removeInlineSelector: "*",  // custom selectors to filter inline styles. removeInline must be true
        //     // printDelay: 333,            // variable print delay
        //     // header: null,               // prefix to html
        //     // footer: null,               // postfix to html
        //     // base: false,                // preserve the BASE tag or accept a string for the URL
        //     // formValues: true,           // preserve input/form values
        //     // canvas: false,              // copy canvas content
        //     // //doctypeString: '...',       // enter a different doctype for older markup
        //     // removeScripts: false,       // remove script tags from print content
        //     // copyTagClasses: false,      // copy classes from the html & body tag
        //     // beforePrintEvent: null,     // function for printEvent in iframe
        //     // beforePrint: null,          // function called before iframe is filled
        //     // afterPrint: null            // function called before iframe is removed
        // });
    }

    function getCodePrint(code, precio) {
        var c = document.getElementById("myCanvas_"+code);
        var img = new Image();
        var ctx = c.getContext("2d");
        img.src = document.getElementById("img_" + code).src;
        c.width = 932.99;
        c.height = 170; // 224.39
        // c.style.width = '79mm';
        // c.style.height = '19mm';
        var w = c.width
        var h = c.height
        
        // c.style.width = "300px";   // size in pixel for screen use
        // c.style.height = "380px";
        // c.height = 50
        // c.height = 70;
        // c.height = 71.811023622;
        // ctx.drawImage(img, 0, 20, 100, 100 * c.height / c.width)
        // ctx.drawImage(img, 0, 20, 100, 100 * c.height / c.width)
        ctx.drawImage(img, 10, 70, 295.25, 50); // 342.49, 82.67
        ctx.font = "bold 40px Arial";
        ctx.fillText(code, 30, 160);

        ctx.font = "bold 50px Arial";
        let val = (precio/1).toFixed(0).replace('.', ',')
        let precioPunto = val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        ctx.fillText('$'+precioPunto, 680, 150);

        // save img
        c.setAttribute('download', code+'.png');
        var imgCanvas = c.toDataURL("image/png").replace("image/png", "image/octet-stream");
        console.log(imgCanvas);

        printJS({printable: imgCanvas, type: 'image', imageStyle: 'width:100%;'});
    }


    

    var save_method; //for save method string

    function add_producto()
    {
        save_method = 'add';
        $('input').removeClass('uk-form-danger');
        $('label').removeClass('uk-form-danger');
        $('#form_producto')[0].reset(); // reset form on modals
        $('#proveedor_id').val(null).trigger('change');
        $('[name="stock"]').prop( "disabled", false );
        $('.uk-modal-title').text('Agregar producto');
    }

    

    function save()
    {
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

    function delete_producto(id)
    {
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

    function reactivar_producto(id) {
        UIkit.modal.confirm('¿Deseas reactivar este producto?', {
            labels: {
                cancel: 'Cancelar',
                ok: 'Sí, reactivar'
            }
        }).then(function () 
        {
            console.log('Confirmed.');
            $.ajax({
                url : "<?php echo site_url('productosController/reactivar_producto_deleted')?>/"+id,
                type: "GET",
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

</script>

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
                
                echo '<div class="uk-width-1-2@s">';
                    echo form_label('Proveedores', 'proveedor_id');               
                    echo    '<select class="js-example-basic-multiple uk-select" id="proveedor_id" name="proveedor_id[]" multiple="multiple" style="width: 100%">';
                                foreach ($proveedores as $proveedor) :
                                    echo '<option value="'.$proveedor['id_proveedor'].'">'
                                        .$proveedor['nombre_proveedor'].
                                    '</option>';
                                endforeach;
                            echo '</select>';
                echo '</div>';
                
                echo '<div class="uk-width-1-2@s">';
                    echo form_label('Factura', 'factura');
                    echo form_input(array('name' => 'factura', 'id' => 'factura', 'class' => 'uk-input uk-width-1-1'));
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

<?= $this->endSection();?>