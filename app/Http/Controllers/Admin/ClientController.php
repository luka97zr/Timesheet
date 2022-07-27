<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientIndexResource;
use App\Models\Client;
use Illuminate\Http\Request;
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

        $clients = ClientIndexResource::collection(
            Client::with('country')->orderBy('name')->get()
        );
        $clientsObj = [];

        foreach($clients as $client) {
            $clientsObj[$client['name'][0]][] = $client;
        }
        return $clientsObj;

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
    public function show($term)
    {
        return ClientIndexResource::collection(
            Client::where('name','LIKE','%'.$term.'%')->with('country')->get()
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $clients, $client_id)
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
