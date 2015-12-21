<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Amelia\Money\OpenExchangeRatesFactory;
use Illuminate\Support\Facades\Config;

class CurrenciesTableSeeder extends Seeder
{
    public function run()
    {
        $rates = OpenExchangeRatesFactory::create(["key" => Config::get('services.money')['key']]);
        $currencies = array();

        foreach($rates->getCurrencies() as $key =>$value){
            $currencies[] = array(
                'short_name' => $key,
                'name' => $value
            );
        }

        DB::table('currencies')->truncate();
        DB::table('currencies')->insert($currencies);
    }
}