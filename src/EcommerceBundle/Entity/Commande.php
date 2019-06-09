<?php

namespace EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="EcommerceBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_commande", type="datetime")
     */
    private $dateCommande;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=255)
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_carte", type="string", length=255)
     */
    private $nomCarte;

    /**
     * @var string
     *
     * @ORM\Column(name="num_carte", type="string", length=255)
     */
    private $numCarte;

    /**
     * @var string
     *
     * @ORM\Column(name="mois_exp", type="string", length=255)
     */
    private $moisExp;

    /**
     * @var string
     *
     * @ORM\Column(name="annee_exp", type="string", length=255)
     */
    private $anneeExp;

    /**
     * @var string
     *
     * @ORM\Column(name="ccv", type="string", length=255)
     */
    private $ccv;

     /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="commandes")
     * @ORM\JoinColumn(name="user",referencedColumnName="id")
     */
    private $user;


      /**
     * @var string
     *
     * @ORM\Column(name="statu_livraison", type="string", length=255)
     */
    private $statutLivraison;

      /**
     * @var string
     *
     * @ORM\Column(name="statut_paiement", type="string", length=255)
     */
    private $StatutPaiement;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

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
     * Set dateCommande
     *
     * @param \DateTime $dateCommande
     *
     * @return Commande
     */
    public function setDateCommande($dateCommande)
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    /**
     * Get dateCommande
     *
     * @return \DateTime
     */
    public function getDateCommande()
    {
        return $this->dateCommande;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Commande
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Commande
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Commande
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Commande
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
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Commande
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set nomCarte
     *
     * @param string $nomCarte
     *
     * @return Commande
     */
    public function setNomCarte($nomCarte)
    {
        $this->nomCarte = $nomCarte;

        return $this;
    }

    /**
     * Get nomCarte
     *
     * @return string
     */
    public function getNomCarte()
    {
        return $this->nomCarte;
    }

    /**
     * Set numCarte
     *
     * @param string $numCarte
     *
     * @return Commande
     */
    public function setNumCarte($numCarte)
    {
        $this->numCarte = $numCarte;

        return $this;
    }

    /**
     * Get numCarte
     *
     * @return string
     */
    public function getNumCarte()
    {
        return $this->numCarte;
    }

    /**
     * Set moisExp
     *
     * @param string $moisExp
     *
     * @return Commande
     */
    public function setMoisExp($moisExp)
    {
        $this->moisExp = $moisExp;

        return $this;
    }

    /**
     * Get moisExp
     *
     * @return string
     */
    public function getMoisExp()
    {
        return $this->moisExp;
    }

    /**
     * Set anneeExp
     *
     * @param string $anneeExp
     *
     * @return Commande
     */
    public function setAnneeExp($anneeExp)
    {
        $this->anneeExp = $anneeExp;

        return $this;
    }

    /**
     * Get anneeExp
     *
     * @return string
     */
    public function getAnneeExp()
    {
        return $this->anneeExp;
    }

    /**
     * Set ccv
     *
     * @param string $ccv
     *
     * @return Commande
     */
    public function setCcv($ccv)
    {
        $this->ccv = $ccv;

        return $this;
    }

    /**
     * Get ccv
     *
     * @return string
     */
    public function getCcv()
    {
        return $this->ccv;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Commande
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set statutLivraison
     *
     * @param string $statutLivraison
     *
     * @return Commande
     */
    public function setStatutLivraison($statutLivraison)
    {
        $this->statutLivraison = $statutLivraison;

        return $this;
    }

    /**
     * Get statutLivraison
     *
     * @return string
     */
    public function getStatutLivraison()
    {
        return $this->statutLivraison;
    }

    /**
     * Set statutPaiement
     *
     * @param string $statutPaiement
     *
     * @return Commande
     */
    public function setStatutPaiement($statutPaiement)
    {
        $this->StatutPaiement = $statutPaiement;

        return $this;
    }

    /**
     * Get statutPaiement
     *
     * @return string
     */
    public function getStatutPaiement()
    {
        return $this->StatutPaiement;
    }

    /**
     * Set total
     *
     * @param float $total
     *
     * @return Commande
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }
}
