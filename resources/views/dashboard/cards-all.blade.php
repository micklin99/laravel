

<!--

   Dashboard Cards
   ---------------

     We can include a new dashboard card by using the blade 'include'
     directive and specifying the 'dashboard.card' blade file.  We pass
     an array of variables to the blade card file.  Each variable is
     defined as follows:

     'card_progress'       => "none" or a value between "0" and "100"
                                  if "none" is used, no progress bar
                                  is displayed at the top of the card.
                                  An integer value determines the
                                  percentage of a progress bar that is
                                  displayed.
     
     'card_title'          => The card title
     
     'card_text'           => The card description text
     
     'card_image'          => The url for the card image
     
     'card_url'            => The url to redirect when the card is clicked

-->



<div class="container mt-2">

    <div class="row mx-3">
	
	<div class="card-deck">

	    @include('dashboard.card',
		     array(
			 'card_progress'       => "60",
			 'card_title'          => "Account",
			 'card_text'           => "Setup and manage your household account",
			 'card_image'          => "https://static.pexels.com/photos/7096/people-woman-coffee-meeting.jpg",
			 'card_url'            => "pages/account.php"
	    ))
	    
	    
	    @include('dashboard.card',
		     array(
			 'card_progress'       => "20",
			 'card_title'          => "Players",
			 'card_text'           => "Register players and manage player accounts",
			 'card_image'          => "https://static.pexels.com/photos/7357/startup-photos.jpg",
			 'card_url'            => "#"
	    ))
	    

	    @include('dashboard.card',
		     array(
			 'card_progress'       => "none",
			 'card_title'          => "Messages",
			 'card_text'           => "Communicate with your teams, coaches, and others",
			 'card_image'          => "https://static.pexels.com/photos/262550/pexels-photo-262550.jpeg",
			 'card_url'            => "#"
	    ))

	</div>

	
    </div>
</div>

