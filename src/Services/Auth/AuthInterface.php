<?php

namespace OP\Services\Auth;

interface AuthInterface
{
    public function attempt(array $data);

    public function getTokenExpiry(): int;
}
