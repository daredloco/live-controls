<?php

namespace Helvetiapps\LiveControls\Models\Banning;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ban extends Model{
    use HasFactory;

    protected $table = 'livecontrols_user_bans';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'banned_until'
    ];

    protected $casts = [
        'banned_until' => 'datetime'
    ];

    public function users():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}