<?php

$connect = mysqli_connect( 
    "localhost", // Host
    "root", // Username
    "root", // Password
    "national_gallery" // Database
);

mysqli_set_charset( $connect, 'UTF8' );
