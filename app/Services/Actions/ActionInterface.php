<?php

namespace App\Services\Actions;

use App\Services\VkApp;

interface ActionInterface
{
    public function __construct(VkApp $app);
}
