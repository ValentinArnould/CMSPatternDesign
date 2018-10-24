<?php
    namespace Celper;


class CelperView {

        private static $_instance = null;
        private $viewDirectory = "View/"; 

        private function __construct() {}

        private function loadView($viewName, Array $values = []) {
            $m = new \Mustache_Engine();
            $s = new \scssc();
            $scss = file_get_contents('View/public/style.scss');
            $css = $s->compile($scss);
            unlink('View/public/style.css');
            file_put_contents('View/public/style.css',$css);
            $viewPath = $this->viewDirectory . $viewName . ".html";
            $header = file_get_contents('View/layout/header.html');
            $footer = file_get_contents('View/layout/footer.html');
            $content = $header . file_get_contents($viewPath) . $footer;
            if(!empty($values) && isset($values["type"]) && $values["type"] == "mustache") {
                $content = $m->render($content, array("content" => $values["html"]));
            }
            if (!empty($values) && isset($values["edit"])) {
                $client = $values["client"];
                $content = $m->render($content, array("id" => $client["id"],"nom" => $client["Nom"],"prenom" => $client["Prenom"],"age" => $client["Age"]
                ,"adresse" => $client["Adresse"],"telephone" => $client["Telephone"],"codepostal" => $client["CP"]));
            }
            return $content;
        }
        private function renderView($viewName, Array $values = []) {
            $content = $this->loadView($viewName, $values);
            echo $content;
        }

        public static function getInstance($functionName, Array $values = []) {
            if(is_null(self::$_instance)) {
                self::$_instance = new CelperView();
            }
                self::$_instance->renderView($functionName, $values);
        }
    }