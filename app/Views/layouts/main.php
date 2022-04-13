<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url('public/libs/uikit/css/uikit.min.css');?>">

    <link rel="stylesheet" href="<?=base_url('public/css/style.css');?>">
    
    <?=$this->renderSection('css');?>

    <link rel="icon" type="image/gif" href="<?=base_url('public/images/favicon-optik.gif');?>">

    <title><?=$this->renderSection('page_title');?></title>

    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/72e2d7c571.js" crossorigin="anonymous"></script>
    
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>  
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="<?=base_url('public/js/typeahead/bloodhound.min.js');?>"></script>
    <script src="<?=base_url('public/js/typeahead/typeahead.bundle.min.js');?>"></script>
    <script src="<?=base_url('public/js/typeahead/typeahead.jquery.min.js');?>"></script>
    
    <script src="<?=base_url('public/js/jasonday-printThis-f73ca19/printThis.js');?>"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- <script src="<?//=base_url('public/js/jQuery.print.min.js');?>"></script> -->
    <script src="<?=base_url('public/js/moment.js');?>"></script>

    <!-- use the latest vue-select release -->
    <script src="https://unpkg.com/vue-select@latest"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <link rel="stylesheet" href="https://rawgit.com/lykmapipo/themify-icons/master/css/themify-icons.css">
    <script src="https://unpkg.com/vue-form-wizard/dist/vue-form-wizard.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-form-wizard/dist/vue-form-wizard.min.css">

    <!-- <script src="<?//=base_url('public/js/canvas2image.js');?>"></script> -->
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>

    <?=view_cell('App\Libraries\ViewComponents::getNavbar');?>
    
    <!-- <div class="uk-container uk-padding-large"> -->
        <?=$this->renderSection('page_content');?>
    <!-- </div> -->

    <?php echo $this->include('layouts/footer');?>

    <script src="<?=base_url('public/libs/uikit/js/uikit.min.js');?>"></script>
    

    <?=$this->renderSection('scripts');?>

</body>
</html>