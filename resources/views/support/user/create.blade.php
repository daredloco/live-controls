<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('New Support Ticket') }}
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
                                <x-jet-label value="{{ __('Title') }}" /><br>
                                <x-jet-input class="{{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                                             :value="old('title')" required autofocus />
                                <x-jet-input-error for="title"></x-jet-input-error>
                            </div>

                            <div class="mb-3">
                              <label for="body" class="form-label">Describe your Problem</label>
                              <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label for="priority" class="form-label">Priority</label>
                                <select class="form-select" name="priority" id="priority">
                                    <option selected>Select one</option>
                                    <option value="">Low</option>
                                    <option value="">Medium</option>
                                    <option value="">High</option>
                                    <option value="">Critical</option>
                                </select>
                            </div>

                            <div class="mb-0">
                                <div class="d-flex justify-content-end align-items-baseline">
                                    <x-jet-button>
                                        {{ __('Create') }}
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