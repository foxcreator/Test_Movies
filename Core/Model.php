<?php

namespace Core;

use Config\Config;
use Core\Traits\QueryTrait;
use PDO;

abstract class Model
{
    use QueryTrait;
}