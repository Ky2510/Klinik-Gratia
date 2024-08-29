<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Appointment extends Model
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
        'user_id',
        'doctor_id',
        'treatment_id',
        'appointment_date',
    ];

    /**
     * Boot method to handle UUID assignment.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {
            $appointment->id = (string) Str::uuid();
        });
    }

    /**
     * Get the user that owns the appointment.
     */
    public function user()
    {
        return $this->belongsTo(User::class,);
    }

    /**
     * Get the doctor that owns the appointment.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Get the treatment that is associated with the appointment.
     */
    public function treatment()
    {
        return $this->belongsTo(Treatment::class);
    }
}
