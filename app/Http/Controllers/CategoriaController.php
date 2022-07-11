<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Services\CategoriaService;

class CategoriaController extends Controller
{
    /**
     * @var CategoriaService
     */
    private $service;

    public function __construct(CategoriaService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->response(
            $this->service->all()
        );
    }

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

    public function destroy($id)
    {
        return $this->response(
            $this->service->find($id)->delete()
        );
    }

    private function response($result)
    {
        return response()->json([
            'success' => true,
            'errors'  => [],
            'result'  => $result
        ]);
    }
}
