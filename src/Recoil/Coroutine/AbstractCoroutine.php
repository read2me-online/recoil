<?php
namespace Recoil\Coroutine;

use Exception;
use Recoil\Kernel\Strand\StrandInterface;

/**
 * A base class for coroutines that keeps track of next tick state behaviour.
 */
abstract class AbstractCoroutine implements CoroutineInterface
{
    /**
     * Initialize the coroutine.
     *
     * This method is invoked before the coroutine is pushed onto the call stack.
     *
     * @param StrandInterface $strand The strand that is executing the coroutine.
     */
    public function initialize(StrandInterface $strand)
    {
    }

    /**
     * Start the coroutine.
     *
     * @param StrandInterface $strand The strand that is executing the coroutine.
     */
    abstract public function call(StrandInterface $strand);

    /**
     * Resume execution of a suspended coroutine by passing it a value.
     *
     * @param StrandInterface $strand The strand that is executing the coroutine.
     * @param mixed           $value  The value to send to the coroutine.
     */
    public function resumeWithValue(StrandInterface $strand, $value)
    {
        $strand->returnValue($value);
    }

    /**
     * Resume execution of a suspended coroutine by passing it an exception.
     *
     * @param StrandInterface $strand    The strand that is executing the coroutine.
     * @param Exception       $exception The exception to send to the coroutine.
     */
    public function resumeWithException(StrandInterface $strand, Exception $exception)
    {
        $strand->throwException($exception);
    }

    /**
     * Inform the coroutine that the executing strand is being terminated.
     *
     * @param StrandInterface $strand The strand that is executing the coroutine.
     */
    public function terminate(StrandInterface $strand)
    {
    }

    /**
     * Finalize the coroutine.
     *
     * This method is invoked after the coroutine is popped from the call stack.
     *
     * @param StrandInterface $strand The strand that is executing the coroutine.
     */
    public function finalize(StrandInterface $strand)
    {
    }
}