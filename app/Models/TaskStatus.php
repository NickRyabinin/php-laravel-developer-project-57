<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get all of the related tasks assigned with the given task status.
     */
    public function relatedTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
