<?php
 
     namespace src\Models;
     use src\Models\Articles\Article;
     use src\Services\Db;
     use ReflectionObject;
 
     abstract class ActiveRecordEntity{
         
         protected $id; // id статьи 
         public function getId() {  // получеине этого id
             return $this->id;
         }
 
         public function __set($name, $value) // рефлексия, необходимо для сопоставления полей БД со свойствами объекта
         {
             $camelCaseName = $this->underscoreToCamelcase($name); // преобразует имя свойства из snake_case в camelCase
             $this->$camelCaseName = $value; // тут устанавливаем значение 
         }
     
         private function underscoreToCamelcase(string $name): string // как раз тут преобразуем имена в нужный нам формат 
         {
             return lcfirst(str_replace('_','',ucwords($name, '_'))); // сначала все симовлы после '_' изменяем в верхний регистр, потом удаляем "_", и первую букву делаем в нижнем регистре 
         }
         
         private function camelCaseToUnderscore(string $source): string // а туть обратное преобразование 
         {
             return strtolower(preg_replace('/([A-Z])/', '_$1', $source)); // перед большими буквами ставим "_" и делаем слово в нижнем регистре
         }
 
         private function mapPropertiesToDb(): array // преобразуем свойства в массив для БД через рефлексию с ReflectionObject
         {
             $reflector = new ReflectionObject($this); // создается объект ReflectionObject для текущего объекта
             $properties = $reflector->getProperties(); // получаем все свойства объекта 
             $mappedProperties = [];
             foreach($properties as $property){ // тут начинается перебор всех свойств
                 $propertyName = $property->getName(); // получаем имя свойства 
                 $propertyDbName = $this->camelCaseToUnderscore($propertyName); // преобразуем его 
                 $mappedProperties[$propertyDbName]= $this->$propertyName; //складываем все в массив
             }
             return $mappedProperties; //возвращаем готовый массив для подстанвоки в SQL
         }

         public static function findAll(): ?array // получение всех записей
         {
             $db = Db::getInstance();  // подключение к БД
             $sql = 'SELECT * FROM `'.static::getTableName().'`'; // формируем запрос и возвращаем в качестве массива объектов текущего класса
             return $db->query($sql, [], 
             static::class); // благодаря этому возвратит объект соответсвующего класса 
         }
     
         public static function getById(int $id): ?static
         {
             if ($id <= 0) {
                 return null;
             }
             
             $db = Db::getInstance(); // подключение к БД
             $entities = $db->query(
                 'SELECT * FROM ' . static::getTableName() . ' WHERE id = :id', // формируем запрос, getTableName используется для получения имени таблицы 
                 [':id' => $id], 
                 static::class // благодаря этому возвратит объект соответсвующего класса 
             );
             return $entities[0] ?? null; // возвращаем первый объект из результата
         }

         public function save() // save определяет, нужно делать insert или update
         {
             if ($this->getId()) $this->update(); //если есть id, то выполняет update
             else $this->insert(); // если нет - insert
         }
     
         private function update(){ // он формирует sql-запрос для обновления записи, этот метод вызывается из метода save, когда есть id
            $properties = $this->mapPropertiesToDb(); // получение свойств в виде массива для БД
            $column2Params = []; //будет хранить часть массива "ключ", т е столбец
            $param2Value = []; // будет хранить значение 
            foreach( $properties as $key=>$value){ // начинается перебор всех элементов массива $properties
                $column = '`'.$key.'`'; // столбец в формате `name_column`
                $param = ':'.$key; // cоздаётся строка с именем параметра
                $column2Params[] = $column.'='.$param; //  добавление в массив : `abracadabrs`=:abracadabra, те столбец = :паарметр
                $param2Value[$param] = $value; // добавленние в массив значения параметр: значение
            }
            $sql = 'UPDATE `'.static::getTableName().'` SET '.implode(',', $column2Params).' WHERE `id`=:id'; //получение название таблицы из класса-наследника, объединяет все set через запятую, WHERE для обнводения определеннйо записи 
            $db = Db::getInstance(); // получение подключения к БД
            $db->query($sql, $param2Value, static::class); // формирование запроса. Передается класс в который нужно будет вернуть результат и значения для запроса 
         }
     
         private function insert(){ // он формирует sql-запрос для создания новой записи 
            $properties = array_filter($this->mapPropertiesToDb()); // преобразует свойства объекта в массив для БД, а array_filter удаляет пустые значения 
            $columns = []; // для хранения имён столбцов
            $params = []; // для имён параметров с двоеточием
            $param2Value = []; // для связки параметра и значения 
             foreach($properties as $key=>$val){ // начинается цикл по свойствами key(столбец) and val(значение свойства)
                 $columns[] = '`'.$key.'`'; // делает навание столбца в кавычках 
                 $param = ':'.$key; // добавляет двоеточие для параметра 
                 $params[] = $param; // сохранение параметра 
                 $param2Value[$param] = $val;  // создаёт пару типа параметр => значение
             }
            $sql = 'INSERT INTO `'.static::getTableName().'`('.implode(',', $columns).') VALUES ('.implode(',', $params).')'; //формирование sql-запроса 
            $db = Db::getInstance(); // получение подключения к БД
            $db->query($sql, $param2Value, static::class); // формирование запроса. Передается класс в который нужно будет вернуть результат и значения для запроса
         }
         
         public function delete() // формирует sql-запрос, который удаляет запись 
     {
         $sql = 'DELETE FROM `'.static::getTableName().'` WHERE `id`=:id'; // формируется запрос, где навание таблицы берется из статического класса-наследника и удаляется по условию с именованным параметром 
         $db = Db::getInstance(); // получение подключения к БД
         $db->query($sql, [':id'=>$this->id], static::class); // передает в query запрос, id с именованным параметром и имя текущего класса  
     }

         abstract protected static function getTableName(): string; // абстрактный метод, который реализован в дочерних классах 
     }