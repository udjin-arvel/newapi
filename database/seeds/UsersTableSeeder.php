<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    // -------------------------------------------------
	    
    	$user = new User;
	
	    $user->name = 'Arvelov';
	    $user->email = 'udjin.arvel@gmail.com';
	    $user->password = Hash::make('derder923');
	    $user->remember_token = Str::random(10);
	    $user->status = User::STATUS_ADMIN;
	
	    $user->save();
	    
	    // -------------------------------------------------
	
	    $user = new User;
	
	    $user->name = 'Moderator';
	    $user->email = 'moderator@arvelov.space';
	    $user->password = Hash::make('YhD5kXxCowjiI0B');
	    $user->remember_token = Str::random(10);
	    $user->status = User::STATUS_MODERATOR;
	
	    $user->save();
	
	    // -------------------------------------------------
	
	    $user = new User;
	
	    $user->name = 'Corrector';
	    $user->email = 'corrector@arvelov.space';
	    $user->password = Hash::make('YhD5kXxCowjiI0B');
	    $user->remember_token = Str::random(10);
	    $user->status = User::STATUS_CORRECTOR;
	
	    $user->save();
	
	    // -------------------------------------------------
	
	    $user = new User;
	
	    $user->name = 'Writer';
	    $user->email = 'writer@arvelov.space';
	    $user->password = Hash::make('YhD5kXxCowjiI0B');
	    $user->remember_token = Str::random(10);
	    $user->status = User::STATUS_WRITER;
	
	    $user->save();
	
	    // -------------------------------------------------
	
	    $user = new User;
	
	    $user->name = 'Reader';
	    $user->email = 'reader@arvelov.space';
	    $user->password = Hash::make('YhD5kXxCowjiI0B');
	    $user->remember_token = Str::random(10);
	    $user->status = User::STATUS_READER;
	
	    $user->save();
    }
}
