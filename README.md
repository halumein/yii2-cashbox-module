Yii2-cashbox-module
==========


```
php composer require halumein/yii2-cashbox-module "*"
```

миграция:

```
php yii migrate --migrationPath=vendor/halumein/yii2-cashbox-module/migrations
```

В конфигурационный файл приложения добавить модуль test

```php
    'modules' => [
        'cashbox' => [
            'class' => 'halumein\cashbox\Module',
        ],
        //...
    ]
```

