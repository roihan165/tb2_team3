<!-- Begin Page Content -->
<div class="container-fluid">
        
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> </? Edit </h1>
    
        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= $this->session->flashdata('message'); ?>
    
        <form action="<?= base_url('menu/update/' . $menu['id']); ?>" method="post">
            <div class="form-group">
                <label for="menu">Menu ID</label>
                <input type="text" class="form-control" id="menuid" name="menuid" disabled value="<?= $menu['id']; ?>">
                <h6 class="mt-3">Menu Name</h6>
                <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name" value="<?= $menu['menu']; ?>">
            </div>
    
            <button type="submit" class="btn btn-primary">Submit Edit</button>
            <a href="<?= base_url('menu') ?>" class="btn btn-secondary" data-dismiss="modal">Back</a>
        </form>
    </div>