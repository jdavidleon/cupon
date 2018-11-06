<?php

namespace SalesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UpgradeStatus
 *
 * @ORM\Table(name="sales_upgrade_status")
 * @ORM\Entity(repositoryClass="SalesBundle\Repository\SalesUpgradeStatusRepository")
 */
class SalesUpgradeStatus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="command_executed_at", type="datetime", nullable=true)
     */
    private $commandExecutedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="validated", type="boolean")
     */
    private $validated;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return SalesUpgradeStatus
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set commandExecutedAt
     *
     * @param \DateTime $commandExecutedAt
     *
     * @return SalesUpgradeStatus
     */
    public function setCommandExecutedAt($commandExecutedAt)
    {
        $this->commandExecutedAt = $commandExecutedAt;

        return $this;
    }

    /**
     * Get commandExecutedAt
     *
     * @return \DateTime
     */
    public function getCommandExecutedAt()
    {
        return $this->commandExecutedAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SalesUpgradeStatus
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set validated
     *
     * @param boolean $validated
     *
     * @return SalesUpgradeStatus
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;

        return $this;
    }

    /**
     * Get validated
     *
     * @return bool
     */
    public function getValidated()
    {
        return $this->validated;
    }
}

