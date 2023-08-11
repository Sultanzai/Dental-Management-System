<?php
// MySQL database configuration
$host = 'localhost'; 
$username= "root";
$password = "";
$database = "dms";
// Backup file path and name
$backupFilePath = 'C:/Database';

// Execute the mysql command to export the database
// $command = "mysql --host={$host} --user={$username} --password={$password} --database={$database} < {$backupFilePath}";
// exec($command, $output, $returnVar);

// // Check if the backup was successful
// if ($returnVar === 0) {
//     echo "Database backup created successfully.";
// } else {
//     echo "Database backup failed.";
// }

$tables = array();
$sql = "SHOW TABLES";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_row($result)) {
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