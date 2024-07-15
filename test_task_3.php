<?php

// Доработайте код из test_task_2.php так, чтобы он мог выполняться на сайте с возможностью выбора языка отображения
// Для простоты считаем, что имя животного может быть на любом языке, при этом порода собаки только на выбранном языке
// Пример псевдо-кода такого сайта:

require_once("./test_task_2.php");

class ConfigReader {
    public const LOCALE_RU = "ru";
    public const LOCALE_EN = "en";
}

class Translator {
    private string $locale;

    // it maybe from db or files
    private array $data = [
        ConfigReader::LOCALE_RU => [
            "Labrador" => "Лабрадор",
            "Woof" => "Гав",
            "Meow" => "Мяу",
            "cat_says_template" => "%s говорит %s",
            "dog_says_template" => "%s %s говорит %s",
            "animal_says_template" => "%s говорит %s",
            "Dog" => "Собака",
            "Cat" => "Кошка",
            "Animal" => "Животный"
        ],
        ConfigReader::LOCALE_EN => [
            "Labrador" => "Labrador",
            "Woof" => "Woof",
            "Meow" => "Meow",
            "cat_says_template" => "%s says %s",
            "animal_says_template" => "%s says %s",
            "dog_says_template" => "%s %s says %s",
            "Dog" => "Dog",
            "Cat" => "Cat",
            "Animal" => "Animal"
        ],
    ];

    public function __construct(string $locale) {
        $this->locale = $locale;
    }

    public function get(string $key): string {
        return $this->data[$this->locale][$key];
    }
}


class Controller {
    private Translator $translator;

    public function __construct(string $locale) {
        $this->translator = new Translator($locale);
    }

    public function index(): void {
        $rex = new Dog("Rex", "Labrador");
        $murka = new Cat("Мурка");

        $this->showLine($rex);
        $this->showLine($murka);
    }

    public function showLine(Animal $animal): void {
        if ($animal instanceof Dog) {
            echo sprintf(
                $this->translator->get("dog_says_template"),
                $this->translator->get($animal->getBreed() ?? "Dog"),
                $animal->getName(),
                $this->translator->get($animal->makeSound())
            ) . "\n";
            return;
        } else if ($animal instanceof Cat) {
            echo sprintf(
                $this->translator->get("cat_says_template"),
                $this->translator->get("Cat") . " " . $animal->getName(),
                $this->translator->get($animal->makeSound())
            ) . "\n";
        }  else {
            echo sprintf(  
                $this->translator->get("animal_says_template"),  
                $this->translator->get("Animal") . " " . $animal->getName(),  
                $this->translator->get($animal->makeSound())  
            ) . "\n";
        }

    }
}

$controller = new Controller(ConfigReader::LOCALE_RU);
$controller->index();
$controller_en = new Controller(ConfigReader::LOCALE_EN);
$controller_en->index();

// Ожидаемый результат работы программы
// Лабрадор Rex говорит Гав
// Кошка Мурка говорит Мяу
// Labrador Rex says Woof
// Cat Мурка says Meow
