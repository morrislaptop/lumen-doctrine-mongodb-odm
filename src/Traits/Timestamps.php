<?php namespace Nord\Lumen\Doctrine\ODM\MongoDB\Traits;

use Doctrine\ODM\MongoDB\Mapping AS ORM;
use Jenssegers\Date\Date;
use JMS\Serializer\Annotation as DTO;

trait Timestamps
{

    /**
     * @DTO\Expose
     * @DTO\Type("integer")
     * @DTO\Accessor(getter="getCreatedAtTimestamp")
     * @DTO\SerializedName("created_at")
     * @DTO\ReadOnly
     *
     * @ODM\MongoDB\Column(type="datetime", name="created_at")
     *
     * @var Date
     */
    private $createdAt;

    /**
     * @DTO\Expose
     * @DTO\Type("integer")
     * @DTO\Accessor(getter="getUpdatedAtTimestamp")
     * @DTO\SerializedName("updated_at")
     * @DTO\ReadOnly
     *
     * @ODM\MongoDB\Column(type="datetime", name="updated_at", nullable=true)
     *
     * @var Date
     */
    private $updatedAt;


    /**
     * @ODM\MongoDB\PrePersist
     */
    public function prePersist()
    {
        $this->createdAt = Date::now();
    }


    /**
     * @ODM\MongoDB\PreUpdate
     */
    public function preUpdate()
    {
        $this->updatedAt = Date::now();
    }


    /**
     * @return Date
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * @return Date
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


    /**
     *
     *
     * @return int
     */
    public function getCreatedAtTimestamp()
    {
        return $this->createdAt->getTimestamp();
    }


    /**
     * @return int|null
     */
    public function getUpdatedAtTimestamp()
    {
        return $this->updatedAt instanceof Date ? $this->updatedAt->getTimestamp() : null;
    }
}
