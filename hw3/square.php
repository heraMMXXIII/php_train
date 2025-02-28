<?php

interface CalculateSquare {
    public function getSquare(): float;
}

class Circle implements CalculateSquare {
    private float $radius;

    public function __construct(float $radius) {
        $this->radius = $radius;
    }

    public function getSquare(): float {
        return pi() * pow($this->radius, 2);
    }
}

class Rectangle implements CalculateSquare {
    private float $width;
    private float $height;

    public function __construct(float $width, float $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function getSquare(): float {
        return $this->width * $this->height;
    }
}

class Triangle {
    private float $base;
    private float $height;

    public function __construct(float $base, float $height) {
        $this->base = $base;
        $this->height = $height;
    }

    public function getBase(): float {
        return $this->base;
    }

    public function getHeight(): float {
        return $this->height;
    }
}

function printSquareInfo($object) {
    $className = get_class($object);
    if ($object instanceof CalculateSquare) {
        echo "Объект класса $className. Площадь: " . $object->getSquare() . PHP_EOL;
    } else {
        echo "Объект класса $className не реализует интерфейс CalculateSquare." . PHP_EOL;
    }
}

// Тестирование
$circle = new Circle(5);
$rectangle = new Rectangle(4, 6);
$triangle = new Triangle(3, 7);

printSquareInfo($circle);
printSquareInfo($rectangle);
printSquareInfo($triangle);
