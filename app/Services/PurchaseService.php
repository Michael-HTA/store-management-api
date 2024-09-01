<?php
namespace App\Services;

use App\Interfaces\PurchaseInterface;
use App\Models\Purchase;

class PurchaseService implements PurchaseInterface{

    
    public function processPurchase($data)
    {
        $model = new Purchase();

        foreach($data as $key => $value){
            $model->$key = $value;
        }

        $model->save();

        return $model;
    }
}