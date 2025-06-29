<?php
/**
 * QMĒM CRM Database Connection (Improved)
 * - Uses environment variables for credentials
 * - Sets charset to utf8mb4
 * - Uses exception handling and logs errors
 */

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$dbname = getenv('DB_NAME') ?: 'qmem_crm';

try {
    $conn = new mysqli($host, $user, $pass, $dbname);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    error_log("[".date('Y-m-d H:i:s')."] DB Connection Error: " . $e->getMessage() . "\n", 3, __DIR__ . '/db_errors.log');
    // Show generic error to user
    die("<div style='color: red; font-family: Arial, sans-serif; margin: 2em;'>"
        . "Database Connection Failed. Please try again later."
        . "</div>");
}
?>
