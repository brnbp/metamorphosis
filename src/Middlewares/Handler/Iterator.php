<?php
namespace Metamorphosis\Middlewares\Handler;

use Metamorphosis\Message;
use Metamorphosis\Middlewares\Middleware;

class Iterator extends AbstractMiddlewareHandler
{
    public function handle(Message $message): void
    {
        $entry = current($this->queue);
        $middleware = is_string($entry) ? app($entry) : $entry;
        next($this->queue);

        if ($middleware instanceof Middleware) {
            $middleware->process($message, $this);

            return;
        }

        $middleware($message, $this);
    }
}