<?php

namespace Messenger\Traits;

use Messenger\Jobs\NotifyViaSms;
use Messenger\Wrapper;
use Messenger\Template;
use Illuminate\Support\Facades\Lang;

trait SubscriptionNotifiable
{
	public function expiry_reminder()
	{
		return $this->sms(Template::EXPIRY_REMINDER);
	}

	public function expired()
	{
		return $this->sms(Template::EXPIRED);
	}

	public function auto_renew_reminder()
	{
		return $this->sms(Template::AUTO_RENEW_REMINDER);
	}

	public function renewed(): array
	{
		return $this->sms(Template::RENEWED);
	}

	public function activated()
	{
		return $this->sms(Template::ACTIVATED);
	}

	public function failed(): array
	{
		return $this->sms(Template::FAILED);
	}

	/**
	 * @param string $type snake_case
	 * @return void
	 */
	public function alert(string $type) : void
	{
		NotifyViaSms::dispatch($this, $type)->afterCommit();
	}

	protected function getMessage($code)
	{
		$map = config('msg91.map');

		return Lang::get($map[$code], ['Name' => $this->first_name]);
	}

	protected function sms($msgCode, $days = 6)
	{
		return Wrapper::sms([
			"mobile" => config('msg91.country') . $this->phone,
			'flow_id' => $msgCode,
			'days' => $days,
		]);
	}

	public function send_otp(): array
	{
		return Wrapper::sendOTP([
			'mobile' => config('msg91.country') . $this->phone,
			"message" => $this->getMessage(Template::SEND_OTP),
			"template_id" => Template::SEND_OTP,
		]);
	}
}
