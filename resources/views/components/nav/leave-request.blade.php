<div class="nav-item">
  <!-- View All Employees' Leave Requests -->
  <a href="{{ route('employees-leave-request.index') }}" class="nav-link">
    <i class="fas fa-walking mr-2"></i>
    Employees' Leave Requests
  </a>

  <!-- Create New Leave Request -->
  <a href="{{ route('employees-leave-request.create') }}" class="nav-link">
    <i class="fas fa-plus-circle mr-2"></i>
    New Leave Request
  </a>

  <!-- Optional: Dynamic Link to View a Specific Leave Request -->
  @isset($leaveRequest)
    <a href="{{ route('employees-leave-request.show', $leaveRequest->id) }}" class="nav-link">
      <i class="fas fa-eye mr-2"></i>
      View Leave Request #{{ $leaveRequest->id }}
    </a>
  @endisset
</div>
