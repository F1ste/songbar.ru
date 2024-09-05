<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class SongFilter extends AbstractFilter
{
    public const SONGINPUT = 'songInput';

    protected function getCallbacks(): array
    {
        return [
            self::SONGINPUT => [$this, 'songInput'],
        ];
    }

    public function songInput(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%")->orWhere('singer', 'like', "%{$value}%");
    }
}
