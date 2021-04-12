<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payments
 *
 * @ORM\Table(name="payments", indexes={@ORM\Index(name="fk_pan_pay", columns={"ID_Panier"})})
 * @ORM\Entity
 */
class Payments
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Payment", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPayment;

    /**
     * @var float|null
     *
     * @ORM\Column(name="Prix_F", type="float", precision=10, scale=0, nullable=true)
     */
    private $prixF;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Mode_payment", type="string", length=10, nullable=true)
     */
    private $modePayment;

    /**
     * @var \Paniers
     *
     * @ORM\ManyToOne(targetEntity="Paniers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_Panier", referencedColumnName="ID_Panier")
     * })
     */
    private $idPanier;


}
