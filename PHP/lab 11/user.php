<?php
class User {
    public $message = "This is a message from";

    public function introduce($name) {
        return $this->message . " " . $name;
    }
}

// Testowanie klasy
$user = new User();
echo $user->introduce("John");
?>
