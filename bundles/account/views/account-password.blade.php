@layout('layouts.master')

@section('navigation')
<div class="btn-group">
    {{ $view_data['navigation']->display() }}
</div>
@endsection

@section('page-topper')
<div class="page-header">
    <h1>Account <small>Password</small></h1>
    Change your account's password
</div>
@endsection

@section('content')
@if (isset($success))
    <div class="alert alert-success">
    @if ($success == 'update')
        <strong>Update Successful!</strong>
    @endif
     Your password has been saved.
    </div>
@endif

<div class="btn-group sub-navigation">
    {{ $sub_navigation->display() }}
</div>

<div id="ctr-accountSettings" class="row">
    <div class="span5" style="border:solid 1px #000">
        {{ '<pre>'.print_r($errors,true).'</pre>' }}
        {{ Form::open('/account/password') }}
        {{ Form::token() }}
        {{ Form::hidden($form_data['user-id']['name'], $form_data['user-id']['value']) }}

        <div class="row form span5">
            {{ Form::label($form_data['lbl-password-current']['target'], $form_data['lbl-password-current']['label']) }}
            <div class="form fields">{{ Form::password($form_data['password-current']['name'], $form_data['password-current']['extra']) }}</div>
        </div>
        <div class="row form span5">
            {{ Form::label($form_data['lbl-password-new']['target'], $form_data['lbl-password-new']['label']) }}
            <div class="form fields">{{ Form::password($form_data['password-new']['name'], $form_data['password-new']['extra']) }}</div>
        </div>
        <div class="row form span5">
            {{ Form::label($form_data['lbl-password-verify']['target'], $form_data['lbl-password-verify']['label']) }}
            <div class="form fields">{{ Form::password($form_data['password-verify']['name'], $form_data['password-verify']['extra']) }}</div>
        </div>
        <div class="row form span5">
            <div class="form fields">{{ Form::submit($form_data['btn-submit']['value'], $form_data['btn-submit']['extra']) }}</div>
        </div>

        {{ Form::close() }}
    </div>
</div>
@endsection