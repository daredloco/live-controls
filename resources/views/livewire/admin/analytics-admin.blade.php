<div>
    <!-- NAVIGATION TAB -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link @if($tab == 'dashboard') active @endif" aria-current="tab" href="#" wire:click.prevent="$set('tab', 'dashboard')">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if($tab == 'visits') active @endif" href="#" wire:click.prevent="$set('tab', 'visits')">Visits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click="$set('tab', 'paths')" tabindex="-1" aria-disabled="true">Paths</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click="$set('tab', 'users')" tabindex="-1" aria-disabled="true">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click="$set('tab', 'campaigns')" tabindex="-1" aria-disabled="true">Campaigns</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click="$set('tab', 'actions')" tabindex="-1" aria-disabled="true">Actions</a>
        </li>
    </ul>
    <!-- /NAVIGATION TAB -->

    @if($tab == 'dashboard')
    <div class="alert alert-warning text-center">
      <strong>Admin Interface for analytics is heavy work in progress!</strong>
    </div>
    @elseif($tab == 'visits')
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Identifier</th>
              <th scope="col">Target Path</th>
              <th scope="col">Preferred Language</th>
              <th scope="col">Languages</th>
              <th scope="col">User Agent</th>
              <th scope="col">Country</th>
              <th scope="col">Date & Time</th>
            </tr>
          </thead>
          <tbody>
            @foreach($userRequests as $userRequest)
            <tr class="">
              <td scope="row">{{ $userRequest->identifier }}</td>
              <td>{{ $userRequest->target_path }}</td>
              <td>{{ $userRequest->preferred_language }}</td>
              <td>{{ \Helvetiapps\LiveControls\Utils\Utils::array2String($userRequest->languages) }}</td>
              <td>{{ $userRequest->user_agent }}</td>
              <td>{{ $userRequest->country }}</td>
              <td>{{ $userRequest->created_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
    @elseif($tab == 'users')

    @elseif($tab == 'campaigns')

    @elseif($tab == 'actions')

    @endif

</div>