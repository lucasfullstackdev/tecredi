<?php

namespace App\Services;

use App\Http\Requests\AbstractRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class AbstractService
{
    /**
     * Nome da Entidade buscada
     */
    protected $entityName = 'Entidade';

    /**
     * Model que está executando o CRUD
     */
    protected $model;

    /**
     * Atributos necessários para CRUD
     */
    protected $attributes = [];

    /**
     * Relationamentos
     */
    protected $with = [];

    /**
     * Entidade encontrada
     */
    private $entity;

    /**
     * Encontrando todo os Registros
     */
    public function all(): array
    {
        $entities = $this->model::paginate();

        if ($entities->isEmpty()) {
            return [];
        }

        return $entities->toArray();
    }

    /**
     * Encontrar Registro
     */
    public function find(int $id): AbstractService
    {
        $this->entity = $this->model::with($this->with)->find($id);

        if (is_null($this->entity)) {
            throw new HttpResponseException(response()->json([
                'success'  => false,
                'messages' => ["$this->entityName não encontrado(a)"],
                'result'   => []
            ], 400));
        }

        return $this;
    }

    /**
     * Informando os relacionamentos
     */
    public final function with(array $with): AbstractService
    {
        $this->with = $with;

        return $this;
    }

    /**
     * Exibindo a entidade encontrada
     */
    public final function show(): array
    {
        return $this->entity->toArray();
    }

    /**
     * Inserindo nova entidade
     */
    public function store(AbstractRequest $request)
    {
        $this->getAttributes($request);

        return $this->model::create($this->attributes);
    }

    /**
     * Atualizando a entidade encontrada
     */
    public function update(AbstractRequest $request)
    {
        $this->getAttributes($request);

        if ($this->entity->update($this->attributes)) {
            return $this->attributes;
        }

        throw new HttpResponseException(response()->json([
            'success'  => false,
            'messages' => ["Não foi possível atualizar $this->entityName"],
            'result'   => []
        ], 400));
    }

    /**
     * Removendo a entidade encontrada
     */
    public final function delete()
    {
        if ($this->entity->delete()) {
            return $this->entity->toArray();
        }

        throw new HttpResponseException(response()->json([
            'success'  => false,
            'messages' => ["Não foi possível remover $this->entityName"],
            'result'   => []
        ], 400));
    }

    /**
     * Obtendo os atributos da entidade
     */
    private function getAttributes(AbstractRequest $request)
    {
        $this->attributes = $request->all();
    }
}
