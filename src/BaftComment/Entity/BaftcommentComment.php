<?php

namespace BaftComment\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * BaftcommentComment
 *
 * @ORM\Table(name="baftcomment__comment")
 * @ORM\Entity(repositoryClass="BaftComment\Model\CommentRepository")
 */
class BaftcommentComment {
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 *
	 * @var string @ORM\Column(name="slug", type="string", length=1000, nullable=false)
	 */
	private $slug;
	
	/**
	 *
	 * @var string @ORM\Column(name="discuss_subject", type="string", length=1000, nullable=false)
	 */
	private $discussSubject;
	
	/**
	 *
	 * @var integer @ORM\Column(name="active", type="integer", nullable=true)
	 */
	private $active;
	
	/**
	 *
	 * @var ArrayCollection @ORM\OneToMany(targetEntity="BaftComment\Entity\BaftcommentMessage", mappedBy="refComment" , fetch="EXTRA_LAZY")
	 *      @ORM\OrderBy({"postTime" = "ASC"})
	 */
	private $messages;

	public function __construct() {

		$this->messages = new ArrayCollection ();
	
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
	 * Set discussSubject
	 *
	 * @param string $discussSubject        	
	 *
	 * @return BaftcommentComment
	 */
	public function setDiscussSubject($discussSubject) {

		$this->discussSubject = $discussSubject;
		
		return $this;
	
	}

	/**
	 * Get discussSubject
	 *
	 * @return string
	 */
	public function getDiscussSubject() {

		return $this->discussSubject;
	
	}

	/**
	 * Set active
	 *
	 * @param integer $active        	
	 *
	 * @return BaftcommentComment
	 */
	public function setActive($active) {

		$this->active = $active;
		
		return $this;
	
	}

	/**
	 * Get active
	 *
	 * @return integer
	 */
	public function getActive() {

		return $this->active;
	
	}

	/**
	 *
	 * @return ArrayCollection
	 */
	public function getMessages() {

		return $this->messages;
	
	}

	/**
	 *
	 * @param ArrayCollection $messages        	
	 */
	public function setMessages($messages) {

		$this->messages = $messages;
		return $this;
	
	}

	/**
	 *
	 * @return the string
	 */
	public function getSlug() {

		return $this->slug;
	
	}

	/**
	 *
	 * @param string $slug        	
	 */
	public function setSlug($slug) {

		$this->slug = $slug;
		return $this;
	
	}


}

