
<div class="card card-block mx-2" onclick='window.location="{{ $card_url }}"'>
    <h4 class="card-title">
	<div class="row my-3 mx-auto">
	    <div class="col mx-5">

		@if ( $card_progress == "none" )
		    <div class="progress invisible"></div>
		@else

		    <div class="progress ">
			<div class="progress-bar progress-bar-striped {{ $card_progress < 40? 'bg-warning':'bg-success' }}" role="progressbar" style="width: {{ $card_progress }}%"
			     aria-valuenow={{ $card_progress }} aria-valuemin="0" aria-valuemax="100">
			</div>
			<small class="justify-content-center d-flex position-absolute w-100" style="bottom: 8px">
			    {{ $card_progress }}% complete
			</small>
		    </div>
		@endif

	    </div>
	</div>
    </h4>

    <img src= {{ $card_image }} alt="Photo" style="height:200px;">

    <h5 class="text-center text-primary font-weight-bold my-3">
	{{ $card_title }}
    </h5>

    <p class="card-text text-center mx-5 mb-3">
	{{ $card_text }}
    </p>

</div>
