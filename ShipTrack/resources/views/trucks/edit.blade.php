@extends('layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card card-primary">
            <div class="card-header">Truck #{{$truck->id}}</div>
            <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{$action}}">
                <div class="card-body">

                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="">
                            <input id="title" type="text" class="form-control" name="title" value="{{ $truck->title }}" required autofocus>

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('vin') ? ' has-error' : '' }}">
                        <label for="vin" class="col-md-4 control-label">VIN</label>

                        <div class="">
                            <input id="vin" type="text" class="form-control" name="vin" value="{{ $truck->vin }}" required autofocus>

                            @if ($errors->has('vin'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('vin') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('license_plate') ? ' has-error' : '' }}">
                        <label for="license_plate" class="col-md-4 control-label">License Plate</label>

                        <div class="">
                            <input id="license_plate" type="text" class="form-control" name="license_plate" value="{{ $truck->license_plate }}" required autofocus>

                            @if ($errors->has('license_plate'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('license_plate') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('insurance_provider') ? ' has-error' : '' }}">
                        <label for="insurance_provider" class="col-md-4 control-label">Insurance Provider</label>

                        <div class="">
                            <input id="insurance_provider" type="text" class="form-control" name="insurance_provider" value="{{ $truck->insurance_provider }}" required autofocus>

                            @if ($errors->has('insurance_provider'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('insurance_provider') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('insurance_number') ? ' has-error' : '' }}">
                        <label for="insurance_number" class="col-md-4 control-label">Insurance #</label>

                        <div class="">
                            <input id="insurance_number" type="text" class="form-control" name="insurance_number" value="{{ $truck->insurance_number }}" required autofocus>

                            @if ($errors->has('insurance_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('insurance_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('registration_number') ? ' has-error' : '' }}">
                        <label for="registration_number" class="col-md-4 control-label">Registration #</label>

                        <div class="">
                            <input id="registration_number" type="text" class="form-control" name="registration_number" value="{{ $truck->registration_number }}" required autofocus>

                            @if ($errors->has('registration_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('registration_number') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('state_registered') ? ' has-error' : '' }}">
                        <label for="state_registered" class="col-md-4 control-label">State Registered</label>

                        <div class="">
                            <input id="state_registered" type="text" class="form-control" name="state_registered" value="{{ $truck->state_registered }}" required autofocus>

                            @if ($errors->has('state_registered'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('state_registered') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        <div class=" col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection