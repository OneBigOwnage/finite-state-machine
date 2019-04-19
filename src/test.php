<?php

namespace FiniteStateMachine;

require __DIR__.'/../vendor/autoload.php';


$machine = new Machine('Memos');

$machine
    ->addState('Draft')
    ->addState('Cancelled')
    ->addState('Active')
    ->addState('Deactivated')
    ->addTransition('Draft' , 'Cancelled')
    ->addTransition('Draft' , 'Active')
    ->addTransition('Draft' , 'Deactivated');

echo $machine;
