<?php

class Student {
    // Properties
    public $name;
    public $age;

    // Constructor: runs when object is created
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    // Method to display info
    public function displayInfo() {
        echo "<p>Student Name: " . $this->name . "<br>Age: " . $this->age . "</p>";
    }
}

// Creating objects
$student1 = new Student("Bharath", 20);
$student2 = new Student("Nagilla", 22);

// Calling methods
$student1->displayInfo();
$student2->displayInfo();

?>
