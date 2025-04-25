<?php
namespace src\Services;

class Db
{
    private $pdo;
    private static $instance; // устанавливаем privatе, чтобы создать экземпляр класса можно было только через getInstance()

    private function __construct()
    {
        $dbOptions = require('settings.php');  // загрузка натсроек БД
        $this->pdo = new \PDO( // создаем объект PDO
            'mysql:host='.$dbOptions['host'].';dbname='.$dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // обработка ошибок: при ошибках PDO будет выбрасывать исключения
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): array // запрос\массив праметров для запроса\в каком классе объекты будут
    {
            $stmt = $this->pdo->prepare($sql); //pdo передает выражение
            $stmt->execute($params); // подстановка параметров в запрос
            $stmt->setFetchMode(\PDO::FETCH_CLASS, $className); // тут указываем PDO преобразовывать каждую строку в объект указанного класса
            return $stmt->fetchAll(); // тут возвращаем массив объектов 
        
    }

    public function getLastInsertId(): int // функция получения id последней записи 
    {
        return (int)$this->pdo->lastInsertId(); // возвращаем id при полсденем insert
     }

    public static function getInstance(): self // тут реализуем синглтон
    {
        if (self::$instance === null) { //если экземпляров не было до этого, то создаем новый
            self::$instance = new self(); // объект создается и сохраняется 
        }
        return self::$instance; // возвращаем созданный объект для дальнейшей работы с БД
    }
}