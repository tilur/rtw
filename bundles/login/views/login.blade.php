@layout('layouts.master')

@section('content')
{{ Form::open('login') }}
{{ Form::token() }}
<div class="row">
	<div class="span3">
		{{ Form::label($form_data['lbl-email']['target'], $form_data['lbl-email']['label']) }}
		{{ Form::text($form_data['email']['name'], $form_data['email']['value'], $form_data['email']['extra']) }}
	</div>
</div>
<div class="row">
	<div class="span3">
		{{ Form::label($form_data['lbl-password']['target'], $form_data['lbl-password']['label']) }}
		{{ Form::password($form_data['password']['name'], $form_data['password']['extra']) }}
	</div>
</div>
<div class="row">
	<div class="span3">
		{{ Form::submit($form_data['btn-submit']['value'], $form_data['btn-submit']['extra'])}}
	</div>
</div>
{{ Form::close() }}
@endsection