<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Clientes
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
    
<div id="clientes" class="m-10">
    <div class="pb-5 mb-4" uk-grid>
        <titulo class="text-4xl uppercase"></titulo>
        <div class="uk-width-1-6 pos_relative">
            <a class="uk-button uk-button-secondary uk-button-small  uk-text-middle uk-position-center" href="#modal-container" uk-toggle onclick="add_cliente()">Nuevo</a>
        </div>
    </div>

    <div class="grid md:grid-cols-5 gap-4">
        <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
            <?= $this->include('components/sidebar') ?>
        </div>

        <div class="md:row-span-1 md:col-span-4 ">
            <table class="uk-table uk-table-hover uk-table-striped" id="table_clientes">
                <thead>
                    <tr>
                        <th>Nombre del cliente</th>
                        <th>RUT</th>
                        <th>Teléfono</th>
                        <th>Celular</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(cliente, index) in clientes" :key="cliente.id_cliente">
                        <td>
                            <button class="uk-button uk-button-link uk-text-primary uk-text-bolder" @click="editar_cliente(index, cliente.id_cliente)"><i class="far fa-edit"></i></button>
                            {{cliente.nombre_cliente}}
                        </td>
                        <td>{{cliente.rut}}</td>
                        <td>{{cliente.telefono}}</td>
                        <td>{{cliente.celular}}</td> 
                        <td>
                            <button class="uk-button uk-button-link uk-text-danger uk-text-bolder" v-on:click="delete_cliente(index, cliente.id_cliente)" v-bind:id="'delete-' + cliente.id_cliente"><i class="fas fa-trash-alt uk-margin-small-left uk-text-danger" ></i></button>
                        </td>
                    </tr>
                </tbody>            
            </table>
        </div>
    </div> 
</div> 
    
    <!-- <a :href="url">{{ms}}</a> -->
    <!-- <pre> <?php //var_dump($clientes); ?> </pre> -->

    <div id="modal-container" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 class="uk-modal-title uk-form-stacked uk-padding-large uk-padding-remove-top uk-padding-remove-bottom uk-text-uppercase">Cliente</h2>

            <?php
            // Clases
            $class_nombre_clienteL  = isset($errores['nombre_cliente']) ? 'uk-form-label uk-text-danger uk-text-uppercase' : 'uk-form-label uk-text-uppercase';
            $class_nombre_cliente   = isset($errores['nombre_cliente']) ? 'uk-input uk-form-danger' : 'uk-input';
            $class_rutL             = isset($errores['rut']) ? 'uk-form-label uk-text-danger uk-text-uppercase' : 'uk-form-label uk-text-uppercase';
            $class_rut              = isset($errores['rut']) ? 'uk-input uk-form-danger' : 'uk-input';
            $class_direccionL       = isset($errores['direccion']) ? 'uk-form-label uk-text-danger uk-text-uppercase' : 'uk-form-label uk-text-uppercase';
            $class_direccion        = isset($errores['direccion']) ? 'uk-input uk-form-danger' : 'uk-input';
            $class_telefonoL        = isset($errores['telefono']) ? 'uk-form-label uk-text-danger uk-text-uppercase' : 'uk-form-label uk-text-uppercase';
            $class_telefono         = isset($errores['telefono']) ? 'uk-input uk-form-danger' : 'uk-input';
            $class_celularL         = isset($errores['celular']) ? 'uk-form-label uk-text-danger uk-text-uppercase' : 'uk-form-label uk-text-uppercase';
            $class_celular          = isset($errores['celular']) ? 'uk-input uk-form-danger' : 'uk-input';

            // Formulario
            echo form_open('login', array('class' => 'uk-form-stacked uk-padding-large uk-padding-remove-top uk-padding-remove-bottom', 'id' => 'form_cliente'));
            echo '<div class="uk-margin uk-grid-small" uk-grid>';
                    // echo form_hidden(array('name' => 'id_cliente', 'id' => 'id_cliente', 'class' => '', 'value' => ''));
                    echo '<input type="hidden" name="id_cliente" id="id_cliente" value="" />';
                    
                    echo '<div class="uk-width-1-2@s">';
                        echo form_label('Nombre de cliente', 'nombre_cliente', array('class' => $class_nombre_clienteL));
                        echo form_input(array('name' => 'nombre_cliente', 'id' => 'nombre_cliente', 'class' => $class_nombre_cliente));
                    echo '</div>';

                    echo '<div class="uk-width-1-2@s">';
                        echo form_label('RUT', 'rut', array('class' => $class_rutL));
                        echo form_input(array('name' => 'rut', 'id' => 'rut', 'class' => $class_rut));
                    echo '</div>';

                    echo '<div class="uk-width-1-1@s">';
                        echo form_label('Dirección', 'direccion', array('class' => $class_direccionL));
                        echo form_input(array('name' => 'direccion', 'id' => 'direccion', 'class' => $class_direccion));
                    echo '</div>';
                    
                    echo '<div class="uk-width-1-2@s">';
                        echo form_label('Teléfono', 'telefono', array('class' => $class_telefonoL));
                        echo form_input(array('name' => 'telefono', 'id' => 'telefono', 'class' => $class_telefono));
                    echo '</div>';
                    
                    echo '<div class="uk-width-1-2@s">';
                        echo form_label('Celular', 'celular', array('class' => $class_celularL));
                        echo form_input(array('name' => 'celular', 'id' => 'celular', 'class' => $class_telefono));
                    echo '</div>';
                echo '</div>';

                echo '<button class="uk-button uk-button-danger uk-modal-close" type="button">Cancelar</button>';
                echo '<button class="uk-button uk-button-primary" type="button" onclick="save()">Guardar</button>';
                
            echo form_close();
            ?>
        </div>
    </div>
        
</div> <!-- clientes -->
    
<script>
    Vue.component('titulo', {
        template: '<h1 class="uk-text-uppercase">{{titulo}}</h1>',
        data: function() {
            return { titulo: 'Clientes' }
        }
    });
        
    var app = new Vue({
        el      : '#clientes',
        data    : {
            ms              : 'Hola Vue!',
            url             : 'http://www.google.cl',
            clientes        : <?=json_encode($clientes);?>
        },
        methods : {
            delete_cliente : function(index, id) {
                var self = this;
                UIkit.modal.confirm('¿Deseas borrar esta información?', {
                    labels: {
                        cancel  : 'Cancelar',
                        ok      : 'Sí, borrar'
                    }
                }).then(function () 
                {
                    $.ajax({
                        url         : "<?php echo site_url('dashboard/cliente_delete')?>/"+id,
                        type        : "POST",
                        cache       : false,
                        dataType    : "JSON",
                        success: function()
                        {
                            // console.log('Confirmed.');
                            self.ms = id;
                            self.clientes.splice(index, 1);
                            console.log(self.clientes);
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            alert('Error');
                        }
                    });
                }, 
                function () {
                    console.log('Rejected.')
                });
            }, // delete_cliente

            editar_cliente : function(index, id) {
                save_method = 'update';
                $('#form_cliente')[0].reset();
                <?php header('Content-type: application/json'); ?>
                var modal = UIkit.modal("#modal-container").show();
                $.ajax({
                    url : "<?php echo site_url('dashboard/ajax_edit')?>/"+id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                        // console.log(data);
            
                        $('[name="id_cliente"]').val(data.id_cliente);
                        $('[name="rut"]').val(data.rut);
                        $('[name="nombre_cliente"]').val(data.nombre_cliente);
                        $('[name="direccion"]').val(data.direccion);
                        $('[name="telefono"]').val(data.telefono);
                        $('[name="celular"]').val(data.celular);

                        $('.uk-modal-title').text('Editar datos de cliente');
            
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        console.log(jqXHR);
                        alert('Error');
                    }
                });
                console.log(save_method + ' ' + index + ' ' + id);
            } // editar_cliente
        }, // methods

        mounted: function () {
            this.$nextTick(function () {
                //console.log(<?=json_encode($clientes);?>);
                $('#table_clientes').DataTable( {
                    "language"      : {
                        "url"       : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                    },  
                    "paging"        : true,
                    "order"         : [[ 0, "asc" ]],
                    "info"          : false,
                    "responsive"    : true
                });
            });
        } // mounted
       
    }); // app

    var save_method; //for save method string

    $(document).ready( function () {
        $( '#table_clientes_filter' ).addClass( "dataTables_filter uk-search uk-search-default" );
        $( '[type="search"]' ).addClass( "uk-search-input" );
    });

    function add_cliente()
    {
        save_method = 'add';
        $('#form_cliente')[0].reset(); // reset form on modals
        $('.uk-modal-title').text('Agregar cliente');
    }

    function delete_cliente(id)
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
                url : "<?php echo site_url('dashboard/cliente_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    
                location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error');
                }
            });
        }, 
        function () {
            console.log('Rejected.')
        });
    }

    function edit_cliente(id) {
        // save_method = 'update';
        // $('#form_cliente')[0].reset(); // reset form on modals
        // <?php header('Content-type: application/json'); ?>
        // var modal = UIkit.modal("#modal-container");
        // $.ajax({
        //     url : "<?php echo site_url('dashboard/ajax_edit')?>/"+id,
        //     type: "GET",
        //     dataType: "JSON",
        //     success: function(data)
        //     {
        //         // console.log(data);
    
        //         $('[name="id_cliente"]').val(data.id_cliente);
        //         $('[name="rut"]').val(data.rut);
        //         $('[name="nombre_cliente"]').val(data.nombre_cliente);
        //         $('[name="direccion"]').val(data.direccion);
        //         $('[name="telefono"]').val(data.telefono);
        //         $('[name="celular"]').val(data.celular);
    
        //         modal.show();
        //         $('.uk-modal-title').text('Editar datos de cliente');
    
        //     },
        //     error: function (jqXHR, textStatus, errorThrown)
        //     {
        //         console.log(jqXHR);
        //         alert('Error');
        //     }
        // });
    }

    function save()
    {
        if(save_method == 'add') {
            url = "<?php echo site_url('dashboard/cliente_add')?>";
        } else {
            url = "<?php echo site_url('dashboard/cliente_update')?>";
        }

        var modal = UIkit.modal("#modal-container");

        $.ajax({
            url : url,
            type: "POST",
            data: $('#form_cliente').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                // console.log(data.mensaje);
                
                if(data.status===true) {
                    location.reload();
                    UIkit.notification(data.mensaje, { status: 'success' });
                    modal.hide();
                    // $("#table_clientes").load(window.location + " #table_clientes");
                } else {
                    UIkit.notification(data.mensaje, { status: 'warning' });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                // alert('Error adding / update data');
                UIkit.notification(data.mensaje, { status: 'warning' });
            }
        });
    }

</script>



   

<?= $this->endSection();?>