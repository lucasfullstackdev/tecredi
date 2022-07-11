<?php

namespace App\Http\Controllers;

abstract class AbstractController extends Controller
{

    protected $serviceClass;
    protected $service;

    public function __construct()
    {
        $this->service = new $this->serviceClass;
    }

    public function index()
    {
        return $this->response(
            $this->service->with(['categoria'])->paginate()
        );
    }

    public function destroy($id)
    {
        return $this->response(
            $this->service->find($id)->delete()
        );
    }

    protected final function response($result)
    {
        return response()->json([
            'success' => true,
            'errors'  => [],
            'result'  => $result
        ]);
    }
}