<?php


namespace App\Jobs;
use App\Models\StoreSession;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Mail;
use Illuminate\Contracts\Mail\Mailer;


class SendRefundToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $teamPlayers;
    protected $leagueDetail;

    protected $siteSettings;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($teamPlayers, $leagueDetail, $siteSettings)
    {
        $this->teamPlayers = $teamPlayers;
        $this->leagueDetail = $leagueDetail;
        $this->siteSettings = $siteSettings;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send('emails.site.teams_player.refund-request-email', ['player' => $this->teamPlayers, 'league' => $this->leagueDetail, 'siteSettings' => $this->siteSettings], function ($message) {
            $message->from($this->siteSettings['from_email'], $this->siteSettings['website_title']);
            $message->to($this->teamPlayers->player2_email, $this->siteSettings['website_title'])->subject(trans('custom.label_signup_form'));
        });

    }
}
