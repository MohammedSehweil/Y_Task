<?php

namespace App\Observers;

use App\Models\Translation;

class TranslationObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $currency
     * @return void
     */
//    public function created(Translation $translation)
//    {
//        $translation->load('currency');
//        $translation->pushToIndex();
//    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User  $currency
     * @return void
     */
    public function deleting(Translation $translation)
    {
        //
    }
}