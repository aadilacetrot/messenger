<?php

namespace Messenger\Jobs;

use Messenger\Wrapper;
use Messenger\Template;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class NotifyViaSms implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	protected $userOrNumber;
	protected $type;
	public function __construct($userOrNumber, $type)
	{
		$this->userOrNumber = $userOrNumber;
		$this->type = $type;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		if ($this->userOrNumber instanceof User) {
			$this->userOrNumber->{$this->type}();
		} else {
			$this->sendOtp();
		}
	}

	protected function sendOtp(): void
	{
		Wrapper::sendOTP([
			'mobile' => config('msg91.country') . $this->userOrNumber,
			'message' => Lang::get(config('msg91.map')[Template::SEND_OTP]),
			'template_id' => Template::SEND_OTP
		]);
	}
}
