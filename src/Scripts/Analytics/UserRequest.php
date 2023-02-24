<?php

namespace Helvetiapps\LiveControls\Scripts\Analytics;

use Helvetiapps\LiveControls\Models\Analytics\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Hash;

class UserRequest
{
    private readonly HttpRequest $request;
    public $user;
    public $identifier;
    public $country;
    public $preferredLanguage;
    public $languages;
    public $userAgent;
    public $timestamp;
    public $targetPath;

    public function __construct(HttpRequest $request, bool $autoSave = true)
    {
        $this->request = $request;
        $this->update();
        if($autoSave)
        {
            $this->save();
        }  
    }

    public function update()
    {
        $this->user == auth()->check() ? (config('livecontrols.analytics_user', false) ? auth()->user()->id : null) : null;
        $this->identifier = config('livecontrols.analytics_identifier', 'ip_hash') == 'ip_hash' ? Hash::make($this->request->ip()) : $this->request->ip();
        $this->preferredLanguage = $this->request->getPreferredLanguage();
        $this->languages = $this->request->getLanguages();
        $this->userAgent = $this->request->userAgent();
        $this->country = ''; //TODO: Add some country API inside here
        $this->timestamp = time();
        $this->targetPath = $this->request->path();
    }

    public function save():bool
    {
        return is_null(Request::create([
            'user_id' => $this->user,
            'identifier' => $this->identifier,
            'preferred_language' => $this->preferredLanguage,
            'languages' => $this->languages,
            'user_agent' => $this->userAgent,
            'country' => $this->country,
            'request_timestamp' => $this->timestamp,
            'target_path' => $this->targetPath
        ]));
    }
}