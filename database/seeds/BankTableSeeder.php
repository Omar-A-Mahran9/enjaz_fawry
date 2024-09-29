<?php

use Illuminate\Database\Seeder;

use App\Bank;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $bank = new Bank;
        $bank->name = 'البنك الاهلي';
       // $bank->logo = 'logo.png';
        $bank->accountName = 'انجاز فوري';
        $bank->accountNo = '12345567889900';
        $bank->accountIban = 'SA1234578899000090909090';
        $bank->status = 1;
        $bank->save();

        $bank1 = new Bank;
        $bank1->name = 'مصرف الراجحي';
      //  $bank1->logo = 'logo.png';
        $bank1->accountName = 'انجاز فوري';
        $bank1->accountNo = '12345567889900';
        $bank1->accountIban = 'SA1234578899000090909090';
        $bank1->status = 1;
        $bank1->save();

        $bank2 = new Bank;
        $bank2->name = 'بنك ساب';
        //$bank2->logo = 'logo.png';
        $bank2->accountName = 'انجاز فوري';
        $bank2->accountNo = '12345567889900';
        $bank2->accountIban = 'SA1234578899000090909090';
        $bank2->status = 1;
        $bank2->save();
     
    

    }
}
