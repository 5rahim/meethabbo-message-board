<?php

class Zaki {

  $name = "Zaki";

  public function eat($what) {
    global $action;
    $action->step('eat',$what);
  }
  public function sleep($time = "21 hours") {
    global $action;
    $action->step('sleep',$time);
  }
  public function code($what) {
    global $action;
    $action->step('code',$what);
  }
}

$me = new Zaki()

$me->eat('french fries');
$me->sleep();
$me->code('website');

 ?>
