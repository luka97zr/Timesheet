<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientIndexResource;
use App\Models\Client;
use App\Traits\ShowAllTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->clients = ClientIndexResource::collection(
             Client::with('country')->orderBy('created_at', 'DESC')->paginate(3)
        );
        return $this->clients;
    }

    public function getAlphabet() {
       $letters = DB::table('clients')
                ->selectRaw("SUBSTRING(name, 1,1) AS letter")
                ->groupBy("letter")->get();

        return collect($letters)->map(function($letter) {
            return $letter->letter;
        });
    }

    public function allClients() {
        return ClientIndexResource::collection(
            Client::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        Client::create($request->only(['country_id','name']));
        return response()->json(['success'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $clients
     * @return \Illuminate\Http\Response
     */
    public function show($letter)
    {
        return ClientIndexResource::collection(
            Client::where('name','LIKE', $letter.'%')->with('country')->paginate(3)
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $clients, $client_id)
    {
        Client::findOrFail($client_id)->update($request->only(['country_id','name']));
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $clients, $client_id)
    {
        Client::destroy($client_id);
    }
}
