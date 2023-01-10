<?php

namespace Helvetiapps\LiveControls\Exceptions;

use Exception;
use Throwable;

class InvalidSubscriptionException extends Exception
{
    public function __construct(string $subscription, $code = 0, Throwable $previous = null) {
        parent::__construct('Invalid Subscription "'.$subscription.'"', $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}