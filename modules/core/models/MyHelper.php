<?php
namespace app\modules\core\models;

use Yii;
use yii\base\Model;
class MyHelper extends Model
{
    // Обработка цены;
    public static function money($value, $decimal = 0)
    {
        return number_format($value, $decimal, '.', ' ').' ';
    }
    // Обработка Фио;
    public static function userName($string)
    {
        // Обработка данные;
        $string = trim($string);
        $string = rtrim($string, "!,.-");
        $string = preg_replace('#(.*)\s+(.).*\s+(.).*#usi', '$1 $2.$3.', $string);
        return $string;
    }
    // Обработка дата;
    public static function date($date)
    {
        if (date("Y-m-d", strtotime($date)) == $date) {
            $timestamp = strtotime($date);
        } else {
            $timestamp = $date;
        }
        return date("d.m.Y", $timestamp);
    }
    // Обработка дата время;
    public static function datetime($date)
    {
        if (date("Y-m-d H:i:s", strtotime($date)) == $date) {
            $timestamp = strtotime($date);
        } else {
            $timestamp = $date;
        }
        return date("d.m.Y в H:i", $timestamp);
    }

    // Генерация уникальные чисел или хеш;
    public  static function randomFileName($has = false, $params = 10)
    {
        if(!empty($has)){
            $random = substr(md5(microtime() . rand(0, 99999)), 0, $params);
        }else{
            $random = ceil(microtime()).rand(0, 999999);
        }
        return $random;
    }
}