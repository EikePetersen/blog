<?php

    namespace AppBundle\Classes;

    class BlogAsset {

        private $type;
        private $url;

        public function __construct($type, $url) {
            $this->typ = $type;
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