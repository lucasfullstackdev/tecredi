<?php

namespace App\Services;

use App\Http\Requests\AbstractRequest;
use App\Http\Requests\RequestInterface;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProdutoService implements ServiceInterface
{
    private $attributes = [];

    private $produto;

    public function all(): array
    {
        $produtos = Produto::all();

        if ($produtos->isEmpty()) {
            return [];
        }

        return $produtos->toArray();
    }

    public function find(int $id): ServiceInterface
    {
        $this->produto = Produto::with('categoria')->find($id);

        if (is_null($this->produto)) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'errors'  => ['Produto não encontrado'],
                'data'    => []
            ], 400));
        }

        return $this;
    }

    public function show(): array
    {
        if (is_null($this->produto)) {
            return [];
        }

        return $this->produto->toArray();
    }

    public function store(AbstractRequest $request)
    {
        $this->getAttributes($request);

        try {
            Produto::create($this->attributes);
        } catch (\Throwable $th) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'errors'  => [
                    $th->getMessage()
                ],
                'data'    => []
            ], 400));
        }
    }

    public function update(AbstractRequest $request)
    {
        $this->getAttributes($request);
        
        return $this->produto->update($this->attributes);
    }

    public function delete()
    {
        return $this->produto->delete();
    }

    public function getAttributes(AbstractRequest $request)
    {
        $this->attributes = $request->all();
    }
}
