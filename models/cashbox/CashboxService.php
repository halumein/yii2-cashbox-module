<?php
namespace halumein\cashbox\models\cashbox;

use yii\db\Command;
use yii\db\Query;
use halumein\cashbox\models\cashbox\CashboxServiceInterface;
use halumein\cashbox\models\cashbox\Cashbox;



class CashboxService implements CashboxServiceInterface
{

    /**
     * Возвращает кассу по ID
     * @param $id integer ID касыы
     * @return CashboxInterface
     */
    public function findById($id)
    {
        return $this->findOneByAttribute('id', $id);
    }

    /**
     * Возвращает все кассы
     * @return CashboxInterface[]
     */
    public function findAll()
    {
        $query = new Query();
        $rows = $query->all();
        $cashboxes = [];
        foreach ($rows as $row) {
            $cashboxes = $this->load($row);
        }
        return $cashboxes;
    }

    /**
     * Сохраняет кассу
     * @param CashboxInterface $cashbox
     *
     */
    public function save(CashboxInterface $cashbox)
    {
        $command = new Command();
        $columns = [
            'name' => $cashbox->getName(),
            'deleted' => $cashbox->getDeleted(),
        ];

        if ($cashbox->getId() == null) {
            $command->insert(Cashbox::tableName(), $columns);
            $cashbox->setId(\Yii::$app->db->getLastInsertID());
        } else {
            $command->update(Cashbox::tableName(), $columns, ['id' => $cashbox->getId()]);
        }
    }

    /**
     * Удаляет кассу
     * @param UserInterface $user
     */
    public function delete(CashboxInterface $cashbox)
    {
        $command = new Command();
        $command->update(Cashbox::tableName(), ['deleted' => date('Y:m:d H:i:s', time())], ['id' => $cashbox->getId()]);

    }

    private function load($result)
    {
        $cashbox = new Cashbox();
        $cashbox->setId($result['id']);
        $cashbox->setName($result['name']);
        $cashbox->setCurrency($result['currency']);
        $cashbox->setDelted($result['deleted']);
        return $cashbox;
    }

    private function findOneByAttribute($attribute, $value)
    {
        $query = new Query();
        $row = $query->andWhere([$attribute => $value])->one();
        if ($row) {
            return $this->load($row);
        } else {
            return null;
        }
    }

    private function findAllByAttribute($attribute, $value)
    {
        $query = new Query();
        $rows = $query->andWhere([$attribute => $value])->all();
        if ($rows) {
            $data = [];
            foreach ($rows as $key => $row) {
                $data[] = $this->load($row)
            }
            return $data;
        } else {
            return null;
        }
    }
}
