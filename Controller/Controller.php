<?php

namespace Controller;
    use Celper\CelperView as View;
    use Celper\CelperRouter as Router;
    use Model\ModelClient as Client;

    class Controller extends Router
    {
        static function contact() {
            //echo('<h1>lol</h1>');
            $test = new Client();
            //var_dump($test);die;
            $view = View::getInstance(__FUNCTION__);
//            $view->renderView(__FUNCTION__);
        }

        static function clients($arg = "") {

            if($arg == "edit" or (is_array($arg) and in_array("edit",$arg))) {
                //edition avec l'id en 2e position de l'array arg)
                $c = new Client();
                $client = $c->getOneById($arg[1]);
                //var_dump($arg[1]);die;
                // foreach ($client as $key => $value) {
                //     $content .= "<td>" . $value . "</td>";
                //     var_dump($client);die;
                // }
                $content = file_get_contents('View/edit.html');
                $view = View::getInstance('edit', array("html" => $content, 'edit' => true, "client" => $client));
            } else if($arg == "delete" or (is_array($arg) and in_array("delete",$arg))) {
                //suppression avec l'id en 2e position de l'array arg)
                echo 'n0p3';
                $c = new Client();
                $client = $c->getOneById($arg[1]); 
            } elseif($arg == "save" or (is_array($arg) and in_array("save",$arg))){
                $_POST["id"] = $arg[1];
                $c = new Client();
                $c->updateClient();
                header("Location: /clients");
                
             }
            else {
                $m = new \Mustache_Engine();
                $c = new Client();
                $clients = $c->getAll();
                $menu = file_get_contents('View/layout/menuActions.html');
                $content = "";
                foreach ($clients as $key => $client) {
                    $content .= "<tr>";
    
                    foreach ($client as $key => $value) {
                        $content .= "<td>" . $value . "</td>";
                    }
                    $mid = $m->render($menu, array("id" => $client["id"]));
                    $content .= "<td>" . $mid . "</td>";
                    $content .= "</tr>";
                    
                }
                $view = View::getInstance(__FUNCTION__, array("html" => $content,"type" => "mustache", "menu" => true));
            }


//            $view->renderView(__FUNCTION__);
        }
    }