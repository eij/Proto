<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<title>Uh?</title>

		<style type="text/css">
		body { font-family: monospace; }
		.content { position: absolute; top: 20%; }
		</style>
	</head>
	<body>
		<div class="content">
			<h1>Error</h1>
			<p>Woah.</p>

			<p><?php echo $this->getError(); ?></p>
		</div>

	</body>
</html>
