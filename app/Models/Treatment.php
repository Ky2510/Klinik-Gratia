<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Treatment extends Model
{
    use HasFactory;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The type of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    /**
     * Boot method to handle UUID assignment.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($treatment) {
            $treatment->id = (string) Str::uuid();
        });
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
