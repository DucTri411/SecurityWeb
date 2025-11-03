<?php
function modelResult($status = true, $message = '')
{
    return [
        'status' => $status,
        'message' => $message
    ];
}

function modelData($status = true, $message = '', $data = null)
{
    return [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];
}
?>