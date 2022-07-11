<?php

namespace App\Services;

use App\Http\Requests\AbstractRequest;

interface ServiceInterface
{
    public function all(): array;

    public function find(int $id): AbstractService;

    public function show(): array;

    public function store(AbstractRequest $request);

    public function update(AbstractRequest $request);

    public function delete();
}
