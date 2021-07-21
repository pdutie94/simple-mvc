<?php 
class Login {
    public static function isLoggedIn() {
        if (isset($_COOKIE['user_id'])) {
          return true;
        } else {
          return false;
        }
    }
}