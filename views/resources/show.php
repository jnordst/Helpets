<div class="container">
    <h1>Animals</h1>
</div>

<div class="container">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-fixed text-center">
            <thead>
                <tr>
                    <th class="w-30">Name</th>
                    <th class="w-30">Breed</th>
                    <th class="w-10">Age</th>
                    <th class="w-30">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($breeds as $breed): ?>
                    <tr>
                        <td><?=$breed->animal_name?></td>
                        <td><?=$breed->breed_name?></td>
                        <td><?=$breed->animal_age?></td>
                        <td>
                            <a class="btn btn-success" href="<?= ROOT_PATH ?>/resources/delete/<?= $breed->animal_id ?>" onclick="return confirm('Are you sure you want to adopt this animal?')">Adopt</a>
                            <a class="btn btn-outline-secondary" href="<?= ROOT_PATH ?>/resources/edit/<?= $breed->animal_id ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
