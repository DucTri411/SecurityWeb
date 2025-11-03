<?php
function formatCurrencyVND($amount)
{
    if (ctype_digit($amount)) {
        return number_format($amount, 0, ".", ",") . ' ₫';
    }
    return number_format($amount, 2, ".", ",") . ' ₫';
}

?>