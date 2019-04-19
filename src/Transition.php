<?php

namespace FiniteStateMachine;

class Transition
{
    use ForwardsCalls;

    /**
     * The machine to which this transition belongs.
     *
     * @var Machine
     */
    protected $machine;

    /**
     * The state from which this transition originates.
     *
     * @var State
     */
    protected $from;

    /**
     * The end point of this transition.
     *
     * @var State
     */
    protected $to;

    /**
     * Create a new instance.
     *
     * @param  Machine $machine The machine to which this transition belongs.
     * @param  State   $from    The state from which this transition should originate.
     * @param  State   $to      The state to transition to.
     *
     * @return void
     */
    public function __construct(Machine $machine, State $from, State $to) {
        $this->machine = $machine;
        $this->from = $from;
        $this->to   = $to;
    }

    /**
     * Retrieve the machine to which this transition belongs.
     *
     * @return Machine
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * Retrieve the starting state of this transition.
     *
     * @return State
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Retrieve the end point of this transition.
     *
     * @return State
     */
    public function getTo()
    {
        return $this->to;
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
