@extends('layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card card-primary">
            <div class="card-header">{{$client->name ? $client->name : "Add Client"}}</div>
            <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{$action}}">
                <div class="card-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label"> Client Name</label>
                        <div class="">
                            <input id="name" type="text" class="form-control" name="name" value="{{ $client->name }}" required autofocus>
                        </div>
                    <div class="form-group">
                        <label for="email" class="col-md-4 control-label">Email</label>

                        <div class="">
                            <input id="email" type="text" class="form-control" name="email" value="{{ $client->email }}" required autofocus>      
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="col-md-4 control-label">Phone</label>

                        <div class="">
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ $client->phone }}" required autofocus>
                        </div>
                    </div>
                    
                    <div id="client_addresses">
                        @foreach($addresses as $address)
                            <div class="row address">
                                <div class="col-md-1 form-group">
                                    <input @if($address->id == $client->primary_address_id) checked @endif type="radio" name="primary_address" value="{{$address->id}}">

                                    <span type="radio" class="fa fa-times remove-address"></span>
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label for="a-title-{{ $address->id }}" class="control-label">Nickname</label>

                                            <div class="">
                                                <input id="a-title-{{ $address->id }}" type="text" class="form-control" name="addresses[{{$address->id}}][title]" value="{{$address->title}}" required autofocus>   
                                            </div>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="a-address_1-{{$address->id}}" class="control-label">Address 1</label>

                                            <div class="">
                                                <input id="a-address_1-{{$address->id}}" type="text" class="form-control" name="addresses[{{$address->id}}][address_1]" value="{{$address->address_1}}" required autofocus>

                                            </div>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="a-address_2-{{$address->id}}" class="control-label">Address 2</label>

                                            <div class="">
                                                <input id="a-address_2-{{$address->id}}" type="text" class="form-control" name="addresses[{{$address->id}}][address_2]" value="{{$address->address_2}}" autofocus>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label for="a-city-{{$address->id}}" class=" control-label">City</label>

                                            <div class="">
                                                <input id="a-city-{{$address->id}}" type="text" class="form-control" name="addresses[{{$address->id}}][city]" value="{{$address->city}}" required autofocus>

                                            </div>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="a-state-{{$address->id}}" class=" control-label">State</label>

                                            <div class="">
                                                <input id="a-state-{{$address->id}}" type="text" class="form-control" name="addresses[{{$address->id}}][state]" value="{{$address->state}}" required autofocus>

                                            </div>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="a-postal-{{$address->id}}" class="control-label">Postal</label>

                                            <div class="">
                                                <input id="a-postal-{{$address->id}}" type="text" class="form-control" name="addresses[{{$address->id}}][postal]" value="{{$address->postal}}" required autofocus>

                                            </div>
                                        </div>
                                    </div>
                                </div>          
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <button id="addAddress" class="btn col-md-3">Add Address</button>
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

@section('footer-js')
    @parent
    <script type="text/javascript">
        $(function() {
            $('body').delegate('.remove-address', 'click', function () {
                $(this).parents('.address').remove();
            });
        });
        $(function() {
            $('#addAddress').on('click', function(evt) {
                evt.preventDefault();
                var id = 'new-'+Math.random(),
                    addressForm = [
                    '<div class="row">',
                        '<div class="col-md-1 form-group">',
                            '<input type="radio" name="primary_address" value="',id,'">',
                       '</div>',
                        '<div class="col-md-11">',
                            '<div class="row">',
                                '<div class="col-md-3 form-group">',
                                    '<label for="a-title-',id,'" class="control-label">Nickname</label>',

                                    '<div class="">',
                                        '<input id="a-title-',id,'" type="text" class="form-control" name="addresses[',id,'][title]" value="" required autofocus> ',  
                                    '</div>',
                                '</div>',

                                '<div class="col-md-3 form-group">',
                                   ' <label for="a-address_1-',id,'" class="control-label">Address 1</label>',

                                    '<div class="">',
                                        '<input id="a-address_1-',id,'" type="text" class="form-control" name="addresses[',id,'][address_1]" value="" required autofocus>',

                                    '</div>',
                                '</div>',

                                '<div class="col-md-3 form-group">',
                                    '<label for="a-address_2-',id,'" class="control-label">Address 2</label>',

                                   '<div class="">',
                                        '<input id="a-address_2-',id,'" type="text" class="form-control" name="addresses[',id,'][address_2]" value="" autofocus>',
                                    '</div>',
                                '</div>',
                           ' </div>',

                             '<div class="row">',
                               '<div class="col-md-3 form-group">',
                                    '<label for="a-city-',id,'" class=" control-label">City</label>',

                                    '<div class="">',
                                       ' <input id="a-city-',id,'" type="text" class="form-control" name="addresses[',id,'][city]" value="" required autofocus>',

                                    '</div>',
                                '</div>',

                                '<div class="col-md-3 form-group">',
                                    '<label for="a-state-',id,'" class=" control-label">State</label>',

                                    '<div class="">',
                                        '<input id="a-state-',id,'" type="text" class="form-control" name="addresses[',id,'][state]" value="" required autofocus>',

                                    '</div>',
                                '</div>',

                                '<div class="col-md-3 form-group">',
                                    '<label for="a-postal-',id,'" class="control-label">Postal</label>',

                                    '<div class="">',
                                        '<input id="a-postal-',id,'" type="text" class="form-control" name="addresses[',id,'][postal]" value="" required autofocus>',

                                    '</div>',
                                '</div>',
                            '</div>',
                        '</div>',          
                    '</div>',
                ].join('');
                $('#client_addresses').append(addressForm);

            });
        });
    </script>
@endsection