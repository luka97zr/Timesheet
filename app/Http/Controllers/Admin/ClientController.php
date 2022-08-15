<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Models\Client;
use App\Repository\ClientRepository;

class ClientController extends Controller
{
    protected $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->repository->index();
    }

    public function getAlphabet()
    {
        return $this->repository->alphabet();
    }

    public function allClients()
    {
        return $this->repository->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $clients
     * @return \Illuminate\Http\Response
     */
    public function show($letter)
    {
        return $this->repository->show($letter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(ClientUpdateRequest $request, Client $client)
    {
        return $this->repository->show($request, $client->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client) {
        return $this->repository->destroy($client->id);
    }
}
