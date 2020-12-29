<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Dashboard
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>
    

    <div class="uk-margin-medium-right uk-margin-small-left uk-margin-medium-top" uk-grid>
        <div>
            <h1 class="uk-text-uppercase">Clientes</h1>
        </div> 
        <div class="uk-width-1-6 pos_relative">
            <a class="uk-button uk-button-secondary uk-button-small  uk-text-middle uk-position-center" href="#modal-container" uk-toggle onclick="add_cliente()">Nuevo</a>
        </div>
    </div>

    <div class="uk-grid uk-grid-match uk-margin-medium-right uk-margin-small-left uk-margin-medium-top">
        <div class="uk-width-1-1@s uk-width-1-1@m">
            <table class="uk-table uk-table-striped uk-table-hover" id="table_clientes">
                <thead>
                    <tr>
                        <th>Nombre del cliente</th>
                        <th>RUT</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Celular</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //var_dump(json_encode($clientes)); ?>
                    <?php foreach($clientes as $cliente) : ?>
                        <tr>
                            <td>
                                <button class="uk-button uk-button-link uk-text-primary uk-text-bolder" onclick="edit_cliente(<?php echo $cliente['id_cliente'];?>)"><i class="far fa-edit"></i></button> <?=$cliente['nombre_cliente'];?>
                            </td>
                            <td><?=$cliente['rut'];?></td>
                            <td><?=$cliente['direccion'];?></td>
                            <td>
                                <?//=barcode($cliente['telefono']);?>
                                <?=$cliente['telefono'];?>
                            </td>
                            <td><?=$cliente['celular'];?></td>
                            <td>
                                <button class="uk-button uk-button-link uk-text-danger uk-text-bolder" onclick="delete_cliente(<?php echo $cliente['id_cliente'];?>)"><i class="fas fa-trash-alt uk-margin-small-left uk-text-danger" ></i></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>                    
                </tbody>
            
            </table>

            <table id="table_clientes2">
            </table>
        </div>
    </div>


    <div id="clientes">

        <table class="uk-table uk-table-striped uk-table-hover" id="table_clientes">
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
                <tr v-for="cliente in clientes" :key="cliente.id_cliente">
                    <td>{{cliente.nombre_cliente}}</td>
                    <td>{{cliente.rut}}</td>
                    <td>{{cliente.telefono}}</td>
                    <td>{{cliente.celular}}</td>
                    <td>
                        <button class="uk-button uk-button-link uk-text-danger uk-text-bolder" onclick="delete_cliente(<?php echo $cliente['id_cliente'];?>)"><i class="fas fa-trash-alt uk-margin-small-left uk-text-danger" ></i></button>
                    </td>
                </tr>
            </tbody>
        
        </table>
       
        

        <a :href="url">{{ms}}</a>
        <div v-for="cliente in clientes" :key="cliente.id_cliente">
            <p>{{cliente.nombre_cliente}} {{cliente.rut}} {{cliente.id_cliente}}</p>
        </div>
    </div>
    
    <script>
        var app = new Vue({
  el: '#clientes',
  data: {
    ms: 'Hola Vue!',
    url: 'http://www.google.cl',
    clientes: <?php echo json_encode($clientes); ?>
  }
})
    </script>

    <script type="text/javascript">
        $(document).ready( function () {
            var table = $('#table_clientes').DataTable( {
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
                },
                "scrollY":          "50vh",
                "scrollCollapse":   true,
                "paging":           false,
                "order":            [[ 0, "asc" ]]
            });
            
        } );

        var save_method; //for save method string

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
            save_method = 'update';
            $('#form_cliente')[0].reset(); // reset form on modals
            <?php header('Content-type: application/json'); ?>
            var modal = UIkit.modal("#modal-container");
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
        
                    modal.show();
                    $('.uk-modal-title').text('Editar datos de cliente');
        
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    console.log(jqXHR);
                    alert('Error');
                }
            });
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



    <div id="modal-container" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 class="uk-modal-title uk-form-stacked uk-padding-large uk-padding-remove-top uk-padding-remove-bottom">Cliente</h2>

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
            echo '<div class="uk-margin" >';
                    // echo form_hidden(array('name' => 'id_cliente', 'id' => 'id_cliente', 'class' => '', 'value' => ''));
                    echo '<input type="hidden" name="id_cliente" id="id_cliente" value="" />';
                    
                    echo form_label('Nombre de cliente', 'nombre_cliente', array('class' => $class_nombre_clienteL));
                    echo form_input(array('name' => 'nombre_cliente', 'id' => 'nombre_cliente', 'class' => $class_nombre_cliente));
                    
                    echo form_label('RUT', 'rut', array('class' => $class_rutL));
                    echo form_input(array('name' => 'rut', 'id' => 'rut', 'class' => $class_rut));
                    
                    echo form_label('Dirección', 'direccion', array('class' => $class_direccionL));
                    echo form_input(array('name' => 'direccion', 'id' => 'direccion', 'class' => $class_direccion));
                    
                    echo form_label('Teléfono', 'telefono', array('class' => $class_telefonoL));
                    echo form_input(array('name' => 'telefono', 'id' => 'telefono', 'class' => $class_telefono));
                    
                    echo form_label('Celular', 'celular', array('class' => $class_celularL));
                    echo form_input(array('name' => 'celular', 'id' => 'celular', 'class' => $class_telefono));
                echo '</div>';

                echo '<button class="uk-button uk-button-danger uk-modal-close" type="button">Cancelar</button>';
                echo '<button class="uk-button uk-button-primary" type="button" onclick="save()">Guardar</button>';
            echo form_close();
            ?>
        </div>
    </div>

<?= $this->endSection();?>