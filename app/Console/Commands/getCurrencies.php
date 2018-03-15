<?php

namespace App\Console\Commands;

use App\Models\Currency;
use Illuminate\Console\Command;

class getCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:currencies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get All Currencies';

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
     * @return mixed
     */
    public function handle()
    {
        if(!Currency::first()){
            $currencies = json_decode(file_get_contents(config('currencies.api_link')), true)['results'];
            foreach ($currencies as $code => $currency){
                $object['code'] = $currency['id'];
                if(isset($currency['currencySymbol'])){
                    $object['symbol'] = $currency['currencySymbol'];
                }
                $currency_object = Currency::create($object);
                $currency_object->translations()->create([
                    'name' => $currency['currencyName'],
                    'locale' => 'en',
                ]);
                unset($object);
            }
        }
    }
}
