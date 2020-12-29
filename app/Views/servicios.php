<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Servicios
<?= $this->endSection();?>

<?= $this->section('page_content'); ?>

<div class="uk-grid uk-grid-match uk-margin-medium-right uk-margin-small-left uk-margin-medium-top">
    <div class="uk-width-1-1 uk-margin-medium-bottom">
        <h1>Servicios</h1> 
    </div>

    <div class="uk-width-1-2@s uk-width-1-5@m">
        <div class="uk-card uk-card-default uk-card-body">
            <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                <li class="uk-active"><a href="<?=base_url('clientes');?>">Clientes</a></li>
                <li class="uk-parent">
                    <a href="#">Parent</a>
                    <ul class="uk-nav-sub">
                        <li><a href="#">Sub item</a></li>
                        <li><a href="#">Sub item</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="uk-width-2-2@s uk-width-4-5@m">
        <table class="uk-table uk-table-striped uk-table-hover">
            <thead>
                <tr>
                    <th>Tipo de trabajo</th>
                    <th>Descripcion</th>
                    <th>Fecha y hora de registro</th>
                    <th>Técnico</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($servicios as $servicio) : ?>
                    <tr>
                        <td><?=$servicio['tipo_trabajo'];?></td>
                        <td><?=$servicio['descripcion_servicio'];?></td>
                        <td><?=$servicio['fecha_hora_registro'];?></td>
                        <td><?=$servicio['tecnico_id'];?></td>
                        <td>
                            <a href="<?=base_url('dashboard/servicios/'.$servicio['id_servicio']);?>"><i class="fas fa-shipping-fast"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        
        </table>
    </div>
</div>


<?= $this->endSection();?>