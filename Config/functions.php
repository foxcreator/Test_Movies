<?php

function redirect(string $path = '/')
{
    header('Location:' . SITE_URL . '/' . $path);
    exit;
}
