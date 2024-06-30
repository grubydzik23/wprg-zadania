<?php

class Animal {
    private static $class_name;
    protected string $species;
    private int $id;
    public static function info() {
        return "I am an animal. My class name is " . self::$class_name;
    }

    public function makeSound(): string
    {
        return "Animal sounds";
    }
}