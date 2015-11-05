<?php

/**
 * Volunteer is a small user attached to a receiving organization. They do not have access to the organization profile
 * They receive notifications about donations and have the ability to claim donations and pickup donations. They are managed
 * by the admin of the organization they're associated with.
 *
 * @author Kimberly Keller <kimberly@gravitaspublications.com>
 **/

class Volunteer {
	/**
	 * id for this Volunteer; this is the primary key
	 * @var int $volId
	 **/
	private $volId;
	/**
	 * id of the Organization that this Volunteer is associated with; this is a foreign key
	 * @var int $orgId
	 **/
	private $orgId;
	/**
	 * email the Volunteer is associated with
	 * @var string $volEmail
	 **/
	private $volEmail;
	/**
	 * activation key for Volunteer email, null if email confirmed
	 * @var int $volEmailActivation
	 **/
	private $volEmailActivation;
	/**
	 * first name of Volunteer
	 * @var string $volFirstName
	 **/
	private $volFirstName;
	/**
	 * last name of Volunteer
	 * @var string $volLastName
	 **/
	private $volLastName;
	/**
	 * phone number for Volunteer
	 * @var string $volPhone
	 **/
	private $volPhone;

	/**
	 * constructor for this Volunteer
	 *
	 * @param mixed $newVolId id of this Volunteer or null if new Volunteer
	 * @param int $newOrgId id of the Organization that is associated with this Volunteer
	 * @param string $newVolEmail email of the Volunteer
	 * @param int $newVolEmailActivation activation key for Volunteer email, null if email confirmed
	 * @param string $newVolFirstName string containing first name of the Volunteer
	 * @param string $newVolLastName string containing last name of the Volunteer
	 * @param string $newVolPhone string containing the US phone number associated with the Volunteer
	 **/
	public function __construct($newVolId, $newOrgId, $newVolEmail, $newVolEmailActivation, $newVolFirstName, $newVolLastName, $newVolPhone) {
		try {
			$this->setVolId($newVolId);
			$this->setOrgId($newOrgId);
			$this->setVolEmail($newVolEmail);
			$this->setVolEmailActivation($newVolEmailActivation);
			$this->setVolFirstName($newVolFirstName);
			$this->setVolLastName($newVolLastName);
			$this->setVolPhone($newVolPhone);
		} catch(InvalidArgumentException $invalidArugument) {
			//rethrow the exception to the caller
			throw(new InvalidArgumentException($invalidArugument->getMessage(),0, $invalidArugument));
		} catch(RangeException $range) {
			//rethrow the exception to the caller
			throw(new RangeException($range->getMessage(), 0, $range));
		} catch(Exception $exception) {
			//rethrow generic exception
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for volunteer id
	 *
	 * @return mixed value for volunteer id
	 **/
	public function getVolId() {
		return($this->volId);
	}

	/**
	 * mutator method for volunteer id
	 *
	 * @param mixed $newVolId new value of volunteer id
	 * @throws InvalidArgumentException if $newVolId is not an integer
	 * @throws RangeException if $newVolId is not positive
	 **/
	public function setVolId($newVolId) {
		//base case: if the vol id is null, this is a new volunteer without a mySQL assigned id
		if($newVolId === null) {
			$this->volId = null;
			return;
		}


	}
}