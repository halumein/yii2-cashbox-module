<?php
namespace halumein\cashbox\models\cashbox;

interface CashboxServiceInterface
{
    /**
     * Возвращает кассу по ID
     * @param $id integer ID кассы
     * @return CashboxInterface
     */
    public function findById($id);

    /**
     * Возвращает все кассы
     * @return CashboxInterface[]
     */
    public function findAll();

    /**
     * Сохраняет кассу
     * @param UserInterface $user
     *
     */
    public function save(CashboxInterface $cashbox);

    /**
     * Удаляет кассу
     * @param UserInterface $user
     */
    public function delete(CashboxInterface $cashbox);

}
