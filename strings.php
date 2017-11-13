<?php
// Connection
define('hostname', 'localhost');
define('user', 'root');
define('password', '');
define('databaseName', 'db');

// Tables
define("T0", "photos");
define("T1", "users");

// photo data
define("DATA", "data");

// Columns of logbook table
define("T0_C0", "timestamp");
define("T0_C1", "rating");
define("T0_C2", "rating_count");
define("T0_C3", "report_count");
define("T0_C4", "device");

// Columns of users table
define("T1_C0", "device");

// WAV file extention and folder to store wavs
define("TXT_EXT", ".txt");
define("PHOTO_PATH", "photos/");

// SQL JSON keys and messages
define("SQL_SUCCESS", "success");
define("SQL_MESSAGE", "message");
define("SQL_FAILURE", "failed");
define("SQL_INSERT_MESSAGE", "Inserted to MySQL.");
define("JSON_ROW_PREFIX", "row");

// PHP Content Header
define("CONTENT_TYPE_HEADER", 'Content-Type: application/json; charset: UTF-8');
?>