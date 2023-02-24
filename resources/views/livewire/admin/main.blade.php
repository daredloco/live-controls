<div>
    @push('styles')
    <style>
         /* The side navigation menu */
        .livecontrols-sidebar {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
            height: 100%;
            overflow: auto;
        }

        /* Sidebar links */
        .livecontrols-sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
        }

        /* Active/current link */
        .livecontrols-sidebar a.active {
            background-color: #04AA6D;
            color: white;
        }

        /* Links on mouse-over */
        .livecontrols-sidebar a:hover:not(.active) {
            background-color: #555;
            color: white !important;
        }

        /* On screens that are less than 700px wide, make the sidebar into a topbar */
        @media screen and (max-width: 700px) {
            .livecontrols-sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .livecontrols-sidebar a {float: left;}
        }

        /* On screens that are less than 400px, display the bar vertically, instead of horizontally */
        @media screen and (max-width: 400px) {
            .livecontrols-sidebar a {
                text-align: center;
                float: none;
            }
        } 
    </style>
    @endpush
    <div class="row">
        <div class="col-md-3 livecontrols-sidebar">
            {{-- <a @if($page == 'dashboard') class="active" @endif wire:click.prevent="changePage('dashboard')">{{ __('livecontrols::admin.dashboard') }}</a> --}}
            <a @if($page == 'users') class="active" @endif wire:click.prevent="changePage('users')">{{ __('livecontrols::admin.users') }}</a>
            
            @if(config('livecontrols.usergroups_enabled'))
                <a @if($page == 'groups') class="active" @endif wire:click.prevent="changePage('groups')">{{ __('livecontrols::admin.user_groups') }}</a>
            @endif

            @if(config('livecontrols.userpermissions_enabled'))
            <a @if($page == 'permissions') class="active" @endif wire:click.prevent="changePage('permissions')">{{ __('livecontrols::admin.permissions') }}</a>
            @endif

            @if(config('livecontrols.subscriptions_enabled'))
            <a @if($page == 'subscriptions') class="active" @endif wire:click.prevent="changePage('subscriptions')">{{ __('livecontrols::admin.subscriptions') }}</a>
            @endif

            @if(config('livecontrols.analytics_enabled'))
            <a @if($page == 'analytics') class="active" @endif wire:click.prevent="changePage('analytics')">{{ __('livecontrols::admin.analytics') }}</a>
            @endif


            @foreach($customPages as $label => $key)
                <a @if($page == urlencode($label)) class="active" @endif wire:click.prevent="changePage('{{ $label }}')">{{ $label }}</a>
            @endforeach
        </div>
        <div class="col-md-9 content">
            {{-- @if($page == 'dashboard')
                @livewire('livecontrols-admin-dashboard', [], key('admin-dashboard')) --}}
            @if($page == 'users')
                @livewire('livecontrols-admin-userlist', [], key('admin-userlist'))
            @elseif($page == 'groups' && config('livecontrols.usergroups_enabled'))
                @livewire('livecontrols-admin-grouplist', [], key('admin-grouplist'))
            @elseif($page == 'permissions' && config('livecontrols.userpermissions_enabled'))
                @livewire('livecontrols-admin-permissionlist', [], key('admin-permissionlist'))
            @elseif($page == 'subscriptions' && config('livecontrols.subscriptions_enabled'))
                @livewire('livecontrols-admin-subscriptionlist', [], key('admin-subscriptionlist'))
            @elseif($page == 'analytics' && config('livecontrols.analytics_enabled'))
                @livewire('livecontrols-admin-analytics', [], key('admin-analytics'))
            @endif
            @foreach($customPages as $key => $value)
                @if($page == urlencode($key))
                    @livewire($value, [], key($key.now()))
                @endif
            @endforeach
        </div>
    </div>
</div>