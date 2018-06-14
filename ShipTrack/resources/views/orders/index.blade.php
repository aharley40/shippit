@extends('layouts.admin_layout')

@section('title-header-section')
<a href="{{route('admin-order-create')}}"><button class="btn btn-primary">Create Order</button></a>
@endsection

@section('content')
<div class="row">
	<div class="col-12">
	  <div class="card">
	    <div class="card-header">
	      <h3 class="card-title">Data Table With Full Features</h3>
	    </div>
	    <!-- /.card-header -->
	    <div class="card-body">
	      <table id="example1" class="table table-bordered table-striped">
	        <thead>
	        <tr>
	          <th>Client</th>
	          <th>Description</th>
	          <th>Type</th>
	          <th>Delivery Date</th>
	          <th>Actions</th>
	        </tr>
	        </thead>
	        <tbody>
	          @foreach($orders as $order)
	            <tr>
	              <td>{{$order->client_id}}</td>
	              <td>{{$order->description}}</td>
	              <td>{{$order->type}}</td>
	              <td>{{$order->delivery_date}}</td>
	              <td>{{$order->id}}</td>
	            </tr>
	          @endforeach
	        </tbody>
	        <tfoot>
	        <tr>
	          <th>Rendering engine</th>
	          <th>Browser</th>
	          <th>Platform(s)</th>
	          <th>Engine version</th>
	          <th>CSS grade</th>
	        </tr>
	        </tfoot>
	      </table>
	    </div>
	    <!-- /.card-body -->
	  </div>
	  <!-- /.card -->
	</div>
	<!-- /.col -->
</div>
@endsection


@section('footer-js')
	@parent
	 <script>
    $(function () {
      $("#example1").DataTable({
        "columnDefs": [ {
            "targets": -1,
            "render": function (data) {
              return [
                "<a href='/admin/orders/" + data + "'><i class='fa fa-eye fa-2x'></i></a>",
                "<a href='/admin/orders/" + data + "/edit'><i class='fa fa-pencil fa-2x'></i></a>",
                "<a class='text-danger' href='/admin/orders/" + data + "/delete'><i class='fa fa-trash fa-2x'></i></a>"
              ].join('');
            }
        }, {
            "targets": -2,
            "render": function (data) {
              var date = new Date(parseInt(data) * 1000);
              console.log(date);
              date.setMinutes(date.getMinutes() - new Date().getTimezoneOffset());

              return date.toString();
            }
              }]
      });
    });
  </script>
@endsection
