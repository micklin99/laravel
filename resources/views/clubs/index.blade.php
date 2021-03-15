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

    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-delete">
        Launch Default Modal
    </button>

      <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Warning: Attempting to Delete Club Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Do you really want to delete this club data?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-warning">Delete Club</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


	<div class="col-12">
	    <div class="card mx-3">
		<div class="card-header">
		    <div class="row">
	    		<div class="col-9">
			    <h3 class="card-title">Club Management</h3>
			</div>
			<div class="col-3">
			    <a class="btn btn-success" href="{{ route('clubs.create') }}"> Create New Club</a>
			</div>
		    </div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">

		    @if ($message = Session::get('success'))
			<div class="alert alert-success">
			    <p>{{ $message }}</p>
			</div>
		    @endif

		    {!! $dataTable->table(); !!}


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
<!-- <script src="{{ url('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}" ></script>  -->
<script src="{{ url('/plugins/jszip/jszip.min.js') }}"></script> 
<!-- <script src="{{ url('/plugins/pdfmake/pdfmake.min.js') }}"></script>  -->
<!-- <script src="{{ url('/plugins/pdfmake/vfs_fonts.js') }}"></script> -->
<script src="{{ url('/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script> 
<script src="{{ url('/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script> 
<!-- <script src="{{ url('/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>  -->


<script src="{{ url('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>  -->



{!! $dataTable->scripts(); !!}


<script type="text/javascript">

 $(document).ready(function () {

     console.log("Document ready!!!");

     $(document).on('click', '.delete-button', function(e)
	 {
	     return confirm("Warning: Do you really want to delete '" + e.target.id + "'?");
	 }
     );

     $(document).on('click', '.view-button', function(e)
	 {
	     console.log("view button clicked");
	 }
     );


     $(document).ready(function () {
         $("#modal-default").on("show.bs.modal", function (e) {
                    var id = $(e.relatedTarget).data('target-id');
                    $('#pass_id').val(id);
                });
            });

 });
</script>



@endpush

