<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class createAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creates a new user and password';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
	$answer    = "no";
	$email     = "";
	$firstName = "";
	$lastName  = "";

	while ($answer != "yes")
	{
	    $email     = $this->ask('Enter the email address: ');
	    $firstName = $this->ask('Enter the first name: ');
	    $lastName  = $this->ask('Enter the last name: ');

	    $this->newLine();
	    $this->info('========================================================');
	    $this->info('Email address:  ' . $email);
	    $this->info('Full Name    :  ' . $firstName . " " . $lastName);
	    $this->info('========================================================');
	    $this->newLine();	    
	    $answer = $this->choice('Is this information correct?', ['yes', 'no'], 0);
	}

	$match = false;

	while (! $match)
	{
	    $password  = $this->secret('Enter the password  : ');
	    $password2 = $this->secret('Confirm the password: ');

	    if ($password == $password2)
		$match = true;
	    else
	    {
		$this->newLine();	    		
		$this->info("** Passwords do not match.  Please retry...");
		$this->newLine();	    
	    }
	}

	$user = new User();
	$user->email     = $email;
	$user->firstname = $firstName;
	$user->lastname  = $lastName;
	$user->password  = Hash::make($password);
	$user->save();
	
        return 0;
    }
}
