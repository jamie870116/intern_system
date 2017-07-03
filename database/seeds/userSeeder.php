<?php

use Illuminate\Database\Seeder;
use App\User as UserEloquent;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//'u_name', 'email', 'password','u_status','u_tel','u_uni'
        $user=UserEloquent::create([
    		'u_name'=>'學生',
    		'u_tel'=>'0988379188',
    		'account'=>'s1110234013',
    		'u_status'=>0,
    		'email'=>'s1110234013@nutc.edu.tw',
    		'password'=>bcrypt('test'),
            'started'=>1
    		]);
         $user1=UserEloquent::create([
    		'u_name'=>'老師',
    		'u_tel'=>'0980365799',
    		'account'=>'teacher123',
    		'u_status'=>1,
    		'email'=>'teacher123@nutc.edu.tw',
    		'password'=>bcrypt('test')
    		]);
          $user2=UserEloquent::create([
    		'u_name'=>'企業',
    		'u_tel'=>'0972012889',
    		'account'=>'12345678',
    		'u_status'=>2,
    		'email'=>'jamie870116@gmail.com',
    		'password'=>bcrypt('test')
    		]);
    }
}
