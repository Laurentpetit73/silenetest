<?php

namespace App\Render;

class RenderCalendar{

    private $year;
    private $startmonth;
    private $endmonth;
    const JOURS = ["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche"];
    const JOURS2 = ["LUN","MAR","MER","JEU","VEN","SAM","DIM"];

    public function __construct($year , $startmonth , $endmonth)
    {
        $this->year = $year;
        $this->startmonth = $startmonth;
        $this->endmonth = $endmonth;
    }

    private function createMonth($month)
    {
        
        return new Month($this->year,$month);
    }


    public function render()
    {
        ?>
        <?php for($m =  $this->startmonth; $m <= $this->endmonth;$m++): ?>
            <div class ="first-line">
                <?php $cal = $this->createMonth($m);$compteur = $cal->getFirstDay()-1?>
                    <?php for($i =  1; $i <= $cal->getLastDay() ;$i++): ?>
                        <div class="date <?= self::JOURS2[$compteur]== "DIM" ? "dim":"" ?>"> 
                            <?php if(self::JOURS2[$compteur]== "DIM"): ?>
                                <div class="trait"></div>
                            <?php endif; ?>
                            <p class="nom-jour"><?= self::JOURS2[$compteur];?></p>
                            <p class="num-jour"><?= $i ?></p>
                            <p class="nom-moi"><?= $cal->getNameMonth() ?></p>
                            <?php $compteur ++;
                                if($compteur==7){
                                    $compteur=0;
                                }
                            ?>
                        </div>
                    <?php endfor; ?>
            </div>

                <div class="book">
                    <div class="test"></div>
                    <div class="test"></div>
                    <div class="debut"></div>
                        <?php for($i =  1; $i <= $cal->getLastDay()-3 ;$i++): ?>
                            <div class="free"></div>
                        <?php endfor; ?>
                </div>
        <?php endfor; ?>
        <?php

    }
}