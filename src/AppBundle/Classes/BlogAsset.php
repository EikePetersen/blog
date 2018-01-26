<?php

    namespace AppBundle\Classes;

    class BlogAsset {

        private $typ;
        private $url;

        public function BlogAsset($typ, $url) {
            $this->typ = $typ;
            $this->url = $url;
        }

        /**
         * @return String
         */
        public function getTyp()
        {
            return $this->typ;
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