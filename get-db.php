<?php
	function getDb() {
		$db = NULL;

		// default Heroku Postgres configuration URL
		$dbUrl = getenv('DATABASE_URL');

		if (empty($dbUrl))
			$dbUrl = 'postgres://postgres:password@localhost:5432/pos';

		$dbopts     = parse_url($dbUrl);
		$dbHost     = $dbopts["host"];
		$dbPort     = $dbopts["port"];
		$dbUser     = $dbopts["user"];
		$dbPassword = $dbopts["pass"];
		$dbName     = ltrim($dbopts["path"],'/');

		try {
		 $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
		 $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch (PDOException $ex) {
			die();
		}

		return $db;
	}
?>