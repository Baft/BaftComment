<?php

namespace BaftComment\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * BaftcommentMessage
 *
 * @ORM\Table(name="baftcomment__message", uniqueConstraints={@ORM\UniqueConstraint(name="author_email", columns={"author_email"})}, indexes={@ORM\Index(name="ref__comment__id", columns={"ref__comment__id"})})
 * @ORM\Entity(repositoryClass="BaftComment\Model\MessageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class BaftcommentMessage {
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 *
	 * @var integer @ORM\Column(name="post_time", type="bigint", nullable=false )
	 */
	private $postTime;
	
	/**
	 *
	 * @var string @ORM\Column(name="author", type="string", length=255, nullable=true)
	 */
	private $author;
	
	/**
	 *
	 * @var string @ORM\Column(name="author_email", type="string", length=255, nullable=true)
	 */
	private $authorEmail;
	
	/**
	 *
	 * @var string @ORM\Column(name="author_name", type="string", length=50, nullable=true)
	 */
	private $authorName;
	
	/**
	 *
	 * @var integer @ORM\Column(name="parent_message_id", type="integer", nullable=true , options={"default":0})
	 */
	private $parentMessageId;
	
	/**
	 *
	 * @var string @ORM\Column(name="message_subject", type="string", length=255, nullable=true)
	 */
	private $messageSubject;
	
	/**
	 *
	 * @var string @ORM\Column(name="content", type="text", length=65535, nullable=false)
	 */
	private $content;
	
	/**
	 *
	 * @var integer @ORM\Column(name="deleted", type="integer", nullable=true , options={"default":0})
	 */
	private $deleted;
	
	/**
	 *
	 * @var integer @ORM\Column(name="spam", type="integer", nullable=true , options={"default":0})
	 */
	private $spam;
	
	/**
	 *
	 * @var integer @ORM\Column(name="score_plus", type="integer", nullable=true , options={"default":0})
	 */
	private $scorePlus;
	
	/**
	 *
	 * @var integer @ORM\Column(name="score_minus", type="integer", nullable=true , options={"default":0})
	 */
	private $scoreMinus;
	
	/**
	 *
	 * @var integer @ORM\Column(name="approved", type="integer", nullable=true , options={"default":1})
	 */
	private $approved;
	
	/**
	 *
	 * @var \BaftComment\Entity\BaftcommentComment @ORM\ManyToOne(targetEntity="BaftComment\Entity\BaftcommentComment")
	 *      @ORM\JoinColumns({
	 *      @ORM\JoinColumn(name="ref__comment__id", referencedColumnName="id")
	 *      })
	 */
	private $refComment;
	
	/**
	 *
	 * @var ArrayCollection @ORM\OneToMany(targetEntity="BaftComment\Entity\BaftcommentMessageRevision", mappedBy="refMessage" , fetch="EXTRA_LAZY")
	 *      @ORM\OrderBy({"revisionTime" = "ASC"})
	 */
	private $revisions;

	public function __construct() {

		$this->revisions = new ArrayCollection ();
	
	}

	public function toArray() {

		return (new ClassMethods ())->extract ( $this );
	
	}

	
	/**
	 * @ORM\PrePersist
	 */
	public function setDefaultUnixtimeOnPrePersist() {

		$this->postTime = (empty ( $this->postTime )) ? time () : $this->postTime;
	
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
	 * Set postTime
	 *
	 * @param integer $postTime        	
	 *
	 * @return BaftcommentMessage
	 */
	public function setPostTime($postTime) {

		$this->postTime = $postTime;
		
		return $this;
	
	}

	/**
	 * Get postTime
	 *
	 * @return integer
	 */
	public function getPostTime() {

		return $this->postTime;
	
	}

	/**
	 * Set author
	 *
	 * @param string $author        	
	 *
	 * @return BaftcommentMessage
	 */
	public function setAuthor($author) {

		$this->author = $author;
		
		return $this;
	
	}

	/**
	 * Get author
	 *
	 * @return string
	 */
	public function getAuthor() {

		return $this->author;
	
	}

	/**
	 * Set authorEmail
	 *
	 * @param string $authorEmail        	
	 *
	 * @return BaftcommentMessage
	 */
	public function setAuthorEmail($authorEmail) {

		$this->authorEmail = $authorEmail;
		
		return $this;
	
	}

	/**
	 * Get authorEmail
	 *
	 * @return string
	 */
	public function getAuthorEmail() {

		return $this->authorEmail;
	
	}

	/**
	 * Set authorName
	 *
	 * @param string $authorName        	
	 *
	 * @return BaftcommentMessage
	 */
	public function setAuthorName($authorName) {

		$this->authorName = $authorName;
		
		return $this;
	
	}

	/**
	 * Get authorName
	 *
	 * @return string
	 */
	public function getAuthorName() {

		return $this->authorName;
	
	}

	/**
	 * Set parentMessageId
	 *
	 * @param integer $parentMessageId        	
	 *
	 * @return BaftcommentMessage
	 */
	public function setParentMessageId($parentMessageId) {

		$this->parentMessageId = $parentMessageId;
		
		return $this;
	
	}

	/**
	 * Get parentMessageId
	 *
	 * @return integer
	 */
	public function getParentMessageId() {

		return $this->parentMessageId;
	
	}

	/**
	 * Set messageSubject
	 *
	 * @param string $messageSubject        	
	 *
	 * @return BaftcommentMessage
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
	 * Set content
	 *
	 * @param string $content        	
	 *
	 * @return BaftcommentMessage
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
	 * Set deleted
	 *
	 * @param integer $deleted        	
	 *
	 * @return BaftcommentMessage
	 */
	public function setDeleted($deleted) {

		$this->deleted = $deleted;
		
		return $this;
	
	}

	/**
	 * Get deleted
	 *
	 * @return integer
	 */
	public function getDeleted() {

		return $this->deleted;
	
	}

	/**
	 * Set spam
	 *
	 * @param integer $spam        	
	 *
	 * @return BaftcommentMessage
	 */
	public function setSpam($spam) {

		$this->spam = $spam;
		
		return $this;
	
	}

	/**
	 * Get spam
	 *
	 * @return integer
	 */
	public function getSpam() {

		return $this->spam;
	
	}

	/**
	 * Set refComment
	 *
	 * @param \BaftComment\Entity\BaftcommentComment $refComment        	
	 *
	 * @return BaftcommentMessage
	 */
	public function setRefComment(\BaftComment\Entity\BaftcommentComment $refComment = null) {

		$this->refComment = $refComment;
		
		return $this;
	
	}

	/**
	 * Get refComment
	 *
	 * @return \BaftComment\Entity\BaftcommentComment
	 */
	public function getRefComment() {

		return $this->refComment;
	
	}

	/**
	 * Set scorePlus
	 *
	 * @param integer $scorePlus        	
	 *
	 * @return BaftcommentMessage
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
	 * @return BaftcommentMessage
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

	/**
	 * Set approved
	 *
	 * @param integer $approved        	
	 *
	 * @return BaftcommentMessage
	 */
	public function setApproved($approved) {

		$this->approved = $approved;
		
		return $this;
	
	}

	/**
	 * Get approved
	 *
	 * @return integer
	 */
	public function getApproved() {

		return $this->approved;
	
	}


}

