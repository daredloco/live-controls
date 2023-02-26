<div>
    <!-- NAVIGATION TAB -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link @if($page == 'dashboard') active @endif" aria-current="page" href="#" wire:click="$set('page', 'dashboard')">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link @if($page == 'visits') active @endif" href="#" wire:click="$set('page', 'visits')">Visits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click="$set('page', 'paths')" tabindex="-1" aria-disabled="true">Paths</a>
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

    @if($page == 'dashboard')
    <div class="alert alert-warning text-center">
      <strong>Admin Interface for analytics is heavy work in progress!</strong>
    </div>
    @elseif($page == 'visits')
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
              <td>@json($userRequest->languages)</td>
              <td>{{ $userRequest->user_agent }}</td>
              <td>{{ $userRequest->country }}</td>
              <td>{{ $userRequest->created_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
    @elseif($page == 'users')

    @elseif($page == 'campaigns')

    @elseif($page == 'actions')

    @endif

</div>