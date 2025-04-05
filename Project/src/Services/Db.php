<?php
namespace src\Services;

use PDO;
use PDOException;

class Db
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=localhost;dbname=project-3210', // Имя вашей БД из phpMyAdmin
                'root',   // Пользователь XAMPP по умолчанию
                '',       // Пароль (пустой для XAMPP)
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
                ]
            );
        } catch (PDOException $e) {
            throw new RuntimeException('DB connection error: ' . $e->getMessage());
        }
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        $stmt = $this->connection->prepare($sql);
        $result = $stmt->execute($params);

        if ($result === false) {
            return null;
        }

        return $stmt->fetchAll(PDO::FETCH_CLASS, $className);
    }

    public function getLastInsertId(): int
    {
        return (int)$this->connection->lastInsertId();
    }
}