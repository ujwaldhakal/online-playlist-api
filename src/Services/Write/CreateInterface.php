<?php

namespace OP\Services\Write;

interface CreateInterface
{
    public function getId(): string;

    public function extract(): array;
}
