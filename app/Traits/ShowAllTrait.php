<?php

namespace App\Traits;

trait ShowAllTrait {
    public function getResults($collection) {
        $modelObj = [];

        foreach($collection as $value) {
            $modelObj[$value['name'][0]][] = $value;
        }
        return $modelObj;
    }
}