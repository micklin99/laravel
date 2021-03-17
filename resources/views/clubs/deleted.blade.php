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
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Warning: Attempting to Delete Club Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="modal-message">Do you really want to delete this club data?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-warning modal-ack-delete" data-dismiss="modal" id="x">Delete Club</button>
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
			<div class="col-12">			    
			    @if ($message = Session::get('success'))
				<div class="alert alert-success">
				    <p>{{ $message }}</p>
				</div>
			    @endif
			    @if ($message = Session::get('error'))
				<div class="alert alert-warning">
				    <p>{{ $message }}</p>
				</div>
			    @endif
			</div>
		    </div>
		    <div class="row">			
	    		<div class="col-8">
			    <h3 class="card-title">Club Management</h3>
			</div>
			<div class="col-2">
			    <a class="btn btn-primary" href="#">View Deleted Clubs</a>
			</div>
			<div class="col-2">
			    <a class="btn btn-success" href="{{ route('clubs.create') }}">Create New Club</a>
			</div>
		    </div>
		</div>
		<!-- /.card-header -->
		<div class="card-body">

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

     //
     //  Function to show the modal to verify we want to delete a club
     //     after clicking on any delete button in the table...
     //
     $(document).on('click', '.delete-button', function(e)
	 {
	     // get the id of the delete-button that was clicked
	     //    and set the message for the modal
	     $('.modal-message').text("Do you really want to delete the club: " + $(this).attr("name") + "?");
	     
	     // get the id of the delete-button that was clicked
	     //    and set the id for acknowledge button
	     $('.modal-ack-delete').attr("id",$(this).attr('id'));
	     
	     // show the modal div
	     $('#modal-delete').modal('show');
	 }
     );

     //
     // Function to redirect after we confirm club deletion...
     //    by clicking on the 'modal-ack-delete' button
     //     
     $(document).on('click', '.modal-ack-delete', function(e)
	 {
	     // get the 'id' of the 'modal-ack-delete' button
	     //    and redirect to the appropriate url based on the id...
	     //
	     var url = "clubs/delete/" + $('.modal-ack-delete').attr("id");
	     window.location = url;
	 }
     );
     
 });
</script>



@endpush

