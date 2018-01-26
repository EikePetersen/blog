<?php

    namespace AppBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;


    /**
     * @ORM\Entity
     * @ORM\Table(name="assets")
     */
    class BlogAsset {
        /**
         * @ORM\Column(type="integer")
         * @ORM\Id
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;

        /**
         * @ORM\Column(type="string")
         */
        private $type;

        /**
         * @ORM\Column(type="string")
         */
        private $url;

        public function __construct($type, $url) {
            $this->type = $type;
            $this->url = $url;
        }

        /**
         * @return String
         */
        public function getType()
        {
            return $this->type;
        }

        /**
         * @return String
         */
        public function getUrl()
        {
            return $this->url;
        }



    }

?>