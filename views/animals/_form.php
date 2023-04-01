<?php
    // Convert resource object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];
    if (count($form_fields) === 0 && isset($animal)) $form_fields = (array) $animal;
?>

<form action="<?= ROOT_PATH ?>/animals/<?= $action ?>" method="post">
<?php if ($action === "update"): ?>
        <input type="hidden" name="animal_id" value="<?= $form_fields["animal_id"] ?>">
    <?php endif ?>
    
    <div class="form-group my-3">
        <label for="animal_name">Animal Name</label>
        <input class="form-control" type="text" name="animal_name" value="<?= $form_fields["animal_name"] ?? "" ?>">
    </div>

    <div class="form-group my-3">
        <label for="animal_age">Age</label>
        <input class="form-control" type="number" name="animal_age" value="<?= $form_fields["animal_age"] ?? "" ?>">
    </div>

    <div class="form-group my-3">
        <label for="breed_id">Breed Name</label>
        <select class="form-select" name="breed_id">
            <option value="" selected>Choose a Breed...</option>
            <?php foreach ($breeds as $breed): ?>
                <?php
                    $selected = (isset($form_fields["breed_id"]) && $form_fields["breed_id"] == $breed->breed_id) ? "selected" : "";
                ?>

                <option value="<?= $breed->breed_id ?>" <?= $selected ?>>
                    <?= $breed->breed_name ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div>
        <button class="btn btn-primary">Submit</button>
    </div>
    
</form>