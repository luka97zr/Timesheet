<?php

namespace App\Repository;

use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientIndexResource;
use App\Models\Client;
use App\Repository\Interaface\CrudControllerInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ClientRepository {
    public $clients;

    public function index(){
        $this->clients = ClientIndexResource::collection(
            Client::with('country')->orderBy('created_at', 'DESC')->paginate(3)
       );
       return $this->clients;
    }

    public function alphabet(){
        return Cache::remember('client-alphabet', 60*10, function() {
            $letters = DB::table('clients')
                ->selectRaw("SUBSTRING(name, 1,1) AS letter")
                ->groupBy("letter")->get();

            return collect($letters)->map(function($letter) {
                return $letter->letter;
            });
        });
    }

    public function all(){
        return Cache::remember('clients', 60*10, function() {
            return ClientIndexResource::collection(
                Client::all()
            )->toJson();
        });
    }

    public function store($request){
        Client::create($request->only(['country_id','name']));
        return response()->json(['success'=>true]);
    }

    public function show($letter){
        return ClientIndexResource::collection(
            Client::where('name','LIKE', $letter.'%')->with('country')->paginate(3)
        );
    }

    public function update($request, $clientId){
        Client::findOrFail($clientId)->update($request->only(['country_id','name']));
    }
    
    public function destroy($clientId){
        Client::destroy($clientId);
    }
}