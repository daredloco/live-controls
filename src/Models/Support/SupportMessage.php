<?php

namespace Helvetiapps\LiveControls\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupportMessage extends Model{
    use HasFactory;

    protected $table = 'livecontrols_support_messages';

    protected $fillable = [
        'user_id',
        'support_ticket_id',
        'title',
        'body'
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(SupportTicket::class, 'support_ticket_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}