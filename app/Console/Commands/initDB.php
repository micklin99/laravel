<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\Models\State;
use App\Models\Country;

class initDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'loads a database with initial startup data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function loadStates()
    {
       $states = array(
              array( "abbrev"=>'AL', "name"=>'ALABAMA' ),
	      array( "abbrev"=>'AK', "name"=>'ALASKA' ),
	      array( "abbrev"=>'AZ', "name"=>'ARIZONA' ),
       	      array( "abbrev"=>'AR', "name"=>'ARKANSAS' ),
       	      array( "abbrev"=>'CA', "name"=>'CALIFORNIA' ),
       	      array( "abbrev"=>'CO', "name"=>'COLORADO' ),
       	      array( "abbrev"=>'CT', "name"=>'CONNECTICUT' ),
       	      array( "abbrev"=>'DE', "name"=>'DELAWARE' ),
       	      array( "abbrev"=>'DC', "name"=>'DISTRICT OF COLUMBIA' ),
       	      array( "abbrev"=>'FL', "name"=>'FLORIDA' ),
       	      array( "abbrev"=>'GA', "name"=>'GEORGIA' ),
       	      array( "abbrev"=>'HI', "name"=>'HAWAII' ),
       	      array( "abbrev"=>'ID', "name"=>'IDAHO' ),
       	      array( "abbrev"=>'IL', "name"=>'ILLINOIS' ),
       	      array( "abbrev"=>'IN', "name"=>'INDIANA' ),
       	      array( "abbrev"=>'IA', "name"=>'IOWA' ),
       	      array( "abbrev"=>'KS', "name"=>'KANSAS' ),
       	      array( "abbrev"=>'KY', "name"=>'KENTUCKY' ),
       	      array( "abbrev"=>'LA', "name"=>'LOUISIANA' ),
       	      array( "abbrev"=>'ME', "name"=>'MAINE' ),
       	      array( "abbrev"=>'MD', "name"=>'MARYLAND' ),
       	      array( "abbrev"=>'MA', "name"=>'MASSACHUSETTS' ),
       	      array( "abbrev"=>'MI', "name"=>'MICHIGAN' ),
       	      array( "abbrev"=>'MN', "name"=>'MINNESOTA' ),
       	      array( "abbrev"=>'MS', "name"=>'MISSISSIPPI' ),
       	      array( "abbrev"=>'MO', "name"=>'MISSOURI' ),
       	      array( "abbrev"=>'MT', "name"=>'MONTANA' ),
       	      array( "abbrev"=>'NE', "name"=>'NEBRASKA' ),
       	      array( "abbrev"=>'NV', "name"=>'NEVADA' ),
       	      array( "abbrev"=>'NH', "name"=>'NEW HAMPSHIRE' ),
       	      array( "abbrev"=>'NJ', "name"=>'NEW JERSEY' ),
       	      array( "abbrev"=>'NM', "name"=>'NEW MEXICO' ),
       	      array( "abbrev"=>'NY', "name"=>'NEW YORK' ),
       	      array( "abbrev"=>'NC', "name"=>'NORTH CAROLINA' ),
       	      array( "abbrev"=>'ND', "name"=>'NORTH DAKOTA' ),
       	      array( "abbrev"=>'OH', "name"=>'OHIO' ),
       	      array( "abbrev"=>'OK', "name"=>'OKLAHOMA' ),
       	      array( "abbrev"=>'OR', "name"=>'OREGON' ),
       	      array( "abbrev"=>'PA', "name"=>'PENNSYLVANIA' ),
       	      array( "abbrev"=>'RI', "name"=>'RHODE ISLAND' ),
       	      array( "abbrev"=>'SC', "name"=>'SOUTH CAROLINA' ),
       	      array( "abbrev"=>'SD', "name"=>'SOUTH DAKOTA' ),
       	      array( "abbrev"=>'TN', "name"=>'TENNESSEE' ),
       	      array( "abbrev"=>'TX', "name"=>'TEXAS' ),
       	      array( "abbrev"=>'UT', "name"=>'UTAH' ),
       	      array( "abbrev"=>'VT', "name"=>'VERMONT' ),
       	      array( "abbrev"=>'VA', "name"=>'VIRGINIA' ),
       	      array( "abbrev"=>'WA', "name"=>'WASHINGTON' ),
       	      array( "abbrev"=>'WV', "name"=>'WEST VIRGINIA' ),
       	      array( "abbrev"=>'WI', "name"=>'WISCONSIN' ),
       	      array( "abbrev"=>'WY', "name"=>'WYOMING' )
       );

       // determine if table exists and is empty

       $table = 'states';

       if (! Schema::hasTable( $table ))
       {
         $this->error("'" . $table . "' table does not exist.  Run 'php artisan migrate'.");
	 return;
       }

       $size = DB::table( $table )->count();

       if ($size > 0)
       {
         $this->error("'" . $table . "' table has previously been loaded and contains " .
	             $size . " rows.");
         return;
       }

       $numStates = count($states);

       for ($i = 0; $i < $numStates; $i++)
       {
	  $state = new State();
	  $state->id     = $i+1;
          $state->abbrev = $states[$i]["abbrev"];
          $state->name   = $states[$i]["name"];
          $state->save();
       }      
       
       $this->info("loaded " . $numStates . " rows into '" . $table . "' table.");
    }   


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $this->loadStates();
       
       return 0;
    }
}
