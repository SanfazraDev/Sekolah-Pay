<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bill_session_id',
        'student_id',
        'total',
        'status',
        'payment_date',
        'proof',
        'payment_type',
        'user_id',
        'date_approve',
        'bank_id',
        'voucher_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'bill_session_id' => 'integer',
        'student_id' => 'integer',
        'payment_date' => 'datetime',
        'user_id' => 'integer',
    ];

    public function billSession(): BelongsTo
    {
        return $this->belongsTo(BillSession::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
