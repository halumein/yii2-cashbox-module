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


компонент:

```
'CashboxOperations' => [
    'class' => 'halumein\cashbox\CashboxOperations'
],
```

Виджет выбора дефолтной кассы:
Первое что потребуется - это дополнить таблицу пользователя в базе данных полем "default_cashbox", куда будет записываться id кассы по умолчанию для выбранного пользователя.

Затем имплементим модель юзера используемую в приложении и добавляем необходимые методы, они могут выглядеть например так:


```
class YourUser extends ActiveRecord implements \halumein\cashbox\interfaces\User
{
    ...
        public function getId()
        {
            return $this->getPrimaryKey();
        }

        public function setDefaultCashbox($cashboxId)
        {
             $this->default_cashbox = $cashboxId;
             return $this->save(false);
        }

        public function getDefaultCashbox()
        {
            return $this->default_cashbox;
        }

        public function getName($id = null)
        {
            return $this->userProfile->getName();
        }

        public function getFullName($id = null)
        {
            return $this->userProfile->getFullName();
        }
    ...
}
```

Вывод виджета
```
    <?= halumein\cashbox\widgets\UserCashboxSelector::widget() ?>
```
