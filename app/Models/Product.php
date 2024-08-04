<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function manufacturer(){

        return $this->belongsTo(Manufacturer::class);

    }

    public function modelForm(){

        return $this->belongsTo(ModelForm::class);

    }

    public function category(){

        return $this->belongsTo(Category::class);

    }

    public function supplier(){

        return $this->belongsTo(Supplier::class);

    }
}
