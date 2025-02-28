<?php

class Lesson {
    protected string $title;
    protected string $text;
    protected string $homework;

    public function __construct(string $title, string $text, string $homework) {
        $this->title = $title;
        $this->text = $text;
        $this->homework = $homework;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getText(): string {
        return $this->text;
    }

    public function setText(string $text): void {
        $this->text = $text;
    }

    public function getHomework(): string {
        return $this->homework;
    }

    public function setHomework(string $homework): void {
        $this->homework = $homework;
    }
}

class PaidLesson extends Lesson {
    private float $price;

    public function __construct(string $title, string $text, string $homework, float $price) {
        parent::__construct($title, $text, $homework);
        $this->price = $price;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function setPrice(float $price): void {
        $this->price = $price;
    }
}

// Создаем объект PaidLesson
$paidLesson = new PaidLesson(
    "Урок о наследовании в PHP",
    "Лол, кек, чебурек",
    "Ложитесь спать, утро вечера мудренее",
    99.90
);

// Выводим объект с помощью var_dump()
var_dump($paidLesson);
