<?php

require_once("./models/BreedModel.php");

function index () {
    if (session_status() === PHP_SESSION_NONE) session_start();
    $breeds = BreedModel::findAll();

    render("breeds/index", [
        "breeds" => $breeds,
        "title" => "breeds"
    ]);
}

function _new () {
    render("breeds/new", [
        "title" => "New Breed",
        "action" => "create"
    ]);
}

function edit ($request) {
    if (!isset($request["params"]["breed_id"])) {
        return redirect("", ["errors" => "Missing required ID parameter"]);
    }

    if (session_status() === PHP_SESSION_NONE) session_start();
    $breed = BreedModel::find($request["params"]["breed_id"]);
    if (!$breed) {
        return redirect("", ["errors" => "Breed does not exist"]);
    }

    render("breeds/edit", [
        "title" => "Edit Breed",
        "breed" => $breed,
        "edit_mode" => true,
        "action" => "update"
    ]);
}

function create () {
    // Validate field requirements
    validate($_POST, "breed/new");
    
    // Write to database if good
    BreedModel::create($_POST);

    redirect("breeds", ["success" => "Breed was created successfully"]);
}

function update () {
    // Missing ID
    if (!isset($_POST['breed_id'])) {
        return redirect("breeds", ["errors" => "Missing required ID parameter"]);
    }

    // Validate field requirements
    validate($_POST, "breeds/edit/{$_POST['breed_id']}");

    // Write to database if good
    BreedModel::update($_POST);
    redirect("", ["success" => "Breed was updated successfully"]);
}

function delete ($request) {
    // Missing ID
    if (!isset($request["params"]["breed_id"])) {
        return redirect("breeds", ["errors" => "Missing required ID parameter"]);
    }

    BreedModel::delete($request["params"]["breed_id"]);

    redirect("breeds", ["success" => "Breed was deleted successfully"]);
}

function validate ($package, $error_redirect_path) {
    $fields = ["breed_name"];
    $errors = [];

    // No empty fields
    foreach ($fields as $field) {
        if (empty($package[$field])) {
            $humanize = ucwords(str_replace("_", " ", $field));
            $errors[] = "{$humanize} cannot be empty";
        }
    }

    if (count($errors)) {
        return redirect($error_redirect_path, ["form_fields" => $package, "errors" => $errors]);
    }
}

?>