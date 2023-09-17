<?php

declare(strict_types=1);

namespace SR\Exception;

use Exception;

class NotImplementedException extends Exception implements ApiClientExceptionInterface
{
}
