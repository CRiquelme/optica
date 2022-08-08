<?= $this->extend('layouts/main.php'); ?>

<?= $this->section('page_title'); ?>
Detalle de compra
<?= $this->endSection(); ?>

<?= $this->section('page_content'); ?>
<section class="m-10" id="detalle_compra">
  <div class="grid md:grid-cols-5 gap-4">
    <div class="md:row-span-3 border-r-2 border-gray-100 pb-5 pt-3">
      <?= $this->include('components/sidebar') ?>
    </div>

    <div class="md:row-span-1 md:col-span-4" >
      <h1 class="text-4xl uppercase border-b-2 pb-5 border-gray-100 mb-4 no-print">Detalle de compra</h1>
      <!-- Section to print -->
      <section id="detalle_compra_print">
        <header class="grid grid-cols-2 gap-4">
          <div id="logo_detalle_compra">
            <img src="<?= base_url('public/images/logo.jpg') ?>" alt="Logo">
            <p class="text-left text-xl font-bold" style="text-align: left; font-weight: bold;">RUT: 78.577.220-2</p>
          </div>
          <div>
            <h2 class="text-xl text-left font-bold flex-none uppercase">Detalle de compra</h2>
          </div>
        </header>
        <section class="grid grid-cols-1 gap-4 mt-5">
          <div class="flex justify-end">
            <label for="fecha" class="text-right font-bold">Fecha: </label>
            <input type="text" value="<?=date('d-m-Y')?>" class="border-b-2 text-center">
          </div>
        </section>
        <section class="grid grid-cols-1 gap-4 w-full mt-5">
          <div class="flex">
            <label for="nombre" class="text-left font-bold uppercase flex-none">Nombre: </label>
            <input type="text" id="nombre" class="border-b-2 w-full px-2" value="">
          </div>
          <div class="flex">
            <label for="rut" class="text-left font-bold uppercase flex-none">rut: </label>
            <input type="text" id="rut" class="border-b-2 w-full px-2 bg-white" value="">
          </div>
          <div class="flex">
            <label for="num_operacion" class="text-left font-bold uppercase flex-none">N° de operación: </label>
            <input type="text" id="num_operacion" class="border-b-2 w-full px-2 bg-white flex-auto" value="">
          </div>
          <div class="flex">
            <label for="detalle" class="text-left font-bold uppercase flex-none">detalle: </label>
          </div>
          <div class="flex">
            <input type="text" class="border-b-2 px-2 bg-white flex-1">
            <input type="text" class="border-b-2 px-2 bg-white flex-1 text-right">
          </div>
          <div class="flex">
            <input type="text" class="border-b-2 px-2 bg-white flex-1">
            <input type="text" class="border-b-2 px-2 bg-white flex-1 text-right">
          </div>
          <div class="flex">
            <input type="text" class="border-b-2 px-2 bg-white flex-1">
            <input type="text" class="border-b-2 px-2 bg-white flex-1 text-right">
          </div>
          <div class="flex">
            <input type="text" class="border-b-2 px-2 bg-white flex-1">
            <input type="text" class="border-b-2 px-2 bg-white flex-1 text-right">
          </div>
          <div class="flex">
            <input type="text" class="border-b-2 px-2 bg-white flex-1">
            <input type="text" class="border-b-2 px-2 bg-white flex-1 text-right">
          </div>
        </section>
      </section>
      <button onclick="window.print();return false;" class="mt-10 no-print bg-black text-white px-5 py-2 rounded-lg"><i class="fas fa-print font-bold"></i> Imprimir</button>
    </div>
  </div>
</section>

<?= $this->endSection(); ?>