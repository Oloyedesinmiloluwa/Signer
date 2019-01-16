<?php

namespace src\config;
use PDO;
use Dotenv;
require_once dirname(__DIR__,2) . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::create(dirname(__DIR__,2));
$dotenv->load();
class Database {
  
 /*  private $db_name = 'corePHP';
  private $host = "localhost";
  private $username = "root";
  private $password = "JESUS1994.mysql"; */

  /* private $db_name = $_ENV['DB_NAME'];
  private $host = getenv('DB_HOST');
  private $username = getenv('DB_USER');
  private $password = getenv('DB_PASSWORD'); */
    public $connection;
    
    public $dbh;
    public $stmt;

  public function __construct() {
    $this->db_name = $_ENV['DB_NAME'];
    $this->host = getenv('DB_HOST');
    $this->username = getenv('DB_USER');
    $this->password = getenv('DB_PASSWORD');
    $options = array(

      PDO::ATTR_PERSISTENT => true,

      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

    );
    try {
    $this->dbh = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, $options );
    //  $this->connection;
    }
    catch (PDOException $exception) {
      // die($exception->getMessage());
      echo 'A connection error occurred:'. $exception->getMessage();
      // return;
    }
    return $this->connection;
  }
  public function prepare($query)
  {
    $this->stmt = $this->dbh->prepare($query);
  }
}
