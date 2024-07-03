<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="<?= base_url('resep'); ?>" class="btn btn-primary mb-3">Kembali</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">Kode Resep</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">qty</th>
                        <th scope="col">Total Tagihan</th>
                        <th scope="col">Metode Pembayaran</th>
                        <th scope="col">Status Terima</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($id as $d) : ?>
                        <tr>
                            <!-- <th scope="row"><?= $i; ?></th> -->
                            <th scope="row"><?= $d['kode_resep']; ?></th>
                            <td><?= $d['tanggal']; ?></td>
                            <td><?= $d['nama']; ?></td>
                            <td><?= $d['qty']; ?></td>
                            <td><?= $d['total_tagihan']; ?></td>
                            <td><?= $d['tipe_bayar']; ?></td>
                            <?php if ($d['status_terima'] == '0') : ?>
                                <td>Belum</td>
                            <?php else : ?>
                                <td>Sudah</td>
                            <?php endif; ?>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>