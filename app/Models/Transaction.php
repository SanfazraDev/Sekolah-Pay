<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

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
        'is_approve'
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
        'date_approve' => 'datetime',
        'bank_id' => 'integer',
        'voucher_id' => 'integer',
        'is_approve' => 'boolean'
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

    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class);
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);
    }
}
