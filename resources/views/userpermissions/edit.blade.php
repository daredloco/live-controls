<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('livecontrols::general.edit_type', ['type' => $userPermission->name]) }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center my-5">
            <div class="col-sm-12 col-md-8 col-lg-5 my-4">
                <div class="card shadow-sm px-1 mx-4">
                    <x-jet-validation-errors class="mb-3" />

                    <div class="card-body">
                        <form method="POST" action="{{ route('livecontrols.admin.userpermissions.update', ['userPermission' => $userPermission->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <x-jet-label value="{{ __('livecontrols::general.name') }}" /><br>
                                <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                             :value="old('name', $userPermission->name)" required autofocus />
                                <x-jet-input-error for="name"></x-jet-input-error>
                            </div>

                            <div class="mb-3">
                                <x-jet-label value="{{ __('livecontrols::general.key') }}" /><br>
                                <x-jet-input class="{{ $errors->has('key') ? 'is-invalid' : '' }}" type="text" name="key"
                                             :value="old('key', $userPermission->key)" required />
                                <x-jet-input-error for="key"></x-jet-input-error>
                            </div>

                            <div class="mb-3">
                              <label for="description" class="form-label">{{ __('livecontrols::general.description') }}</label>
                              <textarea class="form-control" name="description" id="description" rows="3">{{ old('description', $userPermission->description) }}</textarea>
                            </div>
                            
                            <div class="mb-0">
                                <div class="d-flex justify-content-end align-items-baseline">
                                    <x-jet-button>
                                        {{ __('livecontrols::general.update') }}
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