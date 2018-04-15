<?php
echo __DIR__;

$configFile = __DIR__ . '/../config/local.ini';
$sqlScriptFile = __DIR__ . '/../data/createDb.sql';
$configSessions = parse_ini_file($configFile,true);
print_r($configSessions);

#convert sessions to dot notation [session] var = "value" to array ["session.var" => "value"]
foreach ($configSessions as $name=>$value) {
	if (is_array($value)) {
		foreach ($value as $n=>$v) $config["$name.$n"] = $v;
	}else{
		$config[$name]=$value;
	}
}
unset($configSessions);
print_r($config);

$dsn = "mysql:host=${config['db.host']};port=${config['db.port']}";
$dsn = "$dsn;dbname=${config['db.database']};charset=utf8;";

$sqlStatements = file_get_contents($sqlScriptFile);
try {
	$dbCon = new PDO($dsn, $config['db.user'], $config['db.passwd']);
	$count = $dbcon->exec($sqlStatements);
	print "Sql create script returns $count \n";
	$dbCon->close;
}catch(PDOException $pdoe){
	error_log($pdoe->getMessage());
	error_log($pdoe->getTraceAsString());
}




?>