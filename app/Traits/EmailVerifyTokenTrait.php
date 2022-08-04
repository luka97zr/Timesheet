<?php

namespace App\Traits;

trait EmailVerfiyTokenTrait {

    public function generate() {
       return bcrypt(mt_rand(8));
    }
}