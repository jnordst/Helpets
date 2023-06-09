<?php

    /**
     * Routes are responsible for matching a requested path
     * with a controller and an action. The controller represents
     * a collection of functions you want associated, usually, with
     * a resource. The action is the specific function you want to call.
     */

    $routes = [
        "get" => [
            [
                "pattern" => "/",
                "controller" => "PagesController",
                "action" => "index"
            ],
            [
                "pattern" => "/about",
                "controller" => "PagesController",
                "action" => "about"
            ],
            [
                "pattern" => "/contact",
                "controller" => "UsersController",
                "action" => "contact"
            ],
            
            [
                "pattern" => "/animals",
                "controller" => "AnimalsController",
                "action" => "index"
            ],
            [
                "pattern" => "/animals/new",
                "controller" => "AnimalsController",
                "action" => "_new"
            ],
            [
                "pattern" => "/animals/:animal_id",
                "controller" => "AnimalsController",
                "action" => "show"
            ],
            [
                "pattern" => "/animals/edit/:animal_id",
                "controller" => "AnimalsController",
                "action" => "edit"
            ],
            [
                "pattern" => "/animals/delete/:animal_id",
                "controller" => "AnimalsController",
                "action" => "delete"
            ],
            [
                "pattern" => "/breeds",
                "controller" => "BreedsController",
                "action" => "index"
            ],
            [
                "pattern" => "/breeds/new",
                "controller" => "BreedsController",
                "action" => "_new"
            ],
            [
                "pattern" => "/breeds/edit/:breed_id",
                "controller" => "BreedsController",
                "action" => "edit"
            ],
            [
                "pattern" => "/breeds/delete/:breed_id",
                "controller" => "BreedsController",
                "action" => "delete"
            ],
            [
                "pattern" => "/users/new",
                "controller" => "UsersController",
                "action" => "_new"
            ],
            [
                "pattern" => "/login",
                "controller" => "UsersController",
                "action" => "login"
            ],
            [
                "pattern" => "/logout",
                "controller" => "UsersController",
                "action" => "logout"
            ],
           
        ],
        "post" => [
            [
                "pattern" => "/animals/create",
                "controller" => "AnimalsController",
                "action" => "create"
            ],
            [
                "pattern" => "/animals/update",
                "controller" => "AnimalsController",
                "action" => "update"
            ],
            [
                "pattern" => "/breeds/create",
                "controller" => "BreedsController",
                "action" => "create"
            ],
            [
                "pattern" => "/breeds/update",
                "controller" => "BreedsController",
                "action" => "update"
            ],
            [
                "pattern" => "/users/create",
                "controller" => "UsersController",
                "action" => "create"
            ],
            [
                "pattern" => "/authenticate",
                "controller" => "UsersController",
                "action" => "authenticate"
            ],
            [
                "pattern" => "/send_email",
                "controller" => "UsersController",
                "action" => "send_email"
            ],
        ]
    ];

?>