<?php

$connect = mysqli_connect( 
    "localhost", // Host
    "****", // Username
    "******", // Password
    "national_gallery" // Database
);

mysqli_set_charset( $connect, 'UTF8' );
