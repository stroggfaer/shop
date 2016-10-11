<?php
namespace app\modules\basket\models;

class Basket extends \yii\db\ActiveRecord
{

    // Сохранения корзина в сессия;
    public function addToBasket($good, $count = 1){

        if(isset($_SESSION['basket'][$good->id])){
            $_SESSION['basket'][$good->id]['count'] += $count;
        }else{
            $_SESSION['basket'][$good->id] = [
                'id'=> $good->id,
                'count' => $count,
                'name' => $good->name,
                'price' => $good->price,
            ];
        }
        // Подсчет количество;
        $_SESSION['basket.count'] = isset($_SESSION['basket.count']) ? $_SESSION['basket.count'] + $count : $count;
        // Подсчет общей количество суммы;
        $_SESSION['basket.money'] = isset($_SESSION['basket.money']) ? $_SESSION['basket.money'] + $count * $good->price : $count * $good->price;
    }

    // Очистить корзину;
    public function  clearBasket($good_id) {
        unset($_SESSION['basket'][$good_id]);
    }
}