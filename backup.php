<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'dms';

$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_errno) {
    echo "Failed to connect to MySQL: " . $connection->connect_error;
    exit;
}
    
$tables = [];
$result = $connection->query("SHOW TABLES");

if ($result) {
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }
}
$backupSql = '';

foreach ($tables as $table) {
    $result = $connection->query("SELECT * FROM $table");
    $backupSql .= "DROP TABLE IF EXISTS $table;";
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $columns = implode(',', array_keys($row));
        $backupSql .= "CREATE TABLE $table ($columns);";
        
        do {
            $values = array_map([$connection, 'real_escape_string'], array_values($row));
            $values = implode("','", $values);
            $backupSql .= "INSERT INTO $table ($columns) VALUES ('$values');";
        } while ($row = $result->fetch_assoc());
    }
}

$date = date('Y-m-d');
$backupFile = 'E: '.$date.'backup.sql';
file_put_contents($backupFile, $backupSql);
$connection->close();
header("location: /DMS/dist/index.php");
?>