<?php
   // Load .env file
   $envFile = __DIR__ . '/.env';
   if (file_exists($envFile)) {
      $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      foreach ($lines as $line) {
         if (strpos(trim($line), '#') === 0) {
            continue; // Skip comments
         }
         list($key, $value) = explode('=', $line, 2);
         $key = trim($key);
         $value = trim($value);
         if (!array_key_exists($key, $_SERVER) && !array_key_exists($key, $_ENV)) {
            putenv(sprintf('%s=%s', $key, $value));
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
         }
      }
   }

   // Get database path from .env or use default
   $dbPath = getenv('DB_PATH') ?: '../database/criminalinfo.db';
   define('DB_PATH', __DIR__ . '/' . $dbPath);
   $db = new SQLite3(DB_PATH);
   $db->enableExceptions(true);
?>