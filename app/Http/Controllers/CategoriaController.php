<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Services\CategoriaService;

class CategoriaController extends AbstractController
{
    protected $serviceClass = CategoriaService::class;

    public function store(StoreCategoriaRequest $request)
    {
        return $this->response(
            $this->service->store($request)
        );
    }

    public function show($id)
    {
        return $this->response(
            $this->service->with(['produtos'])->find($id)->show()
        );
    }

    public function update(StoreCategoriaRequest $request, int $id)
    {
        return $this->response(
            $this->service->find($id)->update($request)
        );
    }
}
