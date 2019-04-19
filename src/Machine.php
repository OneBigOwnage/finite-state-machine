<?php

namespace FiniteStateMachine;

class Machine
{
    /**
     * The name of this machine.
     *
     * @var string
     */
    protected $name;

    /**
     * All states that are defined in this machine.
     *
     * @var array|State
     */
    protected $states;

    /**
     * All transitions that are part of this machine.
     *
     * @var array|Transition
     */
    protected $transitions;

    /**
     * The default constructor of this class.
     *
     * @param  array $states The states that this machine should consist of.
     *
     * @return void
     */
    public function __construct(string $name, array $states = [], array $transitions = []) {
        $this->name = $name;
        $this->states = $states;
        $this->transitions = $transitions;
    }

    /**
     * Add a new state to the machine.
     *
     * @param  string $name        The name of the state.
     * @param  string $description (optional) The description of the state.
     *
     * @return State
     */
    public function addState($name)
    {
        $this->states[] = $state = new State($this, $name);

        return $state;
    }

    /**
     * Add a new transition to the machine.
     *
     * @param  State|string $from The starting state of the transition.
     * @param  State|string $to   The end state of the transition.
     *
     * @return Transition
     */
    public function addTransition($from, $to)
    {
        if (gettype($from) === 'string') {
            $from = $this->findState($from);
        }

        if (gettype($to) === 'string') {
            $to = $this->findState($to);
        }

        $this->transitions[] = $transition = new Transition($this, $from, $to);

        return $transition;
    }

    /**
     * Retrieve a state by name or null if it could not be found.
     *
     * @param  string $name The name of the state.
     *
     * @return State|null
     */
    public function findState(string $name)
    {
        $names = array_map(function ($state) {
            return $state->getName();
        }, $this->states);

        $key = array_search($name, $names);

        if (array_key_exists($key, $this->states)) {
            return $this->states[$key];
        }
    }

    /**
     * Retrieve all states that are defined in this machine.
     *
     * @return array|State
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * A string representation of the machine.
     *
     * @return string
     */
    public function __toString()
    {
        $string = "Finite State Machine [{$this->name}]" . PHP_EOL. PHP_EOL;

        $string .= 'This machine has the following states:' . PHP_EOL;

        foreach ($this->states as $state) {
            $string .= "- {$state->getName()}" . PHP_EOL;
        }

        $string .= PHP_EOL . 'This machine has the following transitions:' . PHP_EOL;

        foreach ($this->transitions as $transition) {
            $string .= "[{$transition->getFrom()->getName()}] => [{$transition->getTo()->getName()}]" . PHP_EOL;
        }

        return $string;
    }
}
