<?php

namespace Modules\Notification\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Notification\Entities\Client;
use Modules\Notification\Http\Requests\CreateClientRequest;
use Modules\Notification\Http\Requests\UpdateClientRequest;
use Modules\Notification\Repositories\ClientRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ClientController extends AdminBaseController
{
    /**
     * @var ClientRepository
     */
    private $client;

    public function __construct(ClientRepository $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$clients = $this->client->all();

        return view('notification::admin.clients.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('notification::admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateClientRequest $request
     * @return Response
     */
    public function store(CreateClientRequest $request)
    {
        $this->client->create($request->all());

        return redirect()->route('admin.notification.client.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('notification::clients.title.clients')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Client $client
     * @return Response
     */
    public function edit(Client $client)
    {
        return view('notification::admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Client $client
     * @param  UpdateClientRequest $request
     * @return Response
     */
    public function update(Client $client, UpdateClientRequest $request)
    {
        $this->client->update($client, $request->all());

        return redirect()->route('admin.notification.client.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('notification::clients.title.clients')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Client $client
     * @return Response
     */
    public function destroy(Client $client)
    {
        $this->client->destroy($client);

        return redirect()->route('admin.notification.client.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('notification::clients.title.clients')]));
    }
}
