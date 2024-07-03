<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?= $this->session->flashdata('message'); ?>
    <form action="<?= base_url('menu/updateListProduct/' . $id_produk['id']); ?>" method="post">
        <div class="form-group">
            <label for="menu">Kode Produk</label>
            <input type="text" class="form-control" id="idproduk" name="idproduk" value="<?= $id_produk['kode_produk']; ?>">
            <h6 class="mt-3">Nama Produk</h6>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" value="<?= $id_produk['nama']; ?>">
            <h6 class="mt-3">Harga Produk</h6>
            <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Harga Produk" value="<?= $id_produk['harga_jual']; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Submit Edit</button>
        <a href="<?= base_url('listproduk/') ?>" class="btn btn-secondary" data-dismiss="modal">Back</a>
    </form>
</div>