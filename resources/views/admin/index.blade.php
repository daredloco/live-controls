<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('livecontrols::general.admin_dashboard') }}
        </h2>
    </x-slot>

    @livewire('livecontrols-admin')

</x-app-layout>