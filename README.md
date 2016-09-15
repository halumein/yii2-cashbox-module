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


Виджет выбора дефолтной кассы:

Для этого имплементим модель юзера и добавляем необходимые методы:


```
class YourUser extends ActiveRecord implements \halumein\cashbox\interfaces\User
{
    ...
        public function setDefaultCashbox($cashboxId)
        {
             $this->default_cashbox = $cashboxId;
             return $this->save(false);
        }

        public function getDefaultCashbox()
        {
            return $this->default_cashbox;
        }
    ...
}
```

Вывод виджета
```
    <?= halumein\cashbox\widgets\UserCashboxSelector::widget() ?>
```
