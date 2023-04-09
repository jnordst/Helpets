<?php

require_once("./models/BreedModel.php");

function index () {
    if (!is_authorized()) return;

    if (session_status() === PHP_SESSION_NONE) session_start();
    $breeds = BreedModel::findAll();

    render("breeds/index", [
        "breeds" => $breeds,
        "title" => "breeds"
    ]);
}

function _new () {
    if (!is_authorized()) return;

    render("breeds/new", [
        "title" => "New Breed",
        "action" => "create"
    ]);
}

function edit ($request) {
    if (!is_authorized()) return;

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
    if (!is_authorized()) return;

    // Validate field requirements
    validate($_POST, "breed/new");
    
    // Write to database if good
    BreedModel::create(sanitize($_POST));

    redirect("breeds", ["success" => "Breed was created successfully"]);
}

function update () {
    if (!is_authorized()) return;

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
    if (!is_authorized()) return;

    // Missing ID
    if (!isset($request["params"]["breed_id"])) {
        return redirect("breeds", ["errors" => "Missing required ID parameter"]);
    }

    BreedModel::delete($request["params"]["breed_id"]);

    redirect("breeds", ["success" => "Breed was deleted successfully"]);
}

function validate ($package, $error_redirect_path) {
    if (!is_authorized()) return;

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

function sanitize($package) {
    $name = $package["breed_name"];
  
    // Trim any leading or trailing spaces from the name
    $name = trim($name);
  
    // Capitalize the first letter of each word in the name
    $name = ucwords(strtolower($name));

    $package["breed_name"] = $name;

    return $package;
}

function is_authorized()
{
    if (session_status() === PHP_SESSION_NONE) session_start();


    if (!isset($_SESSION["user"]))
    {
        return redirect("login", ["errors" => "You must be logged in to view this page"]);
    }

    return true;
}

?>