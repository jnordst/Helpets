<?php
    // Convert resource object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];

    if (session_status() === PHP_SESSION_NONE) session_start();
    $user_id = $_SESSION["user"]["id"];
?>

<div class="container">
    <h1>Contact Us</h1>

    <form action="<?= ROOT_PATH ?>/send_email" method="post">
        <input type="hidden" name="user_id" value="<?= $user_id ?>">

        <div class="form-group my-3">
            <label for="message">Send a Message</label>
            <textarea class="form-control" type="text" name="message" value="<?= $form_fields["message"] ?? "" ?>" style="height: 150px;"></textarea>
        </div>

        <div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>