<div class="card">
    <div class="card-header">
        Disciplinary Action Details
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $disciplinaryAction->employee->name }}</h5>
        <p class="card-text">Action Type: {{ $disciplinaryAction->action_type }}</p>
        <p class="card-text">Description: {{ $disciplinaryAction->description }}</p>
        <p class="card-text">Action Date: {{ $disciplinaryAction->action_date->format('m/d/Y') }}</p>
        <a href="{{ route('disciplinary-actions.index') }}" class="btn btn-primary">Back</a>
    </div>
</div>
