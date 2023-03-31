<?php

    require_once("./models/ResourceModel.php");
    require_once("./models/BreedModel.php");

    function index () {
        $animals = ResourceModel::findAll();

        render("resources/index", [
            "animals" => $animals,
            "title" => "Animals"
        ]);
    }

    function show () {
        $animals = ResourceModel::findAll();
        
        render("resources/show", [
            "animals" => $animals,
            "title" => "Show"
        ]);
    }

    function _new () {
        $breeds = BreedModel::findAll();

        render("resources/new", [
            "title" => "New",
            "action" => "create",
            "breeds" => ($breeds ?? [])

        ]);
    }

    function edit ($request) {
        if (!isset($request["params"]["animal_id"])) {
            return redirect("", ["errors" => "Missing required ID parameter"]);
        }
        
        $animal = ResourceModel::find($request["params"]["animal_id"]);
        if (!$animal) {
            return redirect("", ["errors" => "Animal does not exist"]);
        }

        render("resources/edit", [
            "title" => "Edit Animal",
            "animal" => $animal,
            "edit_mode" => true,
            "action" => "update"
        ]);
    }

    function create () {
             // Validate field requirements
             validate($_POST, "resources/new");

             // Write to database if good
             ResourceModel::create($_POST);
     
             redirect("resources", ["success" => "Animal was added successfully"]);
         }

    

    function update () {

        if (!isset($_POST['animal_id'])) {
            return redirect("animals", ["errors" => "Missing required ID parameter"]);
        }

        // Validate field requirements
        validate($_POST, "resources/edit/{$_POST['animal_id']}");

        // Write to database if good
        ResourceModel::update($_POST);
        redirect("", ["success" => "animal was updated successfully"]);
    }
    

    function delete ($request) {

        if (!isset($request["params"]["animal_id"])) {
            return redirect("animals", ["errors" => "Missing required ID parameter"]);
        }

        ResourceModel::delete($request["params"]["animal_id"]);

        redirect("", ["success" => "Animal was adopted successfully!"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["animal_name", "animal_age", "breed_id"];
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

    function sanitize($package) {}

?>