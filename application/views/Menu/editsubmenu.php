<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> Edit </h1>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?= $this->session->flashdata('message'); ?>
    
    <form action="<?= base_url('menu/updateSubMenu/' . $subMenu['id']); ?>" method="post">
        <div class="form-group">
            <h6>Sub Menu ID</h6>
            <input type="text" class="form-control" id="submenuid" name="submenuid" placeholder="Submenu ID" value="<?= $subMenu['id'] ?>" disabled>
        </div>
        <div class="form-group">
            <h6>Sub Menu Title</h6>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?= $subMenu['title'] ?>">
        </div>
        <div class="form-group">
            <select name="menu_id" id="menu_id" class="form-control">
                <option value="">Select Menu</option>
                <?php foreach ($menu as $m) : ?>
                    <?php if ($subMenu['menu_id'] == $m['id']) : ?>
                        <option value="<?= $m['id']; ?>" selected><?= $m['menu']; ?></option>
                    <?php else : ?>
                        <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <h6>Sub Menu URL</h6>
            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url" value="<?= $subMenu['url'] ?>">
        </div>
        <div class="form-group">
            <h6>Sub Menu Icon</h6>
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon" value="<?= $subMenu['icon'] ?>">
        </div>
        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" value="1" name="is_active" id="is_active" <?= $subMenu['is_active'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="is_active">
                    Active?
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit Edit</button>
        <a href="<?= base_url('menu/submenu') ?>" class="btn btn-secondary" data-dismiss="modal">Back</a>
    </form>
</div>
