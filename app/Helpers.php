<?php

use App\Models\User;

function flattenArray($array)
{
    $flattenedArray = [];
    foreach ($array as $value) {
        if (is_array($value)) {
            $flattenedArray = array_merge($flattenedArray, flattenArray($value));
        } else {
            array_push($flattenedArray, $value);
        }
    }
    return $flattenedArray;
}

function idr($num)
{
    return number_format($num, 2, ',', '.');
}

function managerExist($manager)
{
    return User::where('ID_MM', '=', $manager)->count() > 0;
}

function deputyExist($deputy)
{
    return User::where('ID_DMD', '=', $deputy)->count() > 0;
}
