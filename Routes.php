<?php

Route::set('index.php', function() {
    Home::createView('index');
});

Route::set('about-us', function() {
    AboutUs::createView('about-us');
});

Route::set('contact-us', function() {
    echo 'Contact us';
});