<?php

namespace Helvetiapps\LiveControls\Scripts\Analytics;

use Exception;
use Helvetiapps\LiveControls\Models\Analytics\Action;
use Helvetiapps\LiveControls\Models\Analytics\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class AnalyticsHandler
{
    public static function getPaths(Carbon $from, Carbon $to): Collection
    {
        $paths = [];
        foreach(Request::whereBetween('created_at', [$from, $to])->get(['target_path']) as $request)
        {
            if(!array_key_exists($request->target_path, $paths)){
                $paths[$request->target_path] = 0;
            }

            $paths[$request->target_path]++;
        }
        return collect($paths);
    }

    public static function getActions(Carbon $from, Carbon $to, string $action = null)
    {
        $actions = [];
        foreach(Action::where(function($query) use($action){
            if(!is_null($action))
            {
                $query->where('key', '=', $action);
            }
        })->whereBetween('created_at', [$from, $to])->get() as $action)
        {
            if(!array_key_exists($action->id, $actions)){
                $actions[$action->id] = [
                    'name' => $action->name,
                    'key' => $action->key,
                    'amount' => 0
                ];
            }

            $actions[$action->id]['amount']++;
        }
        return collect($actions);
    }

    public static function getCampaigns(Carbon $from, Carbon $to, string $campaign = null)
    {
        $campaigns = [];
        foreach(Action::where(function($query) use($campaign){
            if(!is_null($campaign))
            {
                $query->where('key', '=', $campaign);
            }
        })->whereBetween('created_at', [$from, $to])->get() as $campaign)
        {
            if(!array_key_exists($campaign->id, $campaigns)){
                $campaigns[$campaign->id] = [
                    'name' => $campaign->name,
                    'key' => $campaign->key,
                    'amount' => 0
                ];
            }

            $campaigns[$campaign->id]['amount']++;
        }
        return collect($campaigns);
    }

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