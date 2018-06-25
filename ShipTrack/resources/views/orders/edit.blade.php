@extends('layouts.admin_layout')

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card card-primary">
            <div class="card-header">{{$order->id ? $order->id : "Add Order"}}</div>
            <form enctype="multipart/form-data" class="form-horizontal" method="POST" action="{{$action}}">
                <div class="card-body">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="client_id" class="col-md-4 control-label">Client</label>

                        <div class="">
                            <select id="client_id" class="form-control" name="client_id" value="{{ $order->client_id }}" required autofocus>
                                @foreach ($clients as $client)
                                    <option class="form-control" value="{{ $client->id}}">{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-md-4 control-label">Delivery or Pickup</label>

                        <div class="">
                            <select id="type" class="form-control" name="type" value="{{ $order->type }}" required autofocus>
                                <option placeholder="Select" @if($order->type == 'delivery') selected @endif class="form-control" value="delivery">Delivery</option>
                                <option @if($order->type == 'pickup') selected @endif class="form-control" value="pickup">Pickup</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="delivery_date" class="col-md-4 control-label">{{ $order->type }} Date</label>

                        <div class="">
                            <input id="delivery_date" type="datetime-local" class="form-control" name="delivery_date" value="{{ $order->delivery_date }}" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-md-4 control-label">Description</label>

                        <div class="">
                            <textarea id="description" class="form-control" name="description" cols="25" rows="5" value="{{ $order->description }}" autofocus></textarea>
                        </div>
                    </div>


                    <div id="order_orderItems">
                        @foreach($orderItems as $orderItem)
                            <div class="row orderItem">
                                <div class="col-md-1 form-group">

                                    <span type="radio" class="fa fa-times remove-orderItem"></span>
                                </div>
                                <div class="col-md-11">
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label for="a-title-{{ $orderItem->id }}" class="control-label">Title</label>

                                            <div class="">
                                                <input id="a-title-{{ $orderItem->id }}" type="text" class="form-control" name="orderItems[{{$orderItem->id}}][title]" value="{{$orderItem->title}}" required autofocus>   
                                            </div>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="description{{$orderItem->id}}" class=" control-label">Description</label>

                                            <div class="">
                                                <textarea id="description{{$orderItem->id}}" type="textarea" class="form-control" name="orderItems[{{$orderItem->id}}][description]" value="{{$orderItem->description}}" required autofocus>
                                                </textarea>

                                            </div>
                                        </div>

                                        <div class="col-md-3 form-group">
                                            <label for="a-price-{{$orderItem->id}}" class="control-label">Price</label>

                                            <div class="">
                                                <input id="a-price-{{$orderItem->id}}" type="number" step="0.01" class="form-control" name="orderItems[{{$orderItem->id}}][price]" value="{{$orderItem->price}}" required autofocus>

                                            </div>
                                        </div>
                                    </div>
                                </div>          
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <button id="addOrderItem" class="btn col-md-3">Add OrderItem</button>
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
            $('body').delegate('.remove-orderItem', 'click', function () {
                $(this).parents('.orderItem').remove();
            });
        });
        $(function() {
            $('body').delegate('.remove-a-orderItem', 'click', function () {
                $(this).parents('.a-orderItem').remove();
            });
        });
        $(function() {
            $('#addOrderItem').on('click', function(evt) {
                
                var id = 'new-'+Math.random(),
                    orderItemsForm = [
                    '<div class="row a-orderItem">',
                        '<div class="col-md-11">',
                            '<span type="radio" class="fa fa-times remove-a-orderItem">',
                            '</span>',
                            '<div class="row">',
                                '<div class="col-md-3 form-group">',
                                    '<label for="a-title-',id,'" class="control-label">Title</label>',

                                    '<div class="">',
                                        '<input id="a-title-',id,'" type="text" class="form-control" name="orderItems[',id,'][title]" value="" required autofocus> ',  
                                    '</div>',
                                '</div>',

                                '<div class="col-md-3 form-group">',
                                   ' <label for="description',id,'" class="control-label">Description</label>',

                                    '<div class="">',
                                        '<textarea id="description',id,'" type="textarea" class="form-control" name="orderItems[',id,'][description]" value=""  autofocus></textarea>',

                                    '</div>',
                                '</div>',

                                '<div class="col-md-3 form-group">',
                                    '<label for="a-price-',id,'" class="control-label">Price</label>',

                                   '<div class="">',
                                        '<input id="a-price-',id,'" type="number" class="form-control" name="orderItems[',id,'][price]" value="" autofocus>',
                                    '</div>',
                                '</div>',
                           ' </div>',
                        '</div>',          
                    '</div>',
                ].join('');
                $('#order_orderItems').append(orderItemsForm);

            });
        });
    </script>
@endsection