<div class="card h-100">
    <div class="card-header pb-0">
        <h6>Overview</h6>
        <p class="text-sm">
            {{-- <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
            <span class="font-weight-bold">24%</span> 
            This month --}}
        </p>
    </div>
    <div class="card-body p-3">
        <div class="timeline timeline-one-side">
            @foreach($activities as $activity)
            <div class="timeline-block mb-3">
                <span class="timeline-step">
                    <i 
                        class="{{ config('activity.icon')[$activity->subject_type] ?? config('activity.icon.default') }} 
                        text-{{ config('activity.color')[$activity->subject_type] ?? config('activity.color.default') }} 
                        text-gradient"
                    ></i>
                </span>
                <div class="timeline-content">
                    <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $activity->description }}</h6>
                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">
                        {{ app('helpers')->datetime($activity->created_at) }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>