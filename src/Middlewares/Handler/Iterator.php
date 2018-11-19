<?php
namespace Metamorphosis\Middlewares\Handler;

use Metamorphosis\Middlewares\MiddlewareInterface;
use Metamorphosis\Record\RecordInterface;

class Iterator extends AbstractMiddlewareHandler
{
    public function handle(RecordInterface $record): void
    {
        $entry = current($this->queue);
        $middleware = is_string($entry) ? app($entry) : $entry;
        next($this->queue);

        if ($middleware instanceof MiddlewareInterface) {
            $middleware->process($record, $this);
        }
    }
}
