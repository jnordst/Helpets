<?php

    require_once("./models/AnimalModel.php");
    require_once("./models/BreedModel.php");

    function index () {
        if (!is_authorized()) return;
        $animals = AnimalModel::findAll();

        render("animals/index", [
            "animals" => $animals,
            "title" => "Animals"
        ]);
    }

    function show () {
        if (!is_authorized()) return;

        $animals = AnimalModel::findAll();
        
        render("animals/show", [
            "animals" => $animals,
            "title" => "Show"
        ]);
    }

    function _new () {
        if (!is_authorized()) return;

        $breeds = BreedModel::findAll();

        render("animals/new", [
            "title" => "New",
            "action" => "create",
            "breeds" => ($breeds ?? [])
        ]);
    }

    function edit ($request) {
        if (!is_authorized()) return;

        if (!isset($request["params"]["animal_id"])) {
            return redirect("", ["errors" => "Missing required ID parameter"]);
        }
        
        $animal = AnimalModel::find($request["params"]["animal_id"]);
        if (!$animal) {
            return redirect("", ["errors" => "Animal does not exist"]);
        }

        $breeds = BreedModel::findAll();


        render("animals/edit", [
            "title" => "Edit Animal",
            "animal" => $animal,
            "breeds" => ($breeds ?? []),
            "edit_mode" => true,
            "action" => "update"
        ]);
    }

    function create () {
        if (!is_authorized()) return;

        // Validate field requirements
        validate($_POST, "animals/new");

        // Write to database if good
        AnimalModel::create($_POST);
     
        redirect("animals/show", ["success" => "Animal was added successfully"]);
    }

    

    function update () {
        if (!is_authorized()) return;

        if (!isset($_POST['animal_id'])) {
            return redirect("animals", ["errors" => "Missing required ID parameter"]);
        }

        // Validate field requirements
        validate($_POST, "animals/edit/{$_POST['animal_id']}");

        // Write to database if good
        AnimalModel::update($_POST);
        redirect("", ["success" => "Animal was updated successfully"]);
    }
    

    function delete ($request) {
        if (!is_authorized()) return;

        if (!isset($request["params"]["animal_id"])) {
            return redirect("animals", ["errors" => "Missing required ID parameter"]);
        }

        AnimalModel::delete($request["params"]["animal_id"]);

        redirect("", ["success" => "Animal was adopted successfully!"]);
    }

    function validate ($package, $error_redirect_path) {
        if (!is_authorized()) return;

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

    function is_authorized()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();


        if (!isset($_SESSION["user"]))
        {
            return redirect("login", ["errors" => "You must be logged in to view this page"]);
        }

        return true;
    }
