@extends('fortygoals')

@push('styles')
<!-- include any page specific stylesheets -->

<!-- DataTables -->
<link rel="stylesheet" type="text/css"
      href="{{ url('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css"
      href="{{ url('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }} ">
<link rel="stylesheet" type="text/css"
      href="{{ url('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }} ">

@endpush


@section('content')

    <div class="col-12">
	<div class="card mx-3">
            <div class="card-header">
		<h3 class="card-title">Club Management</h3>
		<div>
                    <a class="btn btn-success" href="{{ route('clubs.create') }}"> Create New Club</a>
		</div>
		
            </div>
            <!-- /.card-header -->
            <div class="card-body">

		@if ($message = Session::get('success'))
		    <div class="alert alert-success">
			<p>{{ $message }}</p>
		    </div>
		@endif

		<table id="example1" class="table datatable table-bordered table-striped">
		    <thead>
			<tr>
			    <th>Id</th>
			    <th>Name</th>
			    <th>Website</th>
			    <th>Subdomain</th>
			    <th width="280px">Action</th>
			</tr>
		    </thead>

		    <tbody>
		    </tbody>
		    
		</table>
	    </div>
	</div>
    </div>	

@endsection


@push('scripts')
<!-- include any page specific Javascript -->

<script src="{{ url('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ url('/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ url('/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ url('/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ url('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- Page specific script -->

<script type="text/javascript">

  $(function () {
    var table = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('clubs.list') }}",
        columns: [
            {data: 'id',        name: 'id'},
            {data: 'name',      name: 'name'},
            {data: 'website',   name: 'website'},
            {data: 'subdomain', name: 'subdomain'},
            {data: 'action',    name: 'action', orderable: false, searchable: false},
        ]
    });
  });

</script>

@endpush
