<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> Update </h1>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?= $this->session->flashdata('message'); ?>

    <form action="<?= base_url('menu/updateProdukStok/' . $produk_stok['id']); ?>" method="post">
        <div class="form-group">
            <h6>ID Produk</h6>
            <input type="text" class="form-control" id="id_produk" name="id_produk" placeholder="Submenu ID" value="<?= $produk_stok['kode_produk'] ?>" disabled>
        </div>
        <div class="form-group">
            <h6>Nama Produk</h6>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Title" value="<?= $produk['nama'] ?>">
        </div>
        <div class="form-group">
            <select name="tipe" id="tipe" class="form-control">
                <option value="">Pilih Tipe</option>
                <option value="IN">IN</option>
                <option value="OUT">OUT</option>
            </select>
        </div>
        <div class="form-group">
            <h6>Qty</h6>
            <input type="text" class="form-control" id="qty" name="qty" placeholder="Qty">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('menu/produkstok') ?>" class="btn btn-secondary" data-dismiss="modal">Back</a>
    </form>
</div>