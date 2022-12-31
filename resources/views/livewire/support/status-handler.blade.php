<div>
    <div class="mb-3">
        <label for="" class="form-label">{{ __('livecontrols::support.status') }}</label>
        <select class="form-select" name="" id="" wire:model='newStatus'>
            <option value="0">{{ __('livecontrols::support.status_0') }}</option>
            <option value="1">{{ __('livecontrols::support.status_1') }}</option>
            <option value="2">{{ __('livecontrols::support.status_2') }}</option>
        </select>
    </div>
    <button class="btn btn-primary text-white" wire:click='updateStatus'>{{ __('livecontrols::support.update_status') }}</button>
</div>