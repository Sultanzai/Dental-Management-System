<?php
// MySQL database configuration
$host = 'localhost'; 
$username= "root";
$password = "";
$database = "dms";
// Backup filename and path
$backupFileName = '_DMS_Backup_' . date('Y-m-d') . '.sql';
$backupPath = 'D:/DB/' . $backupFileName;

// Create a new MySQLi instance
$mysqli = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($mysqli->connect_errno) {
    echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
    exit;
}

// Retrieve a list of tables in the database
$tables = [];
$result = $mysqli->query("SHOW TABLES");
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

// Generate the SQL file content
$content = '';
foreach ($tables as $table) {
    $result = $mysqli->query("SELECT * FROM {$table}");
    $content .= "DROP TABLE IF EXISTS {$table};\n";
    $row2 = $mysqli->query("SHOW CREATE TABLE {$table}")->fetch_row();
    $content .= "{$row2[1]};\n";
    while ($row = $result->fetch_row()) {
        $content .= "INSERT INTO {$table} VALUES (";
        foreach ($row as $value) {
            $content .= "'{$mysqli->real_escape_string($value)}', ";
        }
        $content = rtrim($content, ', ') . ");\n";
    }
    $content .= "\n";
}

// Save the content to the backup file
if (file_put_contents($backupPath, $content)) {
    echo 'Database backup has been created successfully.';
} else {
    echo 'Error creating database backup.';
}

// Close the MySQLi connection
$mysqli->close();
?>