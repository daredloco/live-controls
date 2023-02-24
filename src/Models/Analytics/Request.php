<?php

namespace Helvetiapps\LiveControls\Models\Analytics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model{
    use HasFactory;

    protected $table = 'livecontrols_analytics_requests';

    protected $fillable = [
        'user_id',
        'identifier',
        'target_path',
        'preferred_language',
        'languages',
        'user_agent',
        'request_timestamp',
        'country'
    ];

    protected $casts = [
        'languages' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getSiblingsAttribute()
    {
        return Request::where('identifier', '=', $this->identifier)->get();
    }
}