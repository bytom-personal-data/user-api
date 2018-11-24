<?php
declare(strict_types=1);

namespace App\Services\Label;

class LabelRouter
{
    public $routes;

    public function __construct()
    {
        $this->routes = config('services.label.router');
    }

    public function getBaseRules(int $type)
    {

    }
}
