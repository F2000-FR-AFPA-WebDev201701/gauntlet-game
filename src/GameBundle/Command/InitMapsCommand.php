<?php

namespace GameBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use GameBundle\Model\Map;
use GameBundle\Model\Personage;
use GameBundle\Model\Decor;
use GameBundle\Model\Item;
use GameBundle\Model\Monster;

class InitMapsCommand extends Command {

    protected function configure() {
        $this
                // the name of the command (the part after "bin/console")
                ->setName('app:init-maps')

                // the short description shown while running "php bin/console list"
                ->setDescription('Initialize all maps files.')

                // the full command description shown when running the command with
                // the "--help" option
                ->setHelp('This command allows you to create all maps files.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        // perso
        $perso1 = new Personage();
        $perso1->setPositionX(6);
        $perso1->setPositionY(6);
        $perso1->setType('hero');
        $perso1->setHp(200);
        $perso1->setScore(0);

        // decors
        $decor1 = new Decor();
        $decor1->setPositionX(128);
        $decor1->setPositionY(128);
        $decor1->setType('wallyxr'); // wall

        $decor2 = new Decor();
        $decor2->setPositionX(128);
        $decor2->setPositionY(192);
        $decor2->setType('wally'); // wall

        $decor3 = new Decor();
        $decor3->setPositionX(128);
        $decor3->setPositionY(256);
        $decor3->setType('wally'); // wall

        $decor4 = new Decor();
        $decor4->setPositionX(128);
        $decor4->setPositionY(320);
        $decor4->setType('wallybt'); // wall

        $decor5 = new Decor();
        $decor5->setPositionX(384);
        $decor5->setPositionY(256);
        $decor5->setType('wallyxr'); // wall

        $decor6 = new Decor();
        $decor6->setPositionX(384);
        $decor6->setPositionY(320);
        $decor6->setType('wally'); // wall

        $decor7 = new Decor();
        $decor7->setPositionX(384);
        $decor7->setPositionY(384);
        $decor7->setType('wallxrt'); // wall

        $decor8 = new Decor();
        $decor8->setPositionX(320);
        $decor8->setPositionY(384);
        $decor8->setType('wallxlt'); // wall

        $decor9 = new Decor();
        $decor9->setPositionX(192);
        $decor9->setPositionY(128);
        $decor9->setType('wallxrt'); // wall

        $decor10 = new Decor();
        $decor10->setPositionX(448);
        $decor10->setPositionY(256);
        $decor10->setType('wallx'); // wall

        $decor11 = new Decor();
        $decor11->setPositionX(512);
        $decor11->setPositionY(256);
        $decor11->setType('wallx'); // wall

        $decor12 = new Decor();
        $decor12->setPositionX(576);
        $decor12->setPositionY(256);
        $decor12->setType('wallx'); // wall

        $decor13 = new Decor();
        $decor13->setPositionX(192);
        $decor13->setPositionY(64);
        $decor13->setType('wally'); // wall

        $decor14 = new Decor();
        $decor14->setPositionX(192);
        $decor14->setPositionY(0);
        $decor14->setType('wally'); // wall

        $decor15 = new Decor();
        $decor15->setPositionX(640);
        $decor15->setPositionY(256);
        $decor15->setType('wallx'); // wall

        $decor16 = new Decor();
        $decor16->setPositionX(704);
        $decor16->setPositionY(256);
        $decor16->setType('wallx'); // wall

        $decor17 = new Decor();
        $decor17->setPositionX(512);
        $decor17->setPositionY(192);
        $decor17->setType('wally'); // wall

        $decor18 = new Decor();
        $decor18->setPositionX(512);
        $decor18->setPositionY(192);
        $decor18->setType('wally'); // wall

        $decor19 = new Decor();
        $decor19->setPositionX(512);
        $decor19->setPositionY(128);
        $decor19->setType('wallyb'); // wall

        $item1 = new Item();
        $item1->setPositionX(192);
        $item1->setPositionY(192);
        $item1->setType('potion');

        $item2 = new Item();
        $item2->setPositionX(576);
        $item2->setPositionY(192);
        $item2->setType('clef');

        $item3 = new Item();
        $item3->setPositionX(320);
        $item3->setPositionY(320);
        $item3->setType('diamant');

        $item4 = new Item();
        $item4->setPositionX(640);
        $item4->setPositionY(384);
        $item4->setType('nextlvl');

        // monsters
        $monster1 = new Monster();
        $monster1->setPositionX(64);
        $monster1->setPositionY(448);
        $monster1->setHp(200);
        $monster1->setType('ghost');

        $monster2 = new Monster();
        $monster2->setPositionX(448);
        $monster2->setPositionY(320);
        $monster2->setHp(200);
        $monster2->setType('ghost');

        $monster3 = new Monster();
        $monster3->setPositionX(320);
        $monster3->setPositionY(0);
        $monster3->setHp(200);
        $monster3->setType('ghost');

        $monster4 = new Monster();
        $monster4->setPositionX(512);
        $monster4->setPositionY(64);
        $monster4->setHp(200);
        $monster4->setType('ghost');

        $monster5 = new Monster();
        $monster5->setPositionX(640);
        $monster5->setPositionY(128);
        $monster5->setHp(200);
        $monster5->setType('ghost');

        $oMap1 = new Map();

        $oMap1->addElementCharacter($perso1);

        $oMap1->addElementDecor($decor1);
        $oMap1->addElementDecor($decor2);
        $oMap1->addElementDecor($decor3);
        $oMap1->addElementDecor($decor4);
        $oMap1->addElementDecor($decor5);
        $oMap1->addElementDecor($decor6);
        $oMap1->addElementDecor($decor7);
        $oMap1->addElementDecor($decor8);
        $oMap1->addElementDecor($decor9);
        $oMap1->addElementDecor($decor10);
        $oMap1->addElementDecor($decor11);
        $oMap1->addElementDecor($decor12);
        $oMap1->addElementDecor($decor13);
        $oMap1->addElementDecor($decor14);
        $oMap1->addElementDecor($decor15);
        $oMap1->addElementDecor($decor16);
        $oMap1->addElementDecor($decor17);
        $oMap1->addElementDecor($decor18);
        $oMap1->addElementDecor($decor19);

        $oMap1->addElementItem($item1);
        $oMap1->addElementItem($item2);
        $oMap1->addElementItem($item3);
        $oMap1->addElementItem($item4);

        $oMap1->addElementMonster($monster1);
        $oMap1->addElementMonster($monster2);
        $oMap1->addElementMonster($monster3);
        $oMap1->addElementMonster($monster4);
        $oMap1->addElementMonster($monster5);

        $oMap1->save(1);


        // map 2
        // *****

        $perso01 = new Personage();
        $perso01->setPositionX(660);
        $perso01->setPositionY(460);
        $perso01->setType('hero');
        $perso01->setHp(200);
        $perso01->setScore(0);

        // decors
        $decor01 = new Decor();
        $decor01->setPositionX(0);
        $decor01->setPositionY(192);
        $decor01->setType('wallx'); // wall

        $decor02 = new Decor();
        $decor02->setPositionX(64);
        $decor02->setPositionY(192);
        $decor02->setType('wallx'); // wall

        $decor03 = new Decor();
        $decor03->setPositionX(128);
        $decor03->setPositionY(192);
        $decor03->setType('wallxrt'); // wall

        $decor04 = new Decor(); //2nd mur
        $decor04->setPositionX(384);
        $decor04->setPositionY(0);
        $decor04->setType('wally'); // wall

        $decor05 = new Decor();
        $decor05->setPositionX(384);
        $decor05->setPositionY(64);
        $decor05->setType('wally'); // wall

        $decor06 = new Decor();
        $decor06->setPositionX(384);
        $decor06->setPositionY(128);
        $decor06->setType('wallxyx'); // wall

        $decor07 = new Decor();
        $decor07->setPositionX(320);
        $decor07->setPositionY(128);
        $decor07->setType('wallxlt'); // wall

        $decor08 = new Decor();
        $decor08->setPositionX(384);
        $decor08->setPositionY(192);
        $decor08->setType('wallybt'); // wall xrt

        $decor09 = new Decor();
        $decor09->setPositionX(448);
        $decor09->setPositionY(128);
        $decor09->setType('wallxrt'); // wall

        $decor010 = new Decor(); //mur 3
        $decor010->setPositionX(640);
        $decor010->setPositionY(128);
        $decor010->setType('wallxlt'); // wall

        $decor011 = new Decor();
        $decor011->setPositionX(704);
        $decor011->setPositionY(128);
        $decor011->setType('wallx'); // wall

        $decor012 = new Decor(); //mur 4
        $decor012->setPositionX(192);
        $decor012->setPositionY(384);
        $decor012->setType('wallxlt'); // wall

        $decor013 = new Decor();
        $decor013->setPositionX(256);
        $decor013->setPositionY(384);
        $decor013->setType('wallx'); // wall

        $decor014 = new Decor();
        $decor014->setPositionX(320);
        $decor014->setPositionY(384);
        $decor014->setType('wallxrt'); // wall

        $decor015 = new Decor();
        $decor015->setPositionX(512);
        $decor015->setPositionY(384);
        $decor015->setType('wallxlt'); // wall

        $decor016 = new Decor();
        $decor016->setPositionX(576);
        $decor016->setPositionY(384);
        $decor016->setType('wallx'); // wall

        $decor017 = new Decor();
        $decor017->setPositionX(640);
        $decor017->setPositionY(384);
        $decor017->setType('wallx'); // wall

        $decor018 = new Decor();
        $decor018->setPositionX(704);
        $decor018->setPositionY(384);
        $decor018->setType('wallx'); // wall
        // items
        $item01 = new Item();
        $item01->setPositionX(0);
        $item01->setPositionY(384);
        $item01->setType('potion');

        $item02 = new Item();
        $item02->setPositionX(704);
        $item02->setPositionY(0);
        $item02->setType('clef');

        $item03 = new Item();
        $item03->setPositionX(0);
        $item03->setPositionY(64);
        $item03->setType('nextlvl'); // nextlvl
        // monsters
        $monster01 = new Monster();
        $monster01->setPositionX(256);
        $monster01->setPositionY(0);
        $monster01->setHp(200);
        $monster01->setType('ghost');

        $monster02 = new Monster();
        $monster02->setPositionX(64);
        $monster02->setPositionY(128);
        $monster02->setHp(200);
        $monster02->setType('ghost');

        $monster03 = new Monster();
        $monster03->setPositionX(704);
        $monster03->setPositionY(192);
        $monster03->setHp(200);
        $monster03->setType('ghost');

        $monster04 = new Monster();
        $monster04->setPositionX(576);
        $monster04->setPositionY(320);
        $monster04->setHp(200);
        $monster04->setType('ghost');

        $monster05 = new Monster();
        $monster05->setPositionX(256);
        $monster05->setPositionY(448);
        $monster05->setHp(200);
        $monster05->setType('ghost');

        $oMap2 = new Map();
        $oMap2->addElementCharacter($perso01);

        $oMap2->addElementDecor($decor01);
        $oMap2->addElementDecor($decor02);
        $oMap2->addElementDecor($decor03);
        $oMap2->addElementDecor($decor04);
        $oMap2->addElementDecor($decor05);
        $oMap2->addElementDecor($decor06);
        $oMap2->addElementDecor($decor07);
        $oMap2->addElementDecor($decor08);
        $oMap2->addElementDecor($decor09);
        $oMap2->addElementDecor($decor010);
        $oMap2->addElementDecor($decor011);
        $oMap2->addElementDecor($decor012);
        $oMap2->addElementDecor($decor013);
        $oMap2->addElementDecor($decor014);
        $oMap2->addElementDecor($decor015);
        $oMap2->addElementDecor($decor016);
        $oMap2->addElementDecor($decor017);
        $oMap2->addElementDecor($decor018);

        $oMap2->addElementItem($item01);
        $oMap2->addElementItem($item02);
        $oMap2->addElementItem($item03);

        $oMap2->addElementMonster($monster01);
        $oMap2->addElementMonster($monster02);
        $oMap2->addElementMonster($monster03);
        $oMap2->addElementMonster($monster04);
        $oMap2->addElementMonster($monster05);

        $oMap2->save(2);
    }

}
