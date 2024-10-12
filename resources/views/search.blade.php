<form method="POST" action="{{ route('search') }}">
    @csrf
    <input type="text" name="nid" placeholder="Enter NID">
    <button type="submit">Search</button>
</form>

@if(isset($status))
    @if($status == 'Not registered')
        <p>User not registered. <a href="{{ route('register.form') }}">Register here</a></p>
    @elseif($status == 'Scheduled')
        <p>Vaccination scheduled for {{ $user->scheduled_date }}</p>
    @elseif($status == 'Vaccinated')
        <p>User is vaccinated.</p>
    @elseif($status == 'Not scheduled')
        <p>User registered but not yet scheduled for vaccination.</p>
    @endif
@endif
