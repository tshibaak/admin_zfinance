<?php
namespace Core;

class Session
{
    public static function ensureRole(string $role, string $sessionRole): bool
    {
        return $role === $sessionRole;
    }

    public static function sessionExist()
    {
        return isset($_SESSION['user']) ? $_SESSION['auth'] : false;
    }

    public static function role()
    {
        return htmlentities($_SESSION['user']['role'] ?? null, ENT_QUOTES, 'UTF-8');
    }

    public static function userId()
    {
        return htmlentities($_SESSION['user']['id'] ?? null, ENT_QUOTES, 'UTF-8');
    }

    public static function userName()
    {
        return htmlentities($_SESSION['user']['name'] ?? 'Unknow', ENT_QUOTES, 'UTF-8');
    }

    /** Enregistre un message flash (success|error|warning|info). */
    public static function flash(string $type, string $message): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message,
        ];
    }

    /** Récupère et consomme le message flash courant. */
    public static function pullFlash(): ?array
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['flash'])) {
            return null;
        }
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
}
