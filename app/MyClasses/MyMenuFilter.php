<?php

namespace App\MyClasses;


use Illuminate\Database\Eloquent\Model;
use JeroenNoten\LaravelAdminLte\Menu\Builder;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Entrust;

use Illuminate\Contracts\Auth\Access\Gate;


class MyMenuFilter implements FilterInterface
{
    public function transform($item, Builder $builder)
    {
        if (isset($item['can']) && !Entrust::can($item['can'])) {
    
            return false;


        }

        return $item;
    }
}
