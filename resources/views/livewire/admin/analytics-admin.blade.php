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
          <a class="nav-link" href="#" wire:click.prevent="$set('tab', 'paths')">Paths</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click.prevent="$set('tab', 'users')" tabindex="-1" aria-disabled="true">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click.prevent="$set('tab', 'campaigns')" tabindex="-1" aria-disabled="true">Campaigns</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" wire:click.prevent="$set('tab', 'actions')" tabindex="-1" aria-disabled="true">Actions</a>
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
              <th scope="col">Date & Time</th>
              <th scope="col">Identifier</th>
              <th scope="col">Target Path</th>
              <th scope="col">Preferred Language</th>
              <th scope="col">Languages</th>
              <th scope="col">User Agent</th>
              <th scope="col">Country</th>
            </tr>
          </thead>
          <tbody>
            @foreach($userRequests as $userRequest)
            <tr class="">
              <th scope="row">{{ $userRequest->created_at }}</th>
              <td>{{ $userRequest->identifier }}</td>
              <td>{{ $userRequest->target_path }}</td>
              <td>{{ $userRequest->preferred_language }}</td>
              <td>{{ \Helvetiapps\LiveControls\Utils\Utils::array2String($userRequest->languages) }}</td>
              <td>{{ $userRequest->user_agent }}</td>
              <td>{{ $userRequest->country }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
    @elseif($tab == 'paths')

      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">Target Path</th>
              <th scope="col">Visits</th>
            </tr>
          </thead>
          <tbody>
            @foreach($paths as $path => $visits)
            <tr class="">
              <th scope="row">{{ $path }}</th>
              <td>{{ $visits }}</td>
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