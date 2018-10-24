<?php
    namespace Celper;

    use Celper\CelperView as View;


    class CelperRouter
    {
        static function home($arg = "") {
            //echo('<h1>lol</h1>');
            $view = View::getInstance(__FUNCTION__);
            //$view->renderView(__FUNCTION__);
        }

        static function code404() {
            echo 'No route found'; die;
        }
    }