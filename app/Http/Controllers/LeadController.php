<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function __invoke() {
        return Lead::with('user')->get();
    }
}
