<?php

namespace App\Helper;

use App\Models\MemberSubscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class FunctionUtilities
{
    private function sendEmail($body_content, $email_address, $subject)
    {
        Mail::raw($body_content, function ($msg) use ($email_address, $subject) {
            $msg->to($email_address)
                ->subject($subject);
        });
    }

    private function sendSubscriptionReminders()
    {
        $subscriptionsEndingSoon = MemberSubscription::whereDate('finished_at', '=', Carbon::now()->addDays(3))->get();

        foreach ($subscriptionsEndingSoon as $subscription) {
            $user = $subscription->user;

            if ($user) {
                $userMessage = "Hello {$user->first_name} {$user->last_name},\n\n"
                    . "We hope you're enjoying your membership. This is a friendly reminder that your subscription will end in 3 days on {$subscription->finished_at}. "
                    . "Please renew your subscription before the end date to continue enjoying our services.\n\n"
                    . "Thank you for being with us.\n\nBest Regards,\nYour Team";

                $this->sendEmail($userMessage, $user->email, 'Subscription Reminder');

                $adminMessage = "Reminder:\n\nThe subscription for user {$user->first_name} {$user->last_name} (Email: {$user->email}) "
                    . "will end in 3 days on {$subscription->finished_at}.";
                $this->sendEmail($adminMessage, 'admin@example.com', 'User Subscription Ending Soon');
            }
        }
    }

    private function sendLastWarnings()
    {
        $subscriptionsEndingToday = MemberSubscription::whereDate('finished_at', '=', Carbon::now())->get();

        foreach ($subscriptionsEndingToday as $subscription) {
            $user = $subscription->user;

            if ($user) {
                $userMessage = "Hello {$user->first_name} {$user->last_name},\n\n"
                    . "This is your final reminder that your subscription ends today ({$subscription->finished_at}). "
                    . "Please renew it as soon as possible to avoid any disruption in service.\n\n"
                    . "Thank you for being with us.\n\nBest Regards,\nYour Team";

                $this->sendEmail($userMessage, $user->email, 'Final Subscription Warning');

                $adminMessage = "Final Warning:\n\nThe subscription for user {$user->first_name} {$user->last_name} (Email: {$user->email}) "
                    . "ends today ({$subscription->finished_at}). Follow up if needed.";
                $this->sendEmail($adminMessage, 'admin@example.com', 'Final Subscription Warning');
            }
        }
    }

    private function deactivateExpiredSubscriptions()
    {
        $expiredSubscriptions = MemberSubscription::whereDate('finished_at', '<', Carbon::now()->subDay())->get();

        foreach ($expiredSubscriptions as $subscription) {
            $user = $subscription->user;

            if ($user) {
                $user->update(['is_active' => 0]);

                $adminMessage = "User {$user->first_name} {$user->last_name} (Email: {$user->email}) "
                    . "has been deactivated because their subscription ended on {$subscription->finished_at}.";
                $this->sendEmail($adminMessage, 'admin@example.com', 'User Deactivated Due to Subscription End');
            }
        }
    }

    public function checkUserSubscriptions()
    {
        $this->sendSubscriptionReminders();
        $this->sendLastWarnings();
        $this->deactivateExpiredSubscriptions();
    }
}
