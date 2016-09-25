<?php
namespace halumein\cashbox\interfaces;

interface User
{
    function getId();
    function getDefaultCashbox();
    function setDefaultCashbox($cashboxId);
    function getName($id = null);
    function getFullName($id = null);
}
