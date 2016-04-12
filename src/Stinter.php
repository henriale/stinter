<?php

namespace Henriale\Stinter;

use Henriale\Stinter\Contracts\StinterInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class Stinter implements StinterInterface
{
    use HandlesAuthorization;

    /** @var string $stint Stint name */
    protected $stint;

    /**
     * Create a new stinter instance.
     *
     * @param GateContract $gate
     * @param string|null $ability Name used to call the restriction
     */
    public function __construct(GateContract $gate, $ability = null)
    {
        $this->stint = is_string($ability) ? $ability : static::class;

        $gate->before([$this, 'before']);

        $gate->define($this->stint, [$this, 'check']);

        $gate->after([$this, 'after']);
    }

    /**
     * {@inheritdoc}
     */
    public function before(Authenticatable $user, $ability)
    {
        // does nothing
    }

    /**
     * {@inheritdoc}
     */
    public function check(Authenticatable $user)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function after(Authenticatable $user, $ability, $passed, $arguments)
    {
        if ($passed) {
            return $this->afterAllowed($user, $ability, $arguments);
        }

        return $this->afterDenied($user, $ability, $arguments);
    }

    /**
     * {@inheritdoc}
     */
    public function afterAllowed(Authenticatable $user, $ability, $arguments)
    {
        // does nothing
    }

    /**
     * {@inheritdoc}
     */
    public function afterDenied(Authenticatable $user, $ability, $arguments)
    {
        // does nothing
    }
}