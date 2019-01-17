<?php
/**
 * Created by PhpStorm.
 * User: PC11
 * Date: 21/12/2018
 * Time: 10:07
 */

namespace App\Service\Twig;


use Twig\Extension\AbstractExtension;

class AppExtension extends AbstractExtension
{
    public const NB_SUMMARY_CHAR = 130;

    public function getFilters()
    {
        return [
            new \Twig_Filter('summary', function($text) {

                # Supprimer les balises HTML
                $string = strip_tags($text);

                # Si mon texte contient plus de 170 caractères
                if(strlen($string) > self::NB_SUMMARY_CHAR) {
                    # Je coupe ma chaîne à 170
                    $stringCut = substr($string,0,self::NB_SUMMARY_CHAR);

                    # Je ne dois pas couper un mot en plein milieu...
                    $string = substr($stringCut,0,strrpos($stringCut,' ')).'...';
                }

                return $string;
            },['is_safe' => ['html']])
        ];
    }
}