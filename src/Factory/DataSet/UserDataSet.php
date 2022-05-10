<?php


namespace App\Factory\DataSet;


class UserDataSet implements  DataSetInterface
{
    use DataSetTrait;

    public static function minimum(): array
    {
        return [   'email' => self::faker()->email,
                      'password' => self::faker()->password];
    }

    public static function all(): array
    {
        return [   'email' => self::faker()->email,
            'password' => self::faker()->password];
    }

}