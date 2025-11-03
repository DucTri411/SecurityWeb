<?php

function validateParamIds($params)
{
    return isset($params) && ctype_digit($params);
}

?>