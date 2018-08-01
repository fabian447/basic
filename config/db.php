<?php

return [
	 //clase para la conexión
    'class' => 'yii\db\Connection',
     //DNS(ruta) y nombre de la base de datos
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    // usuario por defecto de la base de datos
    'username' => 'root',
    // Contrseña (en este caso no tiene contraseña)
    'password' => '',
    //Chartse utf8 con soporte de Español
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
