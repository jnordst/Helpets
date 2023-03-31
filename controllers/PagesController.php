<?php

    function index () {
        render("pages/index", [
            "title" => "Helpets"
        ]);
    }

    function about () {
        render("pages/about", [
            "title" => "About"
        ]);
    }

    function contact () {
        render("pages/contact",[
            "title" => "About"
        
        ]);

    }





?>