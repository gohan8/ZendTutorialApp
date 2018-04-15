<?php
echo __DIR__;

$configFile = __DIR__ . '/../config/local.ini';
$sqlScriptFile = __DIR__ . '/../data/createDb.sql';

$configSessions = parse_ini_file($configFile,true);
if ($configSessions === false) {
	error_log("Unable to get configuration from $configFile.\nUsing defaults.");
	$config = ['db.host'=>'localhost', 'db.port'=>3306, 'db.user' => '', 'db.passwd' => '' ];
} else {

    #convert sessions to dot notation [session] var = "value" to array ["session.var" => "value"]
    foreach ($configSessions as $name=>$value) {
    	if (is_array($value)) {
    		foreach ($value as $n=>$v) $config["$name.$n"] = $v;
    	}else{
    		$config[$name]=$value;
    	}
    }
}
unset($configSessions);


$dsn = "mysql:host=${config['db.host']};port=${config['db.port']};";
if (array_key_exists('db.database', $config)) 
    $dsn = "${dsn}dbname=${config['db.database']};";
$dsn = "$dsn charset=utf8;";

print "$dsn\n";
$sqlStatements = file_get_contents($sqlScriptFile);

try {
    print "Connecting to ${config['db.host']}:${config['db.port']}...\n";
	$dbCon = new PDO($dsn, $config['db.user'], $config['db.passwd']);
	if ($sqlStatements === false) {
        $errMsg = "Unable to read sql script. [$sqlScriptFile]\n";
        error_log($errMsg);
        die($errMsg);
    }
    $count = $dbCon->exec($sqlStatements);
	print "Sql create script returns $count \n";
}catch(PDOException $pdoe){
	error_log($pdoe->getMessage());
	error_log($pdoe->getTraceAsString());
}




?>