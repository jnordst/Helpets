<?php

    require_once("./models/ResourceModel.php");
    require_once("./models/BreedModel.php");

    function index () {
        $animals = ResourceModel::findAll();
        $breeds = BreedModel::findAll();

        render("resources/index", [
            "animals" => $animals,
            "breeds" => $breeds,
            "title" => "Animals"
        ]);
    }

    function show () {
        $animals = ResourceModel::findAll();
        $breeds = BreedModel::findAll();
        
        render("resources/show", [
            "animals" => $animals,
            "breeds" => $breeds,
            "title" => "Show"
        ]);
    }

    function _new () {
        render("resources/new", [
            "title" => "New",
            "action" => "create"
        ]);
    }

    function edit ($request) {
        render("resources/edit", [
            "title" => "Edit",
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

    

    function update () {}

    function delete ($request) {}

    function validate ($package, $error_redirect_path) {
        $fields = ["animal_name", "animal_age"];
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