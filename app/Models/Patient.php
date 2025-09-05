<?php

namespace App\Models;

use App\Actions\Traits\HasFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    /** @use HasFactory<\Database\Factories\PatientFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'address',
        'email',
        'hospital_id',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    #[Scope]
    protected function filterByHospital(Builder $query): void
    {
        if (request()->query('hospital')) {
            $query->where('hospital_id', request()->query('hospital'));
        }
    }
}
