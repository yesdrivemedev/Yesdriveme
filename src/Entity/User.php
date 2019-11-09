<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields= {"email"},
 * message= "Email déjà utilisé"
 * )
 */
class User implements AdvancedUserInterface
{
    /**
     * @Assert\EqualTo(propertyPath="password",message="Les mots de passe entrés sont différents.")
     */
    public $confirm_password;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $confirmation;


    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8",minMessage="Le mot de passe doit contenir au moins 8 caractères.")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressedomicile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionclient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $offre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $admin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $exterieur;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $solde;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $noteclient;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $notedriver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categorieclient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $categoriedriver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateinsertion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateinsertiondriver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $datenaissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeclient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $societe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressesociete;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephonesociete;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typesociete;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $registrecommerce;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailsociete;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $isdriver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $siren;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $datepermis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typepermis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $disponible;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $confirmationdriver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comptestripe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $conduite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ponctualite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $attention;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $personneabord;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gradechauffeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressefacturation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $taillesociete;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $activitesociete;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombrevoiture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typevoiture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $gestionnaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailgestionnaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdressedomicile(): ?string
    {
        return $this->adressedomicile;
    }

    public function setAdressedomicile(?string $adressedomicile): self
    {
        $this->adressedomicile = $adressedomicile;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(?string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getDescriptionclient(): ?string
    {
        return $this->descriptionclient;
    }

    public function setDescriptionclient(?string $descriptionclient): self
    {
        $this->descriptionclient = $descriptionclient;

        return $this;
    }

    public function getOffre(): ?string
    {
        return $this->offre;
    }

    public function setOffre(?string $offre): self
    {
        $this->offre = $offre;

        return $this;
    }

    public function getAdmin(): ?string
    {
        return $this->admin;
    }

    public function setAdmin(?string $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    public function getExterieur(): ?string
    {
        return $this->exterieur;
    }

    public function setExterieur(?string $exterieur): self
    {
        $this->exterieur = $exterieur;

        return $this;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(?float $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getNoteclient(): ?int
    {
        return $this->noteclient;
    }

    public function setNoteclient(?int $noteclient): self
    {
        $this->noteclient = $noteclient;

        return $this;
    }

    public function getNotedriver(): ?int
    {
        return $this->notedriver;
    }

    public function setNotedriver(?int $notedriver): self
    {
        $this->notedriver = $notedriver;

        return $this;
    }

    public function getCategorieclient(): ?string
    {
        return $this->categorieclient;
    }

    public function setCategorieclient(?string $categorieclient): self
    {
        $this->categorieclient = $categorieclient;

        return $this;
    }

    public function getCategoriedriver(): ?string
    {
        return $this->categoriedriver;
    }

    public function setCategoriedriver(?string $categoriedriver): self
    {
        $this->categoriedriver = $categoriedriver;

        return $this;
    }

    public function getDateinsertion(): ?string
    {
        return $this->dateinsertion;
    }

    public function setDateinsertion(?string $dateinsertion): self
    {
        $this->dateinsertion = $dateinsertion;

        return $this;
    }

    public function getDateinsertiondriver(): ?string
    {
        return $this->dateinsertiondriver;
    }

    public function setDateinsertiondriver(?string $dateinsertiondriver): self
    {
        $this->dateinsertiondriver = $dateinsertiondriver;

        return $this;
    }

    public function getDatenaissance(): ?string
    {
        return $this->datenaissance;
    }

    public function setDatenaissance(?string $datenaissance): self
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    public function getTypeclient(): ?string
    {
        return $this->typeclient;
    }

    public function setTypeclient(?string $typeclient): self
    {
        $this->typeclient = $typeclient;

        return $this;
    }

    public function getSociete(): ?string
    {
        return $this->societe;
    }

    public function setSociete(?string $societe): self
    {
        $this->societe = $societe;

        return $this;
    }

    public function getAdressesociete(): ?string
    {
        return $this->adressesociete;
    }

    public function setAdressesociete(?string $adressesociete): self
    {
        $this->adressesociete = $adressesociete;

        return $this;
    }

    public function getTelephonesociete(): ?string
    {
        return $this->telephonesociete;
    }

    public function setTelephonesociete(?string $telephonesociete): self
    {
        $this->telephonesociete = $telephonesociete;

        return $this;
    }

    public function getTypesociete(): ?string
    {
        return $this->typesociete;
    }

    public function setTypesociete(?string $typesociete): self
    {
        $this->typesociete = $typesociete;

        return $this;
    }

    public function getRegistrecommerce(): ?string
    {
        return $this->registrecommerce;
    }

    public function setRegistrecommerce(?string $registrecommerce): self
    {
        $this->registrecommerce = $registrecommerce;

        return $this;
    }

    public function getEmailsociete(): ?string
    {
        return $this->emailsociete;
    }

    public function setEmailsociete(?string $emailsociete): self
    {
        $this->emailsociete = $emailsociete;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(?string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(?string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getIsdriver(): ?string
    {
        return $this->isdriver;
    }

    public function setIsdriver(?string $isdriver): self
    {
        $this->isdriver = $isdriver;

        return $this;
    }

    public function getSiren(): ?string
    {
        return $this->siren;
    }

    public function setSiren(?string $siren): self
    {
        $this->siren = $siren;

        return $this;
    }

    public function getDatepermis(): ?string
    {
        return $this->datepermis;
    }

    public function setDatepermis(?string $datepermis): self
    {
        $this->datepermis = $datepermis;

        return $this;
    }

    public function getTypepermis(): ?string
    {
        return $this->typepermis;
    }

    public function setTypepermis(?string $typepermis): self
    {
        $this->typepermis = $typepermis;

        return $this;
    }

    public function getDisponible(): ?string
    {
        return $this->disponible;
    }

    public function setDisponible(?string $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getConfirmationdriver(): ?string
    {
        return $this->confirmationdriver;
    }

    public function setConfirmationdriver(?string $confirmationdriver): self
    {
        $this->confirmationdriver = $confirmationdriver;

        return $this;
    }

    public function getComptestripe(): ?string
    {
        return $this->comptestripe;
    }

    public function setComptestripe(?string $comptestripe): self
    {
        $this->comptestripe = $comptestripe;

        return $this;
    }

    public function getConduite(): ?string
    {
        return $this->conduite;
    }

    public function setConduite(?string $conduite): self
    {
        $this->conduite = $conduite;

        return $this;
    }

    public function getPonctualite(): ?string
    {
        return $this->ponctualite;
    }

    public function setPonctualite(?string $ponctualite): self
    {
        $this->ponctualite = $ponctualite;

        return $this;
    }

    public function getAttention(): ?string
    {
        return $this->attention;
    }

    public function setAttention(?string $attention): self
    {
        $this->attention = $attention;

        return $this;
    }

    public function getPersonneabord(): ?string
    {
        return $this->personneabord;
    }

    public function setPersonneabord(?string $personneabord): self
    {
        $this->personneabord = $personneabord;

        return $this;
    }

    public function getGradechauffeur(): ?string
    {
        return $this->gradechauffeur;
    }

    public function setGradechauffeur(?string $gradechauffeur): self
    {
        $this->gradechauffeur = $gradechauffeur;

        return $this;
    }

    public function getAdressefacturation(): ?string
    {
        return $this->adressefacturation;
    }

    public function setAdressefacturation(?string $adressefacturation): self
    {
        $this->adressefacturation = $adressefacturation;

        return $this;
    }

    public function getTaillesociete(): ?string
    {
        return $this->taillesociete;
    }

    public function setTaillesociete(?string $taillesociete): self
    {
        $this->taillesociete = $taillesociete;

        return $this;
    }

    public function getActivitesociete(): ?string
    {
        return $this->activitesociete;
    }

    public function setActivitesociete(?string $activitesociete): self
    {
        $this->activitesociete = $activitesociete;

        return $this;
    }

    public function getNombrevoiture(): ?int
    {
        return $this->nombrevoiture;
    }

    public function setNombrevoiture(?int $nombrevoiture): self
    {
        $this->nombrevoiture = $nombrevoiture;

        return $this;
    }

    public function getTypevoiture(): ?string
    {
        return $this->typevoiture;
    }

    public function setTypevoiture(?string $typevoiture): self
    {
        $this->typevoiture = $typevoiture;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(?string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(?string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(?string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getGestionnaire(): ?string
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?string $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    public function getEmailgestionnaire(): ?string
    {
        return $this->emailgestionnaire;
    }

    public function setEmailgestionnaire(?string $emailgestionnaire): self
    {
        $this->emailgestionnaire = $emailgestionnaire;

        return $this;
    }


    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }








    public function getSalt() {}

    public function eraseCredentials() {}

    public function getRoles() {

        return ['ROLE_USER'];
    }



    public function getConfirmation(): ?string
    {
        return $this->confirmation;
    }

    public function setConfirmation(string $confirmation): self
    {
        $this->confirmation = $confirmation;

        return $this;
    }



  public function __construct()
    {
        // Générer un code aléatoire de 10 caractères pour la confirmation du mail
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueur = 35;
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';
        for ($i = 0; $i < $longueur; $i++)
        {
            $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }
        $this->confirmation = $chaineAleatoire.date("YmdHis");
        $this->isActive = false;
        //$this->dateinsertion = date("Y-m-d H:i:s");
    }



}
