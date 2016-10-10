Yii2-cashbox-module
==========


```
composer require halumein/yii2-cashbox-module "*"
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

Дополнительные параметры:


```php
    'modules' => [
        'cashbox' => [
            'class' => 'halumein\cashbox\Module',
            'userModel' => 'common\models\YourUser', // класс пользователя используемый в приложении. если не указан то Yii::$app->user->identity
            'paymentSuccessRedirect' => '/order/order/print',  //редирект после успешной оплаты
            'printRedirect' => '/order/order/print' // редирект на action печати чека после оплаты
            'payedStatus' => 'payed', // для простановки статусов в ордере "оплачен"
            'halfpayedStatus' => 'halfpayed', // для простановки статусов в ордере "частично оплачен"
        ],
        //...
    ]
```

В используемую модель пользователя добавить реализации необходимых методов. Например, могут выглядеть так:


```
use halumein\cashbox\models\Cashbox; //модель кассы

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

        // для получения доступных касс пользователю
        public function getCashboxes()
        {
            return $this->hasMany(Cashbox::className(), ['id' => 'cashbox_id'])
                        ->viaTable('cashbox_user_to_cashbox', ['user_id' => 'id']);
        }


    ...
}
```

дальше обращаться по адресу cashbox/<имя_контроллера>
доуступные роуты:

cashbox/cashbox - индекс касс
cashbox/operation - индекс транзакций
cashbox/exchange - индекс переводов между кассами
cashbox/revision - индекс сверок

Виджет выбора дефолтной кассы:
Для использования виджета потребуется дополнить таблицу пользователя в базе данных полем "default_cashbox", куда будет записываться id кассы по умолчанию для выбранного пользователя.


Вывод виджета
```
    <?= halumein\cashbox\widgets\UserCashboxSelector::widget() ?>
```

Доступные методы компонента:
```
    Yii::$app->cashbox->addTransaction();
    Yii::$app->cashbox->getIncomeSumByPeriod();
    Yii::$app->cashbox->getIncomeSumByPeriod();
```
