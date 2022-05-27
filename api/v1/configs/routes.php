<?php

    $routes = array(

        'RecipeController' => array(
            'recipies/([0-9]+)' => 'main/$1',
            'recipies' => 'main'
        ),
        'AuthController' => array(
            'auth' => 'main'
        )
        
    );