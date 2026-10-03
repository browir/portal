@if($application->notification_type === 'new')

    <span class="application-notification-badge">
        NEW
    </span>

@elseif($application->notification_type === 'updated')

    <span class="application-notification-badge update">
        UPDATE
    </span>

@endif
