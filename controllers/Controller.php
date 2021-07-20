<?php 
class Controller {
    public static function createView($viewName) {
        require_once "./views/$viewName.php";
    }
}