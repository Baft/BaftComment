<?php

namespace BaftComment\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BaftcommentAuthorMessage
 *
 * @ORM\Table(name="baftcomment__author__message")
 * @ORM\Entity
 */
class BaftcommentAuthorMessage {
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 *
	 * @var integer @ORM\Column(name="ref__message__id", type="integer", nullable=true)
	 */
	private $refMessageId;
	
	/**
	 *
	 * @var integer @ORM\Column(name="ref__author__id", type="integer", nullable=true)
	 */
	private $refAuthorId;

	
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
	 * @return BaftcommentAuthorMessage
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
	 * @return BaftcommentAuthorMessage
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


}

