@extends('layouts.admin_layout')

@section('title-header-section')
<a href="{{route('admin-user-create')}}"><button class="btn btn-primary">Create Truck</button></a>
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
	          <th>ID</th>
	          <th>Name</th>
	          <th>Email</th>
	          <th>Phone</th>
	          <th>Level</th>
	        </tr>
	        </thead>
	        <tbody>
	          @foreach($users as $user)
	            <tr>
	              <td>{{$user->id}}</td>
	              <td>{{$user->name}}</td>
	              <td>{{$user->email}}</td>
	              <td>{{$user->phone}}</td>
	              <td>{{$user->level}}</td>
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
                "<a href='/admin/users/" + data + "'><i class='fa fa-eye fa-2x'></i></a>",
                "<a href='/admin/users/" + data + "/edit'><i class='fa fa-pencil fa-2x'></i></a>",
                "<a class='text-danger' href='/admin/users/" + data + "/delete'><i class='fa fa-trash fa-2x'></i></a>"
              ].join('');
            }
        }]
      });
    });
  </script>
@endsection

