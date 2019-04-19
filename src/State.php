<?php

namespace FiniteStateMachine;

class State
{
    use ForwardsCalls;

    /**
     * The machine to which this state belongs.
     *
     * @var Machine
     */
    protected $machine;

    /**
     * The name of this state.
     *
     * @var string
     */
    protected $name;

    /**
     * The default constructor for this class.
     *
     * @param  Machine $machine The machine to which this state belongs.
     * @param  string  $name    The name of the state.
     *
     * @return void
     */
    public function __construct(Machine $machine, string $name) {
        $this->machine = $machine;
        $this->name = $name;
    }

    /**
     * Retrieve the description of this state.
     *
     * @return Machine
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * Retrieve the name of this state.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * We redirect all "difficult questions" back to the machine we belong to.
     *
     * @param  $method    The method that was called.
     * @param  $arguments The arguments that were used to make the method call.
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->forwardCallTo($this->machine, $method, $parameters);
    }
}
