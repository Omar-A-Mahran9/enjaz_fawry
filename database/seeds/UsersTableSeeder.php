<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = 'Vendor User';
        $user->account_no = '500100';
        $user->email = 'vendor@user.com';
        $user->type = 'vendor';
        $user->phone = '0549863908';
        $user->verification_code = '1234';
        $user->identity_no = '0123456789';
        $user->identity_status = 1;
        $user->phone_status = 1;
        $user->status = 1;  
        $user->phone_verified_at = now();
        $user->password = Hash::make('test123');
        $user->save();


        $user2 = new User;
        $user2->name = 'VendorC User';
        $user2->account_no = '500102';
        $user2->email = 'vendorC@user.com';
        $user2->type = 'vendorC';
        $user2->phone = '0549863902';
        $user2->verification_code = '1234';
        $user2->identity_no = '0123456700';
        $user2->identity_status = 1;
        $user2->phone_status = 1;
        $user2->status = 1;  
        $user2->phone_verified_at = now();
        $user2->password = Hash::make('test123');
        $user2->save();


        $user3 = new User;
        $user3->name = 'Vendor User';
        $user3->account_no = '500105';
        $user3->email = 'vendor5@user.com';
        $user3->type = 'vendor';
        $user3->phone = '0549863632';
        $user3->verification_code = '1234';
        $user3->identity_no = '0123456444';
        $user3->identity_status = 1;
        $user3->phone_status = 1;
        $user3->status = 1;  
        $user3->phone_verified_at = now();
        $user3->password = Hash::make('test123');
        $user3->save();


        $user4 = new User;
        $user4->name = 'VendorC User';
        $user4->account_no = '500106';
        $user4->email = 'vendorC6@user.com';
        $user4->type = 'vendorC';
        $user4->phone = '0549866662';
        $user4->verification_code = '1234';
        $user4->identity_no = '0123456660';
        $user4->identity_status = 1;
        $user4->phone_status = 1;
        $user4->status = 1;  
        $user4->phone_verified_at = now();
        $user4->password = Hash::make('test123');
        $user4->save();



        $user5 = new User;
        $user5->name = 'Client user';
        $user5->account_no = '500101';
        $user5->email = 'client@user.com';
        $user5->type = 'individual';
        $user5->phone = '0549863909';
        $user5->verification_code = '1234';
        $user5->phone_status = 1;
        $user5->status = 1;  
        $user5->identity_no = '0123456785';
        $user5->phone_verified_at = now();
        $user5->password = Hash::make('test123');
        $user5->save();

        $user6 = new User;
        $user6->name = 'Client user';
        $user6->account_no = '500107';
        $user6->email = 'client2@user.com';
        $user6->type = 'individual';
        $user6->phone = '0548863909';
        $user6->verification_code = '1234';
        $user6->phone_status = 1;
        $user6->status = 1;  
        $user6->identity_no = '0123476555';
        $user6->phone_verified_at = now();
        $user6->password = Hash::make('test123');
        $user6->save();
    }
}
