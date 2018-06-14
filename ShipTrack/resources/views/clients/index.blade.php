@extends('layouts.admin_layout')

@section('title-header-section')
<a href="{{route('admin-truck-create')}}"><button class="btn btn-primary">Create Truck</button></a>
@endsection

@section('content')
<div class="row">
	<div class="col-md-10 offset-md-1">
	  <div class="card">
	    <div class="card-header">
	      <h3 class="card-title">Data Table With Full Features</h3>
	    </div>
	    <!-- /.card-header -->
	    <!-- <div class="card-body"> -->
	      <table id="example1" class="table table-bordered table-striped">
	        <thead>
	        <tr>
	          <th>Client</th>
	          <th>Email</th>
	          <th>Phone</th>
	          <th>Address</th>
	          <th>Actions</th>
	        </tr>
	        </thead>
	        <tbody>
	          @foreach($clients as $client)
	            <tr>
	              <td>{{$client->name}}</td>
	              <td>{{$client->email}}</td>
	              <td>{{$client->phone}}</td>
	              <td>143 Fake St Philadelphia PA 10122</td>
	              <td>{{$client->id}}</td>
	            </tr>
	          @endforeach
	        </tbody>

	      </table>
	    <!-- </div> -->
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
                "<a href='/admin/clients/" + data + "'><i class='fa fa-eye fa-2x'></i></a>",
                "<a href='/admin/clients/" + data + "/edit'><i class='fa fa-pencil fa-2x'></i></a>",
                "<a class='text-danger' href='/admin/clients/" + data + "/delete'><i class='fa fa-trash fa-2x'></i></a>"
              ].join('');
            }
        }]
      });
    });
  </script>
@endsection

