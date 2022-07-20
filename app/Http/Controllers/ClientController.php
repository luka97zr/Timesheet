<?php

namespace App\Http\Controllers;

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

        $clients = Client::with('country')->orderBy('name')->get();
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'country_id' => ['required', 'exists:countries,id'],
            'name'       => ['required', 'unique:clients,name']
        ]);
        $data['name'] = ucfirst($data['name']);
        Client::create($data);

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
        return Client::where('name','LIKE','%'.$term.'%')->get();
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $clients, $client_id)
    {
        $data = $request->validate([
            'country_id' => ['required', 'exists:countries,id'],
            'name'       => ['required', 'unique:clients,name']
        ]);
        $data['name'] = ucfirst($data['name']);
        Client::findOrFail($client_id)->update($data);
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
