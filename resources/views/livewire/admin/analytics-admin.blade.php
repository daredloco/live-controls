<div>
    <!-- NAVIGATION TAB -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#" wire:click="$set('page', 'dashboard')">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click="$set('page', 'visits')" tabindex="-1" aria-disabled="true">Visits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click="$set('page', 'users')" tabindex="-1" aria-disabled="true">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click="$set('page', 'campaigns')" tabindex="-1" aria-disabled="true">Campaigns</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click="$set('page', 'actions')" tabindex="-1" aria-disabled="true">Actions</a>
        </li>
    </ul>
    <!-- /NAVIGATION TAB -->

    <div class="alert alert-warning text-center">
      <strong>Admin Interface for analytics not included in this version!</strong>
    </div>
    @if($page == 'dashboard')
    
    @elseif($page == 'visits')
    
    @elseif($page == 'users')

    @elseif($page == 'campaigns')

    @elseif($page == 'actions')

    @endif

</div>