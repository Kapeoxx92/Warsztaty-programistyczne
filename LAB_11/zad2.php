<?php

class User {

    public $message = "This is a message from";

    public function introduce($name) {

        return $this->message . " " . $name;

    }
}

$user = new User();

echo $user->introduce("Kacper");

?>