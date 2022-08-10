<?php

namespace App\Traits;

trait ShowAllTrait {
    public function getResults($collection) {
        // $modelObj = [];

        // foreach($collection as $value) {
        //     $modelObj[$value['name'][0]][] = $value;
        // }
        // return $modelObj;
        $modelObj = [];

        foreach($collection as $client) {
            if(!in_array($client['name'][0], $modelObj)) {
                array_push($modelObj, $client['name'][0]);
            }
        }
        return $modelObj;
    }
}