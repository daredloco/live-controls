<?php

namespace Helvetiapps\LiveControls\Models\Analytics;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Action extends Model{
    use HasFactory;

    protected $table = 'livecontrols_analytics_actions';

    protected $fillable = [
        'name',
        'key',
        'description',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function requests(): BelongsToMany
    {
        return $this->belongsToMany(Request::class, 'livecontrols_analytics_action_requests', 'request_id', 'action_id');
    }
}