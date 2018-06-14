@extends('layouts.admin_layout')

@section('title-header-section')
<a href="{{route('admin-truck-create')}}"><button class="btn btn-primary">Create Truck</button></a>
@endsection

@section('content')
<div class="row">
	<div class="col-xs-12">
	  <div class="card">
	    <div class="card-header">
	      <h3 class="card-title">Data Table With Full Features</h3>
	    </div>
	    <!-- /.card-header -->
	    <!-- <div class="card-body"> -->
	      <table id="example1" class="table table-bordered table-striped">
	        <thead>
	        <tr>
	          <th>Title</th>
	          <th>VIN</th>
	          <th>License Plate</th>
	          <th>Ins. Provider</th>
	          <th>Insurance #</th>
	          <th>Registration #</th>
	          <th>State</th>
	          <th>Actions</th>
	        </tr>
	        </thead>
	        <tbody>
	          @foreach($trucks as $truck)
	            <tr>
	              <td>{{$truck->title}}</td>
	              <td>{{$truck->vin}}</td>
	              <td>{{$truck->license_plate}}</td>
	              <td>{{$truck->insurance_provider}}</td>
	              <td>{{$truck->insurance_number}}</td>
	              <td>{{$truck->registration_number}}</td>
	              <td>{{$truck->state_registered}}</td>
	              <td>{{$truck->id}}</td>
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
                "<a href='/admin/trucks/" + data + "'><i class='fa fa-eye fa-2x'></i></a>",
                "<a href='/admin/trucks/" + data + "/edit'><i class='fa fa-pencil fa-2x'></i></a>",
                "<a class='text-danger' href='/admin/trucks/" + data + "/delete'><i class='fa fa-trash fa-2x'></i></a>"
              ].join('');
            }
        }]
      });
    });
  </script>
@endsection

