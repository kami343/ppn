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

class SendPlayer2Confirmation2 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data = [];
    protected $leagueDetail = [];

    protected $userId;
    protected $teamId;
    protected $siteSettings;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$userId,$teamsid,$leagueDetail, $siteSettings)
    {
        $this->data = $data;
        $this->leagueDetail = $leagueDetail;
        $this->siteSettings = $siteSettings;
        $this->userId=$userId;
        $this->teamId=$teamsid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {

        $mailer->send('emails.site.teams_player.player_2_confirmation_email_single', ['data' => $this->data,'userid'=>$this->userId,'teamid'=>$this->teamId,'league' => $this->leagueDetail, 'siteSettings' => $this->siteSettings], function ($message) {
            $message->from($this->siteSettings['from_email'], $this->siteSettings['website_title']);
            $message->to($this->data['player_2_email'], $this->siteSettings['website_title'])->subject(trans('custom.label_signup_form'));
        });

    }
}
