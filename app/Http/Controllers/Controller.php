<?php

    namespace App\Http\Controllers;

    class Controller
    {
        public function view($path, array $data = null)
        {
            $path = str_replace(".", "/", $path);
            ob_start();
            
            require VIEW . $path . ".php";
            $content = ob_get_clean();
            require VIEW . "/layouts/app.php";
        }

        public function redirect_back()
        {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            die();
        }

        public function redirect_to_url($path)
        {
            header("Location: ". URL . $path);
            die();
        }

        public function PageError()
        {

            
            require VIEW . "pageError.php";


            // return $this->viewError("pageError");
        }
    }