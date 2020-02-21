<?php

namespace Core;
use App\Config;

class View {
    
    public static function render($view, $args = []) {
        
        extract($args, EXTR_SKIP);   
        
        $file = "../App/Views/$view";

        if(is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found.");
        }
    }

    public static function renderTemplate($template, $args = []) {
        static $twig = null;

        if($twig == null) {
            $loader = new \Twig\Loader\FilesystemLoader('../App/Views');
            $twig = new \Twig\Environment($loader);
            $twig->addGlobal('base_url', Config::BASE_URL);
            $twig->addGlobal('session', $_SESSION);
        }
        echo $twig->render($template, $args);
    }
}