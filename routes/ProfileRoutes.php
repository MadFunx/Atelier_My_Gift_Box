<?php

use mygiftbox\models\User;
use mygiftbox\controllers\ProfileController;

function checkProfile($route){
    $app = \Slim\Slim::getInstance();

    if(!isset($_SESSION['id_user'])){
            $app->flash('error','Vous devez vous identifier');
            $app->redirect($app->urlFor('login'));
    }
    
};

$app->group('/profile','checkProfile', function() use ($app){

    $app->get("/", function(){
        $c = new ProfileController();
        $c->getProfile();
    })->name('profile');

    $app->get("/createBox", function(){
        $c = new ProfileController();
        $c->getCreateBox();
    })->name('profile.createBox');

    $app->post("/createBox", function(){
        $c = new ProfileController();
        $c->postCreateBox();
    });
    
    $app->get("/settings", function(){
        $c = new ProfileController();
        $c->getSettings();
    })->name('profile.settings');
    
    $app->post("/settings", function(){
        $c = new ProfileController();
        $c->changePassword();    
    });
    
    $app->delete("/settings", function(){
        $c = new ProfileController();
        $c->deleteAccount(); 
    });
});

