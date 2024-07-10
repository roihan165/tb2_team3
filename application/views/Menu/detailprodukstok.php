<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="<?= base_url('produkstok/'); ?>" class="btn btn-primary mb-3">Kembali</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">ID</th>
                        <th scope="col">Kode Produk</th>
                        <th scope="col">Jumlah Stok</th>
                        <th scope="col">Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($id as $d) : ?>
                        <tr>
                            <!-- <th scope="row"><?= $i; ?></th> -->
                            <th scope="row"><?= $d['id']; ?></th>
                            <td><?= $d['kode_produk']; ?></td>
                            <td><?= $d['qty']; ?></td>
                            <td><?= $d['tipe']; ?></td>
                            <td></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>