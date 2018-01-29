<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="entries")
 */
class Entry {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="text")
     */
    private $preview;

    /**
     * @ORM\Column(type="text")
     */
    private $date;

    // getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function getContent() {
        return $this->content;
    }

    public function getPreview() {
        return $this->preview;
    }

    public function getDate() {
        return $this->date;
    }

    //setters
    public function setId($a) {
        $this->id = $a;
    }

    public function setTitle($a) {
        $this->title = $a;
    }

    public function setAuthor($a) {
        $this->author = $a;
    }

    public function setContent($a) {
        $this->content = $a;
    }

    public function setPreview($a) {
        $this->preview = $a;
    }

    public function setDate($a) {
        $this->date = $a;
    }

    // A function to get all data of an entry at once.
    public function getEntry() {
        return array(
            "id"=>$this->getId(),
            "title"=>$this->getTitle(),
            "author"=>$this->getAuthor(),
            "content"=>$this->getContent(),
            "preview"=>$this->getPreview(),
            "date"=>$this->getDate(),
        );
    }

}

?>