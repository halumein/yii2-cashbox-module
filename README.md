Yii2-cashbox-module
==========


```
php composer require halumein/yii2-cashbox-module "*"
```

миграции:

```
php yii migrate --migrationPath=vendor/halumein/yii2-cashbox-module/migrations
```

В конфигурационный файл приложения добавить модуль cashbox

```php
    'modules' => [
        'cashbox' => [
            'class' => 'halumein\cashbox\Module',
        ],
        //...
    ]
```

дальше обращаться по адресу cashbox/<имя_контроллера>
