<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 07/02/2017
 * Time: 14:46
 */
namespace MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Adresse
 * @ORM\Entity
 * @ORM\Table(name="adresse")
 * @package MediaBundle\Entity
 */
class Adresse
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $libelle;


    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $ville;

    /**
     * @ORM\ManyToOne(targetEntity="Personne", inversedBy="features")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
     private $personnes;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Adresse
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set personnes
     *
     * @param \MediaBundle\Entity\Personne $personnes
     *
     * @return Adresse
     */
    public function setPersonnes(\MediaBundle\Entity\Personne $personnes = null)
    {
        $this->personnes = $personnes;

        return $this;
    }

    /**
     * Get personnes
     *
     * @return \MediaBundle\Entity\Personne
     */
    public function getPersonnes()
    {
        return $this->personnes;
    }
}
