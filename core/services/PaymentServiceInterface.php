<?php
namespace app\core\services;

interface PaymentServiceInterface
{
    /**
     * @return bool
     */
    public function pay(): bool;
}