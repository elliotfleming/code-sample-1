 <?php
 
return array(

    'default' => 'sqlite',

    // Use an in-memory database
    'connections' => array(
        'sqlite' => array(
            'driver'      => 'sqlite',
            'database'    => ':memory:',
            'prefix'      => ''
        ),
    )
);
