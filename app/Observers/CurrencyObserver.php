<?php

namespace App\Observers;

use App\Jobs\CurrencyJob;
use App\Models\Currency;

class CurrencyObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $currency
     * @return void
     */
    public function created(Currency $currency)
    {
        CurrencyJob::dispatch($currency)->delay(60);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User  $currency
     * @return void
     */
    public function deleting(Currency $currency)
    {
        //
    }


    public function updated(Currency $currency)
    {
        CurrencyJob::dispatch($currency)->delay(60);
    }

}