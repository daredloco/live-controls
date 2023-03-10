<?php

namespace Helvetiapps\LiveControls\Models\Support;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SupportTicket extends Model{
    use HasFactory;

    protected $table = 'livecontrols_support_tickets';
    
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'priority',
        'status'
    ];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }

    public function messages(): HasMany{
        return $this->hasMany(SupportMessage::class, 'support_ticket_id');
    }

    public function getStatusStringAttribute(): string{
        return __('livecontrols::support.status_'.$this->status);
    }

    public function getClosedAttribute(): bool{
        return $this->status >= 2;
    }
}