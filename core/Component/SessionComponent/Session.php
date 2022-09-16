<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace Core\Component\SessionComponent;


class Session
{

    private bool $sessionStarted = false;
    private string $appSecret;

    public function __construct(string $appSecret)
    {
        $this->appSecret = $appSecret;
    }

    /**
     * @return $this
     */
    public function init(): Session
    {
        if ($this->sessionStarted == false) {
            session_start();
            $this->sessionStarted = true;
        }
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value): Session
    {
        $_SESSION[$this->appSecret . $key] = $value;
        return $this;
    }

    /**
     * @param $key
     * @param false $secondKey
     * @return false|mixed
     */
    public function get($key, bool $secondKey = false)
    {
        if ($secondKey == true) {
            if (isset($_SESSION[$this->appSecret . $key][$secondKey])) {
                return $_SESSION[$this->appSecret . $key][$secondKey];
            }
        } else {
            if (isset($_SESSION[$this->appSecret . $key])) {
                return $_SESSION[$this->appSecret . $key];
            }
        }
        return false;
    }

    /**
     * @return array
     */
    public function display(): array
    {
        return $_SESSION;
    }

    /**
     * @param $key
     * @return $this
     */
    public function clear($key): Session
    {
        unset($_SESSION[$this->appSecret . $key]);
        return $this;
    }

    /**
     * @return $this
     */
    public function destroy(): Session
    {
        if ($this->sessionStarted) {
            session_unset();
            session_destroy();
        }
        return $this;
    }

}
