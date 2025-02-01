<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $logo
 * @property string|null $website
 * @property Collection<Employee>|Employee[] $employees
 */
class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }
}
