<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    /*public function __construct(array $attributes = [])
    {
        // Сначала вызываем родительский конструктор
        parent::__construct($attributes);

        // Далее выполняем нужную логику
        $this->initialize();
    }

    // Метод для выполнения начальной логики
    protected function initialize()
    {
        // Например, установка значения по умолчанию
        $this->default_value = 'some_default_value';
    }*/
}
