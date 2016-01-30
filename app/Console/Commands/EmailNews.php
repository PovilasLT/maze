<?php namespace maze\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use maze\Topic;
use maze\User;
use Mail;

class EmailNews extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'email:news';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:news {topic_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email news for given topic.';

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
    public function fire()
    {
        $topic = Topic::findOrFail($this->argument('topic_id'));
        
        $users = User::where('email_news', 1)->chunk(200, function($users) use($topic) {
            $data = [
                'title' => $topic->title,
                'body'  => $topic->body
            ];

            foreach($users as $user)
            {
                Mail::queue('emails.news', $data, function($message) use($user, $topic)
                {
                    $message->to($user->email)->subject('Maze Naujienos: '.utf8_urldecode($topic->title));
                });
            }
        });
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return ['topic_id'];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
        ];
    }

}
