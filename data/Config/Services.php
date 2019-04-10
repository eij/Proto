<?php

	return [
/*
		'auth.activation'			=> [
			'name'			=> '\Service\Authenticator\Activation',
			'dependencies'		=> [
				'Utilities/Random.php',
				'Authenticator/Activation.php'
			]
		],

		'database'				=> [
			'name'			=> '\Database\Database',
			'dependencies'		=> [
				'Database/Statement/Where.php',
				'Database/Statement/Insert.php',
				'Database/Statement/Delete.php',
				'Database/Statement/Select.php',
				'Database/Statement/Using.php',
				'Database/Handle.php',
				'Database/Query.php',
				'Database/Database.php'
			]
		],

		'session'				=> [
			'name'			=> '\Service\Session\Session',
			'dependencies'		=> [
				'Session/Adapter/Redis.php',
				'Session/Session.php'
			]

		],
*/

		'utils.fs'				=> [

			'name'			=> '\Service\Utilities\Filesystem',

			'includes'		=> [ 'Utilities/Filesystem/Filesystem.php' ]

		],

		'utils.random'				=> [
			'name'			=> '\Service\Utilities\Random',

			'includes'		=> [ 'Utilities/Random.php' ]
		],

		'utils.profiler.memory'			=> [

			'name'			=> '\Service\Utilities\Profiler\Memory',
			'includes'		=> [ 'Utilities/Profiler/Memory.php' ]

		],

		'utils.profiler.time'			=> [

			'name'			=> '\Service\Utilities\Profiler\Time',
			'includes'		=> [ 'Utilities/Profiler/Time.php' ]

		],

	];

?>
