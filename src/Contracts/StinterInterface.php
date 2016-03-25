<?php

namespace Henriale\Stinter\Contracts;

use Illuminate\Contracts\Auth\Authenticatable;

interface StinterInterface
{
    /**
     * @param Authenticatable $user
     * @param string $ability
     *
     * @return void
     */
    public function before(Authenticatable $user, $ability);

    /**
     * @param Authenticatable $user
     *
     * @return boolean
     */
    public function check(Authenticatable $user);

    /**
     * @param Authenticatable $user
     * @param string $ability
     * @param boolean $passed
     * @param array $arguments
     *
     * @return mixed
     */
    public function after(Authenticatable $user, $ability, $passed, $arguments);

    /**
     * @param Authenticatable $user
     * @param string $ability
     * @param array $arguments
     *
     * @return mixed
     */
    public function afterAllowed(Authenticatable $user, $ability, $arguments);

    /**
     * @param Authenticatable $user
     * @param string $ability
     * @param array $arguments
     *
     * @return mixed
     */
    public function afterDenied(Authenticatable $user, $ability, $arguments);
}