<?php
    namespace Router;

    use Controller\Controller as Controller;

    class Relper
    {
        private function trimUri($uri) {
            if(substr_count($uri, '/') > 1) {
                $uriArray = explode("/", $uri);
                //var_dump($uriArray);die;                
                $uriArray = array_filter($uriArray, function($value) { return $value !== ''; });
                $i = 0; $uriTemp = $uriArray; $uriArray = [];
                foreach ($uriTemp as $key => $uri) {$uriArray[$i] = $uri; $i++;}
                //var_dump($uriArray); die;
                return $uriArray;
            } else {
                $uriArray = substr($uri, 1);
                $uriArray = explode("/", $uriArray);
                $uriArray = array_filter($uriArray, function($value) { return $value !== ''; });
                $i = 0; $uriTemp = $uriArray;
                foreach ($uriTemp as $key => $uri) {$uriArray[$i] = $uri; $i++;}
                return $uriArray;
            }
            //return substr($uri, 1);
        }
        
        //const CLASS_SUFFIX = 'Controller';
        public function route() {
            $uris = $this->trimUri($_SERVER['REQUEST_URI']);
            $controller = new Controller();
            $ind = 'home';
            switch (count($uris)) {
                case '0':
                    $method = 'home';
                    break;
                case '1':
                    $method = 'single';
                    break;
                case '2':
                    $method = 'compose';                
                    break;
                default:
                    $ur = array_slice($uris, 1);
                    $uris = array_slice($uris, 0, 1);
                    array_push($uris, $ur);
                    $method = 'compose';
                    break;
            }
            if($method == 'home') {
                $controller::home();
            }
            else if(!empty($uris) && method_exists($controller,$uris[0])) {
                if($method == 'single') {
                    $controller::{$uris[0]}();
                } else if($method == 'compose') {
                    //var_dump('compose');die;
                    $controller::{$uris[0]}($uris[1]);
                }
            } 
            else {
                $controller->code404();
            }
        }
    }
    