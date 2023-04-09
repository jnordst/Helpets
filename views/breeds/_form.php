<?php
  
    $form_fields = $form_fields ?? [];
    if (count($form_fields) === 0 && isset($animal)) $form_fields = (array) $animal;
?>

<form action="<?= ROOT_PATH ?>/breeds/<?= $action ?>" method="post">
    <?php if ($action === "update"): ?>
        <input type="hidden" name="breed_id" value="<?= $form_fields["breed_id"] ?>">
    <?php endif ?>

    <div class="form-group my-3">
        <label for="breed_name">Breed</label>
        <input class="form-control" type="text" name="breed_name" value="<?= $form_fields["breed_name"] ?? "" ?>">
    </div>

    <div>
        <button class="btn btn-primary">Submit</button>
    </div>
</form>