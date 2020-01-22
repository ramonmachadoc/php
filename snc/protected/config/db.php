<?php

return array(
        'components'=>array(
            'db'=>array(
				'connectionString' => 'mysql:host=localhost;dbname=auditoria_map',
				'emulatePrepare' => true,
				'username' => 'root',
				'password' => '',
				'charset' => 'utf8',
			),
        ),
	);

/*return array(
        'components'=>array(
            'db'=>array(
				'connectionString' => 'mysql:host=auditoria_map.mysql.dbaas.com.br;dbname=auditoria_map',
				'emulatePrepare' => true,
				'username' => 'auditoria_map',
				'password' => 'sgemap@123',
				'charset' => 'utf8',
			),
        ),
	);*/
