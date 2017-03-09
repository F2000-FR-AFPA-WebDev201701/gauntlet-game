<?php

class Map {

    public static $_MOVEUP = 1;
    public static $_MOVERIGHT = 2;
    public static $_MOVEDOWN = 3;
    public static $_MOVELEFT = 4;
    public static $_OFFSETMOVE = 4; //pixels
    private $moveDirection;
    private $mapMaxX = 320;
    private $mapMaxY = 480;
    private $posPersoX; //result X
    private $posPersoY; //result Y

    /**
     * Map constructor.
     */

    public function __construct() {
        // load
        $this->load();
        //$this->posPersoX = 305;
        //$this->posPersoY = 128;
    }

    public function move($moveDirection) {
        if ($this->moveable($moveDirection)) {
            switch ($moveDirection) {
                case self::$_MOVEUP :
                    $this->posPersoY -= self::$_OFFSETMOVE;
                    break;
                case self::$_MOVERIGHT :
                    $this->posPersoX += self::$_OFFSETMOVE;
                    break;
                case self::$_MOVEDOWN :
                    $this->posPersoY += self::$_OFFSETMOVE;
                    break;
                case self::$_MOVELEFT :
                    $this->posPersoX -= self::$_OFFSETMOVE;
                    break;
            } // end switch
            //save
            $this->save();
        }
    }

    public function moveable($moveDirection) {
        switch ($moveDirection) {
            case self::$_MOVEUP :
                $condition = ($this->posPersoY - 16 - self::$_OFFSETMOVE >= 0);
                if (!$condition) {
                    //  $this->posPersoY = $this->mapMaxY - 2;
                }
                break;
            case self::$_MOVERIGHT :
                $condition = ($this->posPersoX + 16 + self::$_OFFSETMOVE <= $this->mapMaxX);
                if (!$condition) {
// $this->posPersoX = $this->mapMaxX - 2;
                }
                break;
            case self::$_MOVEDOWN :
                $condition = ($this->posPersoY + 16 + self::$_OFFSETMOVE <= $this->mapMaxY);
                if (!$condition) {
// $this->posPersoX = $this->mapMaxY + 2;
                }
                break;
            case self::$_MOVELEFT :
                $condition = ($this->posPersoX - 16 - self::$_OFFSETMOVE >= 0);
                if (!$condition) {
// $this->posPersoX = $this->mapMaxX + 2;
                }
                break;
        } // end switch

        return $condition;
    }

    public function generateHtml() {
//$this->posPersoX = 20;
//$this->posPersoY = 20;
        $html = '
                <style type="text/css">
            .hero { margin-left: ' . $this->posPersoX . 'px;
                    margin-top: ' . $this->posPersoY . 'px;}
            </style>
        </head>
        <body>
            <div class="plateau">
            <div class="hero" ></div>
        </div>
        </body>
                ';
        return $html;
    }

    public function load() {
        $unSerialize = file_get_contents('./save');
        $arrayUnserialize = unserialize($unSerialize);
        $ob = $arrayUnserialize;

        $this->posPersoX = $ob->posPersoX;
        $this->posPersoY = $ob->posPersoY;
    }

    public function save() {
        $varSerialize = serialize($this);
        file_put_contents('./save', $varSerialize);
    }

}
