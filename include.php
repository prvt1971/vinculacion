<?php
    //Configuración para el servidor local
    //$USER = "root";
    //$PASSWORD = "";
    //$HOST="localhost";
    //$PATH = "H:/Mi unidad/www/titulacion";
    //$W3DIRECTORY = "http://localhost/titulacion";
    //$DBNAME = "titulacion";
    //Configuración para el servidor remoto
    $USER = getenv('DB_USER');
    $PASSWORD = getenv('DB_PASSWORD');
    $HOST = getenv('DB_HOST');
    $PATH = getenv('PROJECT_PATH');
    $DBNAME = getenv('DB_NAME');
    $W3DIRECTORY = getenv('W3DIRECTORY');
?>
