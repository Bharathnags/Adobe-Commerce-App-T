<?php

class Welcome {
    static $name = "bbn";
    static $city = "blore";

    static function greet() {
        echo "<p>Welcome to " . self::$name . " from " . self::$city . "</p>";
    }
}

Welcome::greet();

?>
