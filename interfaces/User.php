<?php
namespace halumein\cashbox\interfaces;

interface User
{
    function getId();
    function getDefaultCashbox();
    function setDefaultCashbox($cashboxId);
    function getName();
    function getFullName();
}
