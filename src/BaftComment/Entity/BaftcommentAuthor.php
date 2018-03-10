<?php

namespace BaftComment\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BaftcommentAuthor
 *
 * @ORM\Table(name="baftcomment__author")
 * @ORM\Entity
 */
class BaftcommentAuthor {
	/**
	 *
	 * @var integer @ORM\Column(name="id", type="integer", nullable=false)
	 *      @ORM\Id
	 *      @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	private $id;
	
	/**
	 *
	 * @var string @ORM\Column(name="author_name", type="string", length=255, nullable=true)
	 */
	private $authorName;
	
	/**
	 *
	 * @var string @ORM\Column(name="author_email", type="string", length=255, nullable=true)
	 */
	private $authorEmail;
	
	/**
	 *
	 * @var string @ORM\Column(name="ref_author", type="string", length=255, nullable=true)
	 */
	private $refAuthor;

	
	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {

		return $this->id;
	
	}

	/**
	 * Set authorName
	 *
	 * @param string $authorName        	
	 *
	 * @return BaftcommentAuthor
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
	 * Set authorEmail
	 *
	 * @param string $authorEmail        	
	 *
	 * @return BaftcommentAuthor
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
	 * Set refAuthor
	 *
	 * @param string $refAuthor        	
	 *
	 * @return BaftcommentAuthor
	 */
	public function setRefAuthor($refAuthor) {

		$this->refAuthor = $refAuthor;
		
		return $this;
	
	}

	/**
	 * Get refAuthor
	 *
	 * @return string
	 */
	public function getRefAuthor() {

		return $this->refAuthor;
	
	}


}

