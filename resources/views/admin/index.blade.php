<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    @livewire('livecontrols-admin')

</x-app-layout>