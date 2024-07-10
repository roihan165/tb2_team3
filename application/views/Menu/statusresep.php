<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newResep">Input Resep</a>
            <form action="<?= base_url('resep/search'); ?>" method="get">
                <input type="text" name="keyword" placeholder="Search..." required>
                <button type="submit" class="fas fa-search btn-primary mb-3"></button>
            </form>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">ID</th>
                        <th scope="col">Kode Resep</th>
                        <th scope="col">Total Tagihan</th>
                        <th scope="col">Status Terima</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($id_resep as $id) : ?>
                        <tr>
                            <!-- <th scope="row"><?= $i; ?></th> -->
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $id['kode_resep']; ?></td>
                            <td><?= $id['total_tagihan']; ?></td>
                            <?php if ($id['status_terima'] == '0') : ?>
                                <td>Belum</td>
                            <?php else : ?>
                                <td>Sudah</td>
                            <?php endif; ?>
                            <td>
                                <a href="<?= base_url('resep/detailResep/') . $id['kode_resep']; ?>" class="badge badge-success">Detail</a>
                                <a href="<?= base_url('resep/deleteResep/') . $id['kode_resep']; ?>" class="badge badge-danger">delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newResep" tabindex="-1" role="dialog" aria-labelledby="newResepLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newResepLabel">Tambah Resep</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('resep'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="kode_resep" name="kode_resep" placeholder="Kode Resep">
                        </div>
                        <div id="productInputs">
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <select name="produk[]" id="produk" class="form-control">
                                        <option value="">Pilih Produk</option>
                                        <?php foreach ($produk_stok as $p) : ?>
                                            <option value="<?= $p['kode_produk']; ?>"><?= $p['nama']; ?> : <?= $p['harga_jual']; ?> -> <?= $p['qty'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <input type="number" class="form-control" id="qty" name="qty[]" placeholder="Jumlah">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                <button type="button" class="btn btn-success" id="addProduct">+</button>
                            </div>
                            <div class="form-group col-md-1">
                                <button type="button" class="btn btn-danger" id="removeProduct">-</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <select name="tipe_bayar" id="tipe_bayar" class="form-control">
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="Tunai">Tunai</option>
                                <option value="Kartu">Kartu</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('addProduct').addEventListener('click', function() {
            const productInputs = document.getElementById('productInputs');
            const newInputRow = document.createElement('div');
            newInputRow.classList.add('form-row');
            newInputRow.innerHTML = `
            <div class="form-group col-md-7">
                <select name="produk[]" class="form-control">
                    <option value="">Pilih Produk</option>
                    <?php foreach ($produk_stok as $p) : ?>
                        <option value="<?= $p['kode_produk']; ?>"><?= $p['nama']; ?> : <?= $p['harga_jual'] ?> -> <?= $p['qty'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-5">
                <input type="number" class="form-control" name="qty[]" placeholder="Jumlah">
            </div>
        `;
            productInputs.appendChild(newInputRow);
        });

        document.getElementById('removeProduct').addEventListener('click', function() {
            const productInputs = document.getElementById('productInputs');
            if (productInputs.children.length > 1) {
                productInputs.removeChild(productInputs.lastChild);
            }
        });
    </script>