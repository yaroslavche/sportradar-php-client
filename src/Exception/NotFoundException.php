<?php

declare(strict_types=1);

namespace SR\Exception;

use Exception;

class NotFoundException extends Exception implements ApiClientExceptionInterface
{
}
