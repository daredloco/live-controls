<?php

namespace Helvetiapps\LiveControls\Scripts;

use Helvetiapps\LiveControls\Models\Banning\Ban;

class BanHandler
{
    public static function bannedEmail(string $email): bool
    {
        return Ban::where('email', '=', $email)->exists();
    }

    public static function bannedName(string $name): bool
    {
        return Ban::where('name', '=', $name)->exists();
    }
}