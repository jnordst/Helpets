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

    function create () {}

    function update () {}

    function delete ($request) {}

    function validate ($package, $error_redirect_path) {}

    function sanitize($package) {}

?>