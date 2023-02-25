<?php

namespace Helvetiapps\LiveControls\Scripts\Analytics;

use Exception;
use Helvetiapps\LiveControls\Models\Analytics\Action;
use Helvetiapps\LiveControls\Models\Analytics\Request;

class AnalyticsHandler
{
    public static function doAction(Request $request, string $key, bool $createAction = false)
    {
        if(config('livecontrols.analytics_actions_enabled', false) === false)
        {
            throw new Exception('Analytics action is called, but "analytics_actions_enabled" config value is set to false!');
        }

        $action = Action::where('key', '=', $key)->first();
        if($createAction === true)
        {
            $action = Action::create([
                'name' => ucfirst($key),
                'key' => $key,
                'description' => ''
            ]);
        }

        if(is_null($action)){
            throw new Exception('Invalid Action with key "'.$key.'"');
        }
        $request->actions()->attach($action->id);
    }
}