<?php

Route::set('', function() {
    View::make('Home');
});

Route::set('login', function() {
  View::make('Login');
});