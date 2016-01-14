<?php

/**
 * Class User
 *
 * @property int $autoId;
 * @property string $id;
 * @property string $accountEmail;
 * @property string $accountPassword;
 * @property string $accountType;
 * @property bool $isActive;
 * @property \Carbon\Carbon $registerDate;
 * @property string $internalReferer;
 * @property string $externalReferer;
 * @property string $campaign;
 * @property string $dataLead;
 * @property bool $isSubscribedMessages;
 */
class User extends \MadLab\Cornerstone\BedRock
{
	const ACCOUNT_TYPE_INTRANET = 'intranet';
	const ACCOUNT_TYPE_LEAD = 'lead';
	const ACCOUNT_TYPE_RECRUITER = 'recruiter';

	protected $table = 'accounts';
	protected $primary = 'autoId';
	protected $fields = [
		'autoId' =>'int',
		'id' => 'int',
		'accountEmail' => 'string',
		'accountPassword' => 'string',
		'accountType' => [User::ACCOUNT_TYPE_INTRANET, User::ACCOUNT_TYPE_LEAD, User::ACCOUNT_TYPE_RECRUITER],
		'isActive'=> 'bool',
		'registerDate' => 'date',
		'internalReferer' => 'string',
		'externalReferer' => 'string',
		'campaign' => 'string',
		'dataLead' => 'string',
		'isSubscribedMessages' => 'bool'
	];


	/**
	 * @return User[]
	 * @throws Exception
	 */
	function getActive() : array
	{

		$r = $this->query('select * from accounts where isActive = 0')->getMany();
		return $r;
	}
}
