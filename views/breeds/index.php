<div class="container">
    <h1>Breeds</h1>

    <?php if (isset($breeds) && count($breeds) > 0): ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($breeds as $breed): ?>
                <tr>
                    <td><?= $breed->breed_name ?></td>
                    <td>
                        <a class="btn btn-warning" href="<?= ROOT_PATH ?>/breeds/edit/<?= $breed->breed_id ?>">Edit</a>
                        <a class="btn btn-danger" href="<?= ROOT_PATH ?>/breeds/delete/<?= $breed->breed_id ?>" onclick="return confirm('Are you sure you want to delete this Breed?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php endif ?>

    <a href="<?= ROOT_PATH ?>/breeds/new" class="btn btn-primary my-3">New Breed</a>
</div>

