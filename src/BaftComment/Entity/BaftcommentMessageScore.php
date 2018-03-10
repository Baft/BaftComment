<?php

namespace BaftComment\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BaftcommentMessageScore
 *
 * @ORM\Table(name="baftcomment__message_score")
 * @ORM\Entity
 */
class BaftcommentMessageScore {
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 *
	 * @var integer @ORM\Column(name="ref__message__id", type="integer", nullable=false)
	 */
	private $refMessageId;
	
	/**
	 *
	 * @var integer @ORM\Column(name="ref__author__id", type="integer", nullable=false)
	 */
	private $refAuthorId;
	
	/**
	 *
	 * @var integer @ORM\Column(name="client_ip", type="integer", nullable=false)
	 */
	private $clientIp;
	
	/**
	 *
	 * @var integer @ORM\Column(name="score_plus", type="integer", nullable=true)
	 */
	private $scorePlus;
	
	/**
	 *
	 * @var integer @ORM\Column(name="score_minus", type="integer", nullable=true)
	 */
	private $scoreMinus;

	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {

		return $this->id;
	
	}

	/**
	 * Set refMessageId
	 *
	 * @param integer $refMessageId        	
	 *
	 * @return BaftcommentMessageScore
	 */
	public function setRefMessageId($refMessageId) {

		$this->refMessageId = $refMessageId;
		
		return $this;
	
	}

	/**
	 * Get refMessageId
	 *
	 * @return integer
	 */
	public function getRefMessageId() {

		return $this->refMessageId;
	
	}

	/**
	 * Set refAuthorId
	 *
	 * @param integer $refAuthorId        	
	 *
	 * @return BaftcommentMessageScore
	 */
	public function setRefAuthorId($refAuthorId) {

		$this->refAuthorId = $refAuthorId;
		
		return $this;
	
	}

	/**
	 * Get refAuthorId
	 *
	 * @return integer
	 */
	public function getRefAuthorId() {

		return $this->refAuthorId;
	
	}

	/**
	 * Set clientIp
	 *
	 * @param integer $clientIp        	
	 *
	 * @return BaftcommentMessageScore
	 */
	public function setClientIp($clientIp) {

		$this->clientIp = $clientIp;
		
		return $this;
	
	}

	/**
	 * Get clientIp
	 *
	 * @return integer
	 */
	public function getClientIp() {

		return $this->clientIp;
	
	}

	/**
	 * Set scorePlus
	 *
	 * @param integer $scorePlus        	
	 *
	 * @return BaftcommentMessageScore
	 */
	public function setScorePlus($scorePlus) {

		$this->scorePlus = $scorePlus;
		
		return $this;
	
	}

	/**
	 * Get scorePlus
	 *
	 * @return integer
	 */
	public function getScorePlus() {

		return $this->scorePlus;
	
	}

	/**
	 * Set scoreMinus
	 *
	 * @param integer $scoreMinus        	
	 *
	 * @return BaftcommentMessageScore
	 */
	public function setScoreMinus($scoreMinus) {

		$this->scoreMinus = $scoreMinus;
		
		return $this;
	
	}

	/**
	 * Get scoreMinus
	 *
	 * @return integer
	 */
	public function getScoreMinus() {

		return $this->scoreMinus;
	
	}


}

