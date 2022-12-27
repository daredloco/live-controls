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
        color: white;
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
            <a class="active" href="#dashboard" wire:click.prevent="changePage('dashboard')">Dashboard</a>
            <a href="#users" wire:click.prevent="changePage('users')">Users</a>
            <a href="#groups" wire:click.prevent="changePage('groups')">User Groups</a>
            <a href="#permissions" wire:click.prevent="changePage('permissions')">Permissions</a>
            @foreach($customPages as $label => $key)
                <a href="#{{ $key }}" wire:click.prevent="changePage('{{ $key }}')">{{ $label }}</a>
            @endforeach
        </div>
        <div class="col-md-9 content">
            @if($page == 'dashboard')
                @livewire('livecontrols-admin-dashboard', [], key('admin-dashboard'))
            @elseif($page == 'users')
                Users
            @elseif($page == 'groups')
                Groups
            @elseif($page == 'permissions')
                Permissions
            @endif
            @foreach($customPages as $key)
                @if($page == $key)
                    @livewire($key)
                @endif
            @endforeach
        </div>
    </div>
</div>