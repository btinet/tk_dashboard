<?php

namespace Core\Component\UserComponent;


use App\Entity\User;

class UserService
{
    private static string $entity;
    // Benutzer Login
    public static function tryLogin($repository,string $entity, array $data): int
    {
        self::$entity = $entity;

        if(0 != $usernameLastError = self::isString('username',$data,21031)) return $usernameLastError; // Kein String
        if(0 != $usernameLastError =  !array_filter((array)$repository->findOneBy($entity,['username' => $data['username']])) ) return 210111;  // Benutzername existiert nicht
        if(0 != $userLastError = self::isMatch($repository,$data)) return $userLastError; // Benutzername und Passwort stimmen nicht überein

        return 0;   // Alles in Ordnung
    }

    // Benutzer Register
    public static function validate($entity, $repository, array $data): int
    {
        self::$entity = $entity;
        if(0 != $usernameLastError = self::isString('username',$data,21031)) return $usernameLastError;
        if(0 != $usernameLastError = self::isUnique($repository,'username',$data,21011)) return $usernameLastError;
        if(0 != $emailLastError = self::isUnique($repository,'email',$data,21012)) return $emailLastError;
        if(0 != $passwordLastError = PasswordService::validate($data['password'])) return $passwordLastError;
        if(0 != $emailLastError = self::isEmail('email',$data,21022)) return $emailLastError;
        if(0 != $firstnameLastError = self::isString('firstName',$data,21034)) return $firstnameLastError;
        if(0 != $lastnameLastError = self::isString('lastName',$data,21035)) return $lastnameLastError;

        return 0;
    }

    public static function isUnique($repository, $needle, $array, $errorCode = 2101): int
    {
        return ($repository->findOneBy(self::$entity,[$needle => $array[$needle]])) ? $errorCode : 0;
    }

    public static function isMatch($repository,$array, $errorCode = 210112): int
    {

        $user = ($repository->findOneBy(self::$entity,[
            'username' => $array['username'],
        ]));
        if( method_exists($user,'getPassword') ){
            $password = is_array($array['password']) ? array_pop($array['password']): $array['password'];
            return !PasswordService::verify($password,$user->getPassword()) ? $errorCode : 0;
        }
        return $errorCode;
    }

    public static function isEmail($needle, $array, $errorCode = 2102): int
    {
        return (!filter_var($array[$needle], FILTER_VALIDATE_EMAIL)) ? $errorCode : 0;
    }

    public static function isString($needle, $array, $errorCode = 2103): int
    {
        return (!is_string($array[$needle])) ? $errorCode : 0;
    }

}