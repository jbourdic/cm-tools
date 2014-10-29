<?php
/**
 * Created by PhpStorm.
 * User: Narcoflik
 * Date: 26/10/14
 * Time: 21:04
 */

namespace JB\PlannedBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="JB\PlannedBundle\Entity\PlannedTweetsRepository")
 * @ORM\Table(name="planned_tweets")
 */
class PlannedTweets {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $idSender;

    /**
     * @ORM\Column(type="string", length=140)
     */
    protected $message;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    protected $image;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $imageType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $imageLength;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $imageWidth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $imageHeight;

     /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $receiver;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $sendingDate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $status;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idSender
     *
     * @param integer $idSender
     * @return PlannedTweets
     */
    public function setIdSender($idSender)
    {
        $this->idSender = $idSender;
    
        return $this;
    }

    /**
     * Get idSender
     *
     * @return integer 
     */
    public function getIdSender()
    {
        return $this->idSender;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return PlannedTweets
     */
    public function setMessage($message)
    {
        if (strlen($message) <= 140) {
            $this->message = $message;
            return $this;
        } else {
            return false;
        }
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return PlannedTweets
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set imageType
     *
     * @param string $imageType
     * @return PlannedTweets
     */
    public function setImageType($imageType)
    {
        $this->imageType = $imageType;
    
        return $this;
    }

    /**
     * Get imageType
     *
     * @return string 
     */
    public function getImageType()
    {
        return $this->imageType;
    }

    /**
     * Set imageLength
     *
     * @param \integer $imageLength
     * @return PlannedTweets
     */
    public function setImageLength(\int $imageLength)
    {
        $this->imageLength = $imageLength;
    
        return $this;
    }

    /**
     * Get imageLength
     *
     * @return \integer
     */
    public function getImageLength()
    {
        return $this->imageLength;
    }

    /**
     * Set imageWidth
     *
     * @param \integer $imageWidth
     * @return PlannedTweets
     */
    public function setImageWidth(\int $imageWidth)
    {
        $this->imageWidth = $imageWidth;
    
        return $this;
    }

    /**
     * Get imageWidth
     *
     * @return \integer
     */
    public function getImageWidth()
    {
        return $this->imageWidth;
    }

    /**
     * Set imageHeight
     *
     * @param \int $imageHeight
     * @return PlannedTweets
     */
    public function setImageHeight(\int $imageHeight)
    {
        $this->imageHeight = $imageHeight;
    
        return $this;
    }

    /**
     * Get imageHeight
     *
     * @return \integer
     */
    public function getImageHeight()
    {
        return $this->imageHeight;
    }

    /**
     * Set receiver
     *
     * @param string $receiver
     * @return PlannedTweets
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
    
        return $this;
    }

    /**
     * Get receiver
     *
     * @return string 
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set sendingDate
     *
     * @param \DateTime $sendingDate
     * @return PlannedTweets
     */
    public function setSendingDate($sendingDate)
    {
        $this->sendingDate = $sendingDate;
    
        return $this;
    }

    /**
     * Get sendingDate
     *
     * @return \DateTime 
     */
    public function getSendingDate()
    {
        return $this->sendingDate;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return PlannedTweets
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
}