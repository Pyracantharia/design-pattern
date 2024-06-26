<?php

namespace PaymentLibrary;

class TransactionStatusManager
{
    const STATUS_PENDING = 'pending';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELED = 'canceled';

    public function getStatusMessage(string $status): string
    {
        return match ($status) {
            self::STATUS_PENDING => 'Transaction is pending.',
            self::STATUS_SUCCESS => 'Transaction is successful.',
            self::STATUS_FAILED => 'Transaction failed.',
            self::STATUS_CANCELED => 'Transaction is canceled.',
            default => 'Unknown status.',
        };
    }
}
?>
