<?php

namespace App\Listeners;

use App\Events\CsvDataSaved;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserRowsCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CsvDataSaved $event): void
    {
        $user = User::find($event->userId);
        $existingRows = $user->rows_count;
        $rowsCount = $event->rowsCount;
        $user->update(['rows_count'=> $existingRows + $rowsCount]);
        $user->save();
        // dd($user);
    }
}
