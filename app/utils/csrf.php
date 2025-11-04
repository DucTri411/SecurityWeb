<?php
class Csrf
{
    private const KEY = 'csrf_token';

    public static function token(): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (empty($_SESSION[self::KEY])) {
            $_SESSION[self::KEY] = bin2hex(random_bytes(32));
        }
        return $_SESSION[self::KEY];
    }

    public static function isValid(?string $provided): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $expected = $_SESSION[self::KEY] ?? '';
        return ($provided !== null && $provided !== '' && $expected !== '') && hash_equals($expected, $provided);
    }
}
?>

