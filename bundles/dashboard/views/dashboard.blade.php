@layout('layouts.master')

@section('content')
Dashboard!!

<div class="btn-group">
	{{ HTML::link('/dashboard', 'Dashboard', array('class'=>'btn btn-small')) }}
	{{ HTML::link('/account', 'Account', array('class'=>'btn btn-small')) }}
	{{ HTML::link('/logout', 'Logout', array('class'=>'btn btn-small btn-inverse')) }}
</div>
@endsection