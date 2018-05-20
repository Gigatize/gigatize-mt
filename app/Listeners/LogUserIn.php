<?php

namespace App\Listeners;

use App\User;
use Hyn\Tenancy\Environment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogUserIn
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Saml2LoginEvent  $event
     * @return void
     */
    public function handle(Saml2LoginEvent $event)
    {
        $messageId = $event->getSaml2Auth()->getLastMessageId();
        // your own code preventing reuse of a $messageId to stop replay attacks
        $user = $event->getSaml2User();
        $userData = [
            'id' => $user->getUserId(),
            'attributes' => $user->getAttributes(),
            'assertion' => $user->getRawSamlAssertion()
        ];

        //dd($userData);
        $laravelUser = User::firstOrCreate(['email' => $user->getUserId()],['email' => $user->getUserId(), 'first_name' => $user->getAttributes()['first_name'][0],'last_name' => $user->getAttributes()['last_name'][0],'role' => $user->getAttributes()['job_title'][0], 'status' => 1]);
        //if it does not exist create it and go on or show an error message
        Auth::login($laravelUser);
    }
}
