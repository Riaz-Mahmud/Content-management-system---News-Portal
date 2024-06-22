<?php

namespace App\Jobs;

use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Backdoor\WebsiteBackup\WebsiteBackup;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Support\Facades\Log;

class WebsiteBackupJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {

            $news = News::find($this->data['id']);
            if (!$news || $news->source_backup == 'done') {
                return;
            }
            $news->update([
                'source_backup' => 'processing'
            ]);

            $path = 'public/storage/assets/news/'.$this->data['id'] . '/backup';
            $filePath = 'storage/assets/news/'.$this->data['id'] . '/backup';
            // 'path' => 'public/storage/websitebackup/site'.$randomInt,
            // 'filePath' => 'storage/websitebackup/site'.$randomInt,

            $websiteBackup = new WebsiteBackup();
            $response = $websiteBackup->backup($this->data['url'], $path, $filePath);

            if (!$response['error']) {
                $news->update([
                    'source_backup' => 'done'
                ]);
            } else {
                $news->update([
                    'source_backup' => 'failed'
                ]);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
