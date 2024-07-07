<!-- Begin Page Content -->
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?= $this->session->flashdata('message'); ?>
    <form action="<?= base_url('resep/updateDetailResep/' . $detail['kode_resep']) . '/' . $detail['kode_produk']; ?>" method="post">
        <div class="form-group">
            <label for="menu">Kode Resep</label>
            <input type="text" class="form-control" id="kode_resep" name="kode_resep" value="<?= $detail['kode_resep']; ?>" readonly>
            <h6 class="mt-3">Nama Produk</h6>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Produk" value="<?= $detail['nama']; ?>" readonly>
            <h6 class="mt-3">Jumlah</h6>
            <input type="text" class="form-control" id="qty" name="qty" placeholder="Jumlah Produk" value="<?= $detail['qty']; ?>" readonly>
            <h6 class="mt-3">Total Tagihan</h6>
            <input type="text" class="form-control" id="total" name="total" placeholder="Total Harga" value="<?= $detail['total_tagihan']; ?>" readonly>
            <h6 class="mt-3">Metode Pembayaran</h6>
            <select name="tipe_bayar" id="tipe_bayar" class="form-control">
                <option value="<?= $detail['tipe_bayar']; ?>"><?= $detail['tipe_bayar']; ?></option>
                <option value="Kartu">Kartu</option>
                <option value="Tunai">Tunai</option>
            </select>
            <h6 class="mt-3">Status Terima</h6>
            <select name="status_terima" id="status_terima" class="form-control">
                <?php if ($detail['status_terima'] == '0') : ?>
                    <option value="<?= $detail['status_terima']; ?>">Belum</option>
                <?php else : ?>
                    <option value="<?= $detail['status_terima']; ?>">Sudah</option>
                <?php endif; ?>
                <option value="0">Belum</option>
                <option value="1">Sudah</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?= base_url('resep/') ?>" class="btn btn-secondary" data-dismiss="modal">Back</a>
    </form>
</div>