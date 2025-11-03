<?php
function setErrorMessage($message)
{
    $_SESSION['flash_messages']['error'] = $message;
}

function setSuccessMessage($message)
{
    $_SESSION['flash_messages']['success'] = $message;
}

function getFlashMessage($type)
{
    $message = $_SESSION['flash_messages'][$type] ?? null;
    if ($message) {
        unset($_SESSION['flash_messages'][$type]);
    }
    return $message;
}

function getAllMessages()
{
    $messages = $_SESSION['flash_messages'] ?? [];
    unset($_SESSION['flash_messages']);
    return $messages;
}
?>