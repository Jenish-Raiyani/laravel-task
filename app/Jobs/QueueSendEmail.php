<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use \Illuminate\Support\Facades\DB;

class QueueSendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function sendMail($to, $content, $title)
    {

        $body = $content;
        $subject = "New Post: $title";

        $headers = array(
            'Authorization: Bearer APIKEY',
            'Content-Type: application/json',
        );

        $data = array(
            'personalizations' => array(
                array(
                    'to' => array(
                        array(
                            'email' => $to,
                        ),
                    ),
                ),
            ),
            'from' => array(
                'email' => 'jenishraiyani74@gmail.com',
                'name' => 'Jenish Raiyani',
            ),
            'subject' => $subject,
            'content' => array(
                array(
                    'type' => 'text/html',
                    'value' => $body,
                ),
            ),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_URL, 'https://api.sendgrid.com/v3/mail/send');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $headerSent = curl_getinfo($ch, CURLINFO_HEADER_OUT);
        curl_close($ch);
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $web1_post = DB::table('tbl_web1post')->where(['is_new' => 1])->get()->first();
        $web2_post = DB::table('tbl_web2post')->where(['is_new' => 1])->get()->first();

        // Send mail to those user who has subscribe website 2
        if (!empty($web1_post)) {
            $web1_subscriber = DB::table('tbl_subscribers')->where(['website_id' => 1])->get('email')->toArray();
            $web1_subscriber = json_decode(json_encode($web1_subscriber), true);
            $web1_post = json_decode(json_encode($web1_post), true);

            for ($i = 0; $i < count($web1_subscriber); $i++) {

                $to = $web1_subscriber[$i]['email'];
                $title = $web1_post['title'];
                $description = $web1_post['description'];
                $msg = sprintf('<h1>Title:%s </h1><br> <b>Description:</b> %s ', $title, $description);
                $this->sendMail($to, $msg, $title);
            }
            DB::table('tbl_web1post')->where('id', $web1_post['id'])->limit(1)->update(array('is_new' => 0));
        }

        // Send mail to those user who has subscribe website 2
        if (!empty($web2_post)) {
            $web2_subscriber = DB::table('tbl_subscribers')->where(['website_id' => 2])->get('email')->toArray();
            $web2_subscriber = json_decode(json_encode($web2_subscriber), true);
            $web2_post = json_decode(json_encode($web2_post), true);

            for ($i = 0; $i < count($web2_subscriber); $i++) {

                $to = $web2_subscriber[$i]['email'];
                $title = $web2_post['title'];
                $description = $web2_post['description'];
                $msg = sprintf('<h1>Title:%s </h1><br> <b>Description:</b> %s ', $title, $description);
                $this->sendMail($to, $msg, $title);
            }
            DB::table('tbl_web2post')->where('id', $web2_post['id'])->limit(1)->update(array('is_new' => 0));
        }

    }
}
