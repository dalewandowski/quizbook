<?PHP

$config = require_once "./dataBase/dbconfig.php";

try {

    $dbConfig = new PDO(
        "mysql:host={$config['host']};
    dbname={$config['dbName']};
    charset=utf8",
        $config['user'],
        $config['password'],
        [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

        ]
    );
} catch (PDOException $error) {
    echo $error;
    exit("Database error");
}
