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
    private $posDecorX; //result X
    private $posDecorY;
    /**
     * Map constructor.
     */

    public function __construct() {
        // load
        $this->load();
        $this->posDecorX = 110;
        $this->posDecorY = 50;
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
            .decor { margin-left: ' . $this->posDecorX . 'px;
                    margin-top: ' . $this->posDecorY . 'px;}
            </style>
        </head>
        <body>
            <div class="plateau">
            <div class="hero" ></div>
            <div class="decor"></div>
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

    public function collision(){

        //Comparaison Y1/Y2 & X1/X2
        $x1 = $this->posPersoX;
        $y1 = $this->posPersoY;
        $x2 = $this->posDecorX;
        $y2 = $this->posDecorY;
        /*
        A1(x1,      y1)       <   C2(x2+32,   y2+32)
        B1(x1+32,   y1)       <   D2(x2,      y2+32)
        C1(x1+32,   y1+32)    <   A2(x2,      y2)
        D1(x1,      y1+32)    <   B2(x2+32,   y2)   //pour x et pour y
        */

        if((($x1>=$x2) && ($x1<=($x2+32))) && (($y1>=$y2) && ($y1<=($y2+32)))){
            echo 'collision entre A1 et C2!';
        }
        if(((($x1+32)>=$x2) && (($x1+32)<=$x2+32)) &&( ($y1>=$y2) && ($y1<=($y2+32)) )){
            echo 'collision entre B1 et D2!';
        }

        if( (($x1+32>=$x2) && (($x1+32)<=($x2+32))) && ( (($y1+32)<=($y2+32))&&(($y1+32)>=$y2)) ){
            echo 'collision entre C1 et A2!';
        }

        if( ( ($x1<=$x2+32)  && ($x1>=$x2)) &&  (   (($y1+32)>=$y2 ) && (($y1+32)<=($y2+32))    ) )   {
            echo 'collision entre D1 et B2!';
        }


    }

}
