<?php

	#	Variables

	require '../core/Definitions.php';

	#	Core

	require '../core/Fault/Fault.php';

	#$fault = new \Fault\Fault;

	require '../core/Routing/Request.php';
	require '../core/Routing/Response.php';

	require '../core/Rendering/Render.php';

	require '../core/Routing/Pattern.php';
	require '../core/Routing/Route.php';
	require '../core/Routing/Router.php';

	#	Services

	require '../service/Database/Statement/Where.php';
	require '../service/Database/Statement/Insert.php';
	require '../service/Database/Statement/Delete.php';
	require '../service/Database/Statement/Select.php';
	require '../service/Database/Statement/Using.php';
	require '../service/Database/Handle.php';
	require '../service/Database/Query.php';
	require '../service/Database/Database.php';

	$router = new \Routing\Router(new \Routing\Request, new \Routing\Response, new \Rendering\Render);

	$router->get('/', function ($response) {
		$response->status(200)->send();

		$database = new \Database\Database([ 'host' => 'localhost', 'username' => 'root', 'password' => 'wmilan' ]);

		$database->using('sakila');

		$q = $database->select()->from('a')->where('x', '=', 'test')->where('y', '=', 'test', 'OR')->where('z', '>', 'a', 'AND')->whereLike('a', '%b', 'AND')->orderBy(['a', 'b' => 'DESC'])->get();

		$q = $database->insert([ 'x' => 'a', 'y' => 'b' ])->into('table')->where('x', '=', 'a')->where('y', '=', 'b', 'AND')->exec();

		$q = $database->delete('a')->from('b')->exec();

		$q = $database->select()->from('film')->whereLike('description', '%Tale%')->get(10);

		foreach ($q->query as $row) {
			print_r($row);
		}

		echo $q->speed;
	});

	$router->fromData()->match();

?>
