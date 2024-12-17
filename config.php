<?php
class Config
{
    private static $pdo = null;

    public static function getConnexion()
    {
        if (self::$pdo === null) {
            $host = 'localhost';
            $db = 'tache_post'; // Your database name
            $user = 'root'; // Your database username
            $pass = ''; // Your database password

            try {
                // Create a new PDO connection
                self::$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                // Set attributes for error handling and fetch mode
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                die('Connection failed: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}

// Call the method to ensure the connection is established
Config::getConnexion();
?>
