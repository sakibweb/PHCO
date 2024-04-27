<?php
/**
 * Class PHCO
 * Author: Sakibur Rahman @sakibweb
 * A utility class for managing HTTP cookies in PHP applications.
 * Provides methods for adding, updating, removing, and accessing cookies.
 */
class PHCO {
	
    /**
     * Adds a new cookie or updates an existing one with the specified name and value.
     *
     * @param string $name The name of the cookie.
     * @param mixed $value The value to set for the cookie.
     * @param int|null $expireMinutes The expiration time for the cookie in minutes. Null for session cookie.
     * @return bool True on success, false on failure.
     */
    public static function add($name, $value, $expireMinutes = null) {
        if ($expireMinutes !== null && is_numeric($expireMinutes)) {
            $expireTime = time() + ($expireMinutes * 60);
        } elseif ($expireMinutes === 0) {
            $expireTime = time() - 3600;
        } else {
            $expireTime = 0;
        }
        return setcookie($name, $value, $expireTime, '/');
    }

    /**
     * Updates the value and expiration time of an existing cookie or creates a new one if not exists.
     *
     * @param string $name The name of the cookie.
     * @param mixed $value The new value to set for the cookie.
     * @param int|null $expireMinutes The new expiration time for the cookie in minutes. Null for session cookie.
     * @return bool True on success, false on failure.
     */
    public static function update($name, $value, $expireMinutes = null) {
        if (self::exists($name)) {
            self::remove($name);
        }
        return self::add($name, $value, $expireMinutes);
    }

    /**
     * Removes a cookie with the specified name.
     *
     * @param string $name The name of the cookie to remove.
     * @return bool True on success, false on failure.
     */
    public static function remove($name) {
        if (self::exists($name)) {
            unset($_COOKIE[$name]);
            return setcookie($name, '', time() - 3600, '/');
        }
        return false;
    }

    /**
     * Retrieves the value of a cookie with the specified name.
     *
     * @param string $name The name of the cookie.
     * @return mixed|null The value of the cookie if exists, null otherwise.
     */
    public static function get($name) {
        return $_COOKIE[$name] ?? null;
    }

    /**
     * Checks if a cookie with the specified name exists.
     *
     * @param string $name The name of the cookie.
     * @return bool True if the cookie exists, false otherwise.
     */
    public static function exists($name) {
        return isset($_COOKIE[$name]);
    }

    /**
     * Checks if a cookie with the specified name has expired.
     *
     * @param string $name The name of the cookie.
     * @return bool True if the cookie has expired, false otherwise or if not exists.
     */
    public static function expired($name) {
        if (self::exists($name)) {
            $cookieValue = $_COOKIE[$name];
            $expireTime = (int)$cookieValue;
            return $expireTime < time();
        }
        return true;
    }

    /**
     * Checks if a cookie with the specified name is active (not expired).
     *
     * @param string $name The name of the cookie.
     * @return bool True if the cookie is active (not expired), false otherwise or if not exists.
     */
    public static function active($name) {
        return !self::expired($name);
    }

    /**
     * Retrieves the remaining time until expiration of a cookie with the specified name.
     *
     * @param string $name The name of the cookie.
     * @return int|null The remaining time until expiration in seconds, or null if not exists.
     */
    public static function getExpiredDetails($name) {
        if (self::exists($name)) {
            $expireTime = $_COOKIE[$name];
            return $expireTime - time();
        }
        return null;
    }

    /**
     * Sets a cookie with the specified name to expired.
     *
     * @param string $name The name of the cookie to expire.
     * @return bool True on success, false on failure or if not exists.
     */
    public static function makeExpired($name) {
        if (self::exists($name)) {
            $_COOKIE[$name] = time() - 3600;
            return setcookie($name, '', time() - 3600, '/');
        }
        return false;
    }

    /**
     * Retrieves all available cookies.
     *
     * @return array An associative array of cookies.
     */
    public static function getAll() {
        return $_COOKIE;
    }
}
?>
