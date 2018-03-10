<?php

namespace BaftComment\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * BaftcommentMessageRevision
 *
 * @ORM\Table(name="baftcomment__message_revision", indexes={@ORM\Index(name="ref__message__id", columns={"ref__message__id"})})
 * @ORM\Entity
 */
class BaftcommentMessageRevision {
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 *
	 * @var string @ORM\Column(name="content", type="text", length=65535, nullable=false)
	 */
	private $content;
	
	/**
	 *
	 * @var string @ORM\Column(name="message_subject", type="string", length=255, nullable=true)
	 */
	private $messageSubject;
	
	/**
	 *
	 * @var integer @ORM\Column(name="revision_time", type="bigint", nullable=false)
	 */
	private $revisionTime;
	
	/**
	 *
	 * @var \BaftComment\Entity\BaftcommentMessage @ORM\ManyToOne(targetEntity="BaftComment\Entity\BaftcommentMessage")
	 *      @ORM\JoinColumns({
	 *      @ORM\JoinColumn(name="ref__message__id", referencedColumnName="id")
	 *      })
	 */
	private $refMessage;
	
	/**
	 *
	 * @var integer @ORM\Column(name="ref__author__id", type="integer", nullable=true)
	 */
	private $refAuthorId;

	public function toArray() {

		return (new ClassMethods ())->extract ( $this );
	
	}

	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {

		return $this->id;
	
	}

	/**
	 * Set content
	 *
	 * @param string $content        	
	 *
	 * @return BaftcommentMessageRevision
	 */
	public function setContent($content) {

		$this->content = $content;
		
		return $this;
	
	}

	/**
	 * Get content
	 *
	 * @return string
	 */
	public function getContent() {

		return $this->content;
	
	}

	/**
	 * Set messageSubject
	 *
	 * @param string $messageSubject        	
	 *
	 * @return BaftcommentMessageRevision
	 */
	public function setMessageSubject($messageSubject) {

		$this->messageSubject = $messageSubject;
		
		return $this;
	
	}

	/**
	 * Get messageSubject
	 *
	 * @return string
	 */
	public function getMessageSubject() {

		return $this->messageSubject;
	
	}

	/**
	 * Set revisionTime
	 *
	 * @param integer $revisionTime        	
	 *
	 * @return BaftcommentMessageRevision
	 */
	public function setRevisionTime($revisionTime) {

		$this->revisionTime = $revisionTime;
		
		return $this;
	
	}

	/**
	 * Get revisionTime
	 *
	 * @return integer
	 */
	public function getRevisionTime() {

		return $this->revisionTime;
	
	}

	/**
	 * Set refMessage
	 *
	 * @param \BaftComment\Entity\BaftcommentMessage $refMessage        	
	 *
	 * @return BaftcommentMessageRevision
	 */
	public function setRefMessage(\BaftComment\Entity\BaftcommentMessage $refMessage = null) {

		$this->refMessage = $refMessage;
		
		return $this;
	
	}

	/**
	 * Get refMessage
	 *
	 * @return \BaftComment\Entity\BaftcommentMessage
	 */
	public function getRefMessage() {

		return $this->refMessage;
	
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

