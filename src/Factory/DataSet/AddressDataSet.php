<?php


namespace App\Factory\DataSet;
use function Zenstruck\Foundry\faker;



final class AddressDataSet implements DataSetInterface
{
    public static function minimum(): array
    {
                  return [ 'name' => self::faker()->name];
    }

    public static function all(): array
    {
        return array_merge(
            self::minimum(),
            [ 'useAddress' => self::faker()->useAddress]);
    }

}