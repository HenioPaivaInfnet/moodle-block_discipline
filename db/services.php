<?php
$functions = array(
    'block_discipline_get_enrolled_courses' => array(         //web service function name
        'classname'   => 'block_discipline_external',  //class containing the external function OR namespaced class in classes/external/XXXX.php
        'methodname'  => 'get_enrolled_courses',          //external function name
        'classpath'   => 'blocks/discipline/externallib.php',  //file containing the class/external function - not required if using namespaced auto-loading classes.
                                                   // defaults to the service's externalib.php
        'description' => 'Get enrolled courses',    //human readable description of the web service function
        'type'        => 'write',                  //database rights of the web service function (read, write)
        'ajax' => true,        // is the service available to 'internal' ajax calls. 
    ),
);