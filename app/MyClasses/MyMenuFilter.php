<?php

namespace App\MyClasses;


use Illuminate\Database\Eloquent\Model;
use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Entrust;

class MyMenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['permission']) || ! Entrust::can($item['permission'])) {
            return false;
        }

        return $item;
    }
}
