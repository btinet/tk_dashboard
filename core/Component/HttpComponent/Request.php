<?php
/*
 * Copyright (c) 2022. Benjamin Wagner
 */

namespace Core\Component\HttpComponent;


class Request
{

    /**
     * @var string
     */
    public string $csrf_token;

    public string $query;

    /**
     * @param $csrf_token
     */
    public function __construct($csrf_token)
    {
        $this->csrf_token = $csrf_token;
    }

    /**
     * @return bool
     */
    public function isPostRequest(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] === 'POST');
    }

    /**
     * @return bool
     */
    public function isFormSubmitted(): bool
    {
        $token = filter_input(INPUT_POST, 'csrf_token', FILTER_SANITIZE_SPECIAL_CHARS);
        return $token === $this->csrf_token;
    }

    /**
     * @param string $FormFieldName
     * @return string|false
     */
    public function getFieldAsString(string $FormFieldName): ?string
    {
        $query = filter_input(INPUT_POST, $FormFieldName, FILTER_SANITIZE_STRIPPED);
        return $this->query = $query ?? false;
    }

    /**
     * @param string $FormFieldName
     * @return false|array
     */
    public function getFieldAsArray(string $FormFieldName)
    {
        return $query = (isset($_POST[$FormFieldName]))?$_POST[$FormFieldName]:false;
    }

    public function getFieldAsFile(string $FormFieldName)
    {
        return $query = (isset($_FILES[$FormFieldName]))?$_FILES[$FormFieldName]:false;
    }

    /**
     * @param string $key
     * @return string|false
     */
    public function getQueryAsString(string $key): ?string
    {
        $query = filter_input(INPUT_GET, $key, FILTER_SANITIZE_STRIPPED);
        return $this->query = $query ?? false;
    }

    /**
     * @param string $key
     * @return false|mixed
     */
    public function getQueryAsArray(string $key)
    {
        return $query = (isset($_GET[$key]))?$_GET[$key]:false;
    }
}
