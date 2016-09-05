<?php
namespace halumein\cashbox\models\cashbox;
use yii\base\Model;
use yii\base\Object;

/**
 * Сущность кассы
 */

class Cashbox extends Model
{
    /**
     * @var $id integer
     */
    private $id;

    /**
     * @var $name string
     */
    private $name;

    /**
     * @var $currency string
     */
    private $currency;

    /**
     * @var $deleted date
     */
    private $deleted;

    public static function tableName()
    {
        return '{{%cashbox}}';
    }

    public function attributeLabels()
    {
        /** TODO добавить translation
          *  'id' => yii::t('cashbox', 'ID'),
          *  'name' => yii::t('cashbox', 'Name'),
          *  'currency' => yii::t('cashbox', 'Currency'),
          *  'deleted' => yii::t('cashbox', 'Udeleted'),
          */

        return [
            'id' => 'ID',
            'name' => 'Название кассы',
            'currency' => 'Валюта кассы',
            'deleted' => 'Удалена',
        ];
    }

    /**
     * Возвращает id
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Устанавливает ID кассы
     * @param  $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * Возвращает имя кассы
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name string Устанвалвивет имя кассы
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Возвращает валюту
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param $currency string Устанавливает валюту
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * Возвращает дату удаления
     * @return date
     */
    public function getDelted()
    {
        return $this->deleted;
    }

    /**
     * @param $deleted date Устанавливает дату удаления
     */
    public function setDeleted($deleted = null)
    {
        $this->deleted = $deleted;
    }


}
