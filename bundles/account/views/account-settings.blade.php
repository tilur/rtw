@layout('layouts.master')

@section('navigation')
<div class="btn-group">
	{{ $view_data['navigation']->display() }}
</div>
@endsection

@section('page-topper')
<div class="page-header">
	<h1>Account <small>Settings</small></h1>
	Vital info bits
</div>
@endsection

@section('content')
@if (isset($success))
	<div class="alert alert-success">
	@if ($success == 'update')
		<strong>Update Successful!</strong>
	@endif
	 Your account settings have been saved.
	</div>
@endif

<div class="btn-group sub-navigation">
	{{ $sub_navigation->display() }}
</div>

<div id="ctr-accountSettings" class="row">
	<div class="span5" style="border:solid 1px #000">
		{{ Form::open('/account/settings') }}
		{{ Form::token() }}
		{{ Form::hidden($form_data['user-id']['name'], $form_data['user-id']['value']) }}

		<div class="row form span5">
			{{ Form::label($form_data['lbl-email']['target'], $form_data['lbl-email']['label']) }}
			<div class="form fields">{{ Form::text($form_data['email']['name'], $form_data['email']['value'], $form_data['email']['extra']) }}</div>
		</div>
		<div class="row form span5">
			{{ Form::label($form_data['lbl-first-name']['target'], $form_data['lbl-first-name']['label']) }}
			<div class="form fields">{{ Form::text($form_data['first-name']['name'], $form_data['first-name']['value'], $form_data['first-name']['extra']) }}</div>
		</div>
		<div class="row form span5">
			{{ Form::label($form_data['lbl-last-name']['target'], $form_data['lbl-last-name']['label']) }}
			<div class="form fields">{{ Form::text($form_data['last-name']['name'], $form_data['last-name']['value'], $form_data['last-name']['extra']) }}</div>
		</div>
		<div class="row form span5">
			<div class="form fields">{{ Form::submit($form_data['btn-submit']['value'], $form_data['btn-submit']['extra']) }}</div>
		</div>

		{{ Form::close() }}
	</div>
</div>
@endsection