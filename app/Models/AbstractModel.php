<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class AbstractModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected function getCreatedAtAttribute(?string $createdAt): ?string
    {
        return $this->formatDate($createdAt);
    }

    protected function getUpdatedAtAttribute(?string $updatedAt): ?string
    {
        return $this->formatDate($updatedAt);
    }

    protected function getDeletedAtAttribute(?string $deletedAt): ?string
    {
        return $this->formatDate($deletedAt);
    }

    private function formatDate(?string $date): ?string
    {
        if (trim($date) == '') {
            return null;
        }

        return date('d/m/Y H:i:s', strtotime($date));
    }
}
