```php
<?php

namespace App\Model;

use App\Model\Base\SizeQuery as BaseSizeQuery;
use Trait\Choices;

class SizeQuery extends BaseSizeQuery
{
    use Choices {getChoices as public traitChoices;}

    public static function getChoices(string $key = 'Id', string $value = 'Description', string $orderBy = 'Weight')
    {
        return static::traitChoices($key, $value, $orderBy);
    }
}
```