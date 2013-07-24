<?php

class boxer {

  // Not available to streetfighter class
  private $age;

  // Available to streetfighter class
  protected $wins;

  function __construct() {
    $this->age = 15;
  }

  // Return boxer's wins
  function getWins() {
    return $this->wins;
  }

  // Return boxer's age
  function getAge() {
    return $this->age;
  }
 
}

// Extend the boxer class
class streetfighter extends boxer {

  protected $teeth;

  function __construct() {
    // This works
    $this->wins = 12;
    // This does not
    $this->age = 30;
  }

}

$sf = new streetfighter();
echo $sf->getWins();

?>