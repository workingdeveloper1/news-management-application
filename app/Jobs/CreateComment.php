<?php

namespace App\Jobs;

use App\Repositories\CommentRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $commentRepository;
    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CommentRepositoryInterface $commentRepository, array $data)
    {
        $this->commentRepository = $commentRepository;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->commentRepository->store($this->data);
    }
}
