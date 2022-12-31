<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('livecontrols::support.new_ticket') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-sm-12 col-md-8 col-lg-5 my-4">
                <div class="card shadow-sm px-1 mx-4">
                    <x-jet-validation-errors class="mb-3" />

                    <div class="card-body">
                        <form method="POST" action="{{ route('livecontrols.support.store') }}">
                            @csrf

                            <div class="mb-3">
                                <x-jet-label value="{{ __('livecontrols::general.title') }}" /><br>
                                <x-jet-input class="{{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                                             :value="old('title')" required autofocus />
                                <x-jet-input-error for="title"></x-jet-input-error>
                            </div>

                            <div class="mb-3">
                              <label for="body" class="form-label">{{ __('livecontrols::support.describe_problem') }}</label>
                              <textarea class="form-control" name="body" id="body" rows="3">{{ old('body') }}</textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="priority" class="form-label">{{ __('livecontrols::support.priority') }}</label>
                                <select class="form-select" name="priority" id="priority">
                                    <option selected>{{ __('Select one') }}</option>
                                    <option value="1" @if(old('priority') == 1) selected @endif>{{ __('livecontrols::support.low') }}</option>
                                    <option value="2" @if(old('priority') == 2) selected @endif>{{ __('livecontrols::support.medium') }}</option>
                                    <option value="3" @if(old('priority') == 3) selected @endif>{{ __('livecontrols::support.high') }}</option>
                                    <option value="4" @if(old('priority') == 4) selected @endif>{{ __('livecontrols::support.critical') }}</option>
                                </select>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-end align-items-baseline">
                                    <x-jet-button>
                                        {{ __('livecontrols::general.create') }}
                                    </x-jet-button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>