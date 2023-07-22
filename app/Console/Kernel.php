<?php

namespace App\Console;

use App\Events\UserNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;
use SalimHosen\Core\Models\Notification;
use Carbon\Carbon;
use SalimHosen\Core\Mail\NotificationMail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){

            $notifications = Notification::where('send_at', '<=', Carbon::now())->where("is_sent", false)->get();
            foreach ($notifications as $notification) {

                foreach($notification->users as $user){
                    // Mail::to($user->email)->send(new NotificationMail($notification, $user));
                    UserNotification::dispatch($notification, $user->id);
                }

                $notification->is_sent = true;
                $notification->save();
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
