<?php

require_once "Animal.php";

class Capybara extends Animal
{
    private string $color;
    private int $age;

    public function __construct($color, $age)
    {
        $this->age = $age;
        $this->color = $color;
        $this->species = 'mammal';
    }

    public function makeSound(): string
    {
        return "Capybara Noises! My species is " . $this->species;
    }

    public function __toString(): string
    {
        return "jestę Kapibarę";
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge($age) {
        $this->age = $age;
    }


}