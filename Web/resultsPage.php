<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Antonin
 * Date: 24/04/14
 * Time: 09:45
 * To change this template use File | Settings | File Templates.
 */

include ("autoload.php");
include("configuration.php");

// On récupère la recherche que l'utilisateur tape.
$keyword = $_GET["req"];
$keyword_original = $_GET["req"];
$keyword = str_replace(' ', '+', $keyword);


// On fait une instance de la classe GetJsonManager
$nJMan = new GetJsonManager();
// On recupère le nombre de résultats pour l'affichage
$numberOfResults  = $nJMan->CountNumberResults($server_url, $keyword);
// On recupère la liste des résultats Json
$listOfWebsite = $nJMan->findAllWebsite($server_url, $keyword);


// Si le nombre de resultats par page n'est pas demandé par l'utilisateur, on lui assigne 6 par défaut
if (!isset($_POST["nbResultsPerPage"]))
{
    $nbResultsMaxPerPage = 6;
}
// Sinon on prend la valeur demandée par l'utilisateur
else
{

    $nbResultsMaxPerPage = intval($_POST["nbResultsPerPage"]);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Supinfo IN Search</title>
    <meta charset="utf-8" >
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
    <script  type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/navigation.js"></script>
</head>
<body>

<div id="container">
<div id="header">

    <form method="get" action="resultsPage.php" class="center-block">
        <div id="researchZone" class="form-group">
            <img id="logo" src="pictures/logoweb.png" alt="image recherche">
            <input type="text" class="form-control" name="req" value="<?php echo($keyword_original) ?>"  placeholder="Saisissez votre recherche ici"><input value="Rechercher" class="btn btn-primary" type="submit" >
        </div>
    </form>
</div>

<div id="wrapper">
    <div id="nbPages"><p>Resultats par page :</p>  <form action="<?php echo('resultsPage.php?req='.$keyword)?>" method="post"> <input id="nbResultsPerPage" placeholder="Ex: 1,2..." type="text" name="nbResultsPerPage" ><input class="btn btn-success" type="submit" value="Actualiser"> </form> </div>
    <div class="result" id="result">
        <?php
        // Si le nombre maximum de résultats par page est de 6
		if($numberOfResults == 0){
			echo("No results found");
		}   

		if ($nbResultsMaxPerPage == 6)
        {
           // On fait un affichage de 6 résultats par page, on peut le changer mais c'est pour faire fonctionner le changement de page en Jquery
           if ($numberOfResults <= 6)
           {
               for( $i = 0 ; $i < $numberOfResults/6 ; $i++)
                {
                   // On crée une div avec pour valeur et id  $i  qui correspond au numéro de la page
                   echo "<div class='resdisp' value=" . $i ." id=page-" .$i . " >" ;
                    // On fait un for each qui va retourner la liste des sites internet.
                   foreach ($listOfWebsite as $site)
                   {
                       echo "<ul>
                                <li class='result-title'><a href=" .$site->getLink().">" . $site->getTitle() . " </a></li>
                                <li class='result-description'>" .  $site->getDescription() .  "</li>
                                <li class='result-link'><a href=" .$site->getLink().">" .  $site->getLink() . " </a></li>

                       </ul>" ;


                   }

                }
           }
        else
        // Si le nombre de résultats est supèrieur à 6
        if ($numberOfResults > 6)
        {
            // On initialise un incrément qui va nous servir à nous positionner dans l'array des sites web.
             $increment = 0;
            // Boucle for sur le nombre de résultats/6  => nombre de pages ( 2 pages de 6 résultats)
           for( $i = 0 ; $i < $numberOfResults/6 ; $i++)
           {
                  // Si i = 0, on va insérer dans la page les 6 résultats
                   if ($i == 0)
                   {
                       // On crée une div avec pour valeur et id  $i  qui correspond au numéro de la page
                       echo "<div class='resdisp' value=" . $i ." id=page-" .$i . " >" ;
                       // On récupère dans l'array le link, la description et le titre en fonction de $a qui est l'index de l'array
                       for ($a = $i; $a < $i+6 ; $a++)
                       {
                       echo "<ul>
                            <li class='result-title'><a href=" .$listOfWebsite[$a]->getLink().">" .$listOfWebsite[$a]->getTitle(). " </a></li>
                            <li class='result-description'>" .  $listOfWebsite[$a]->getDescription() .  "</li>
                            <li class='result-link'><a href=" .$listOfWebsite[$a]->getLink().">" .  $listOfWebsite[$a]->getLink() . " </a></li>

                            </ul>" ;
                           // On incrémente notre variable à chaque itération.
                           $increment++;
                       }
                   }
                   else
                       // Cette condition sert à éviter que la page suivante reprenne des éléments de la page précédente
                       if ( $i >= 1)
                        {
                            // Si la différence entre le nombre maximum de résultats et notre variable qui vaudra 6 car six sites sur la première page.
                            if ($numberOfResults-$increment != 0)
                            {   // Si la différence est supèrieure ou égal à 6.
                                if ($numberOfResults-$increment >= 6 )
                               {
                                  // On crée une div avec pour valeur et id  $i  qui correspond au numéro de la page
                                  echo "<div class='resdisp' value=" . $i ." id=page-" .$i . " >" ;

                                  // On récupère dans l'array le link, la description et le titre en fonction de $a qui est l'index de l'array
                                  for ($a = $increment; $a < $increment+6 ; $a++)
                                   {
                                        echo "<ul>
                                        <li class='result-title'><a href=" .$listOfWebsite[$a]->getLink().">" .$listOfWebsite[$a]->getTitle(). " </a></li>
                                        <li class='result-description'>" .  $listOfWebsite[$a]->getDescription() .  "</li>
                                        <li class='result-link'><a href=" .$listOfWebsite[$a]->getLink().">" .  $listOfWebsite[$a]->getLink() . " </a></li>

                                        </ul>" ;

                                   }
                                   // On incrémente notre variable pour les résultats suivants.
                                   $increment+=6;
                               }
                                // Sinon si le nombre de résultats restants est infèrieur à 6, on les affiche simplement et la boucle s'arrête là.
                                else
                                {
                                // On crée une div avec pour valeur et id  $i  qui correspond au numéro de la page
                                echo "<div class='resdisp' value=" . $i ." id=page-" .$i . " >" ;

                                // On récupère dans l'array le link, la description et le titre en fonction de $a qui est l'index de l'array
                                for ($a = $increment; $a < $numberOfResults ; $a++)
                                {
                                    echo "<ul>
                                    <li class='result-title'><a href=" .$listOfWebsite[$a]->getLink().">" .$listOfWebsite[$a]->getTitle(). " </a></li>
                                    <li class='result-description'>" .  $listOfWebsite[$a]->getDescription() .  "</li>
                                    <li class='result-link'><a href=" .$listOfWebsite[$a]->getLink().">" .  $listOfWebsite[$a]->getLink() . " </a></li>

                                    </ul>" ;

                                }

                            }
                            }

                        }

               echo "</div>";
               }





        }

        }
        // Sinon, On fait un affichage du nombre donné par l'utilisateur de résultats par page.
        else
        {


            //Si le nombre de résultats est inférieur où égal au nombre demandé.
            if ($numberOfResults <= $nbResultsMaxPerPage)
            {
                // On fait une boucle for pour initialiser le nombre de pages de résultats souhaitées.
                for( $i = 0 ; $i < $numberOfResults/$nbResultsMaxPerPage ; $i++)
                {
                    // On crée une div avec pour valeur et id  $i  qui correspond au numéro de la page
                    echo "<div class='resdisp' value=" . $i ." id=page-" .$i . " >" ;
                    // On affiche simplement les résultats.
                    foreach ($listOfWebsite as $site)
                    {
                        echo "<ul>
                             <li class='result-title'><a href=" .$site->getLink().">" . $site->getTitle() . " </a></li>
                             <li class='result-description'>" .  $site->getDescription() .  "</li>
                             <li class='result-link'><a href=" .$site->getLink().">" .  $site->getLink() . " </a></li>

                             </ul>" ;

                    }

                }
            }


            else
                // Si le nombre de résultats est supèrieur au nombre de résultats par page demandé.
                if ($numberOfResults > $nbResultsMaxPerPage)
                {
                    // Initialisation de notre incrément.
                    $increment = 0;

                    // Boucle for sur le nombre de résultats divisé par le nombre de résultats demandés par page.

                    for( $i = 0 ; $i < $numberOfResults/$nbResultsMaxPerPage ; $i++)
                    {
                        // Si le numéro de page est égal à 0 , on va insérer dans la page les n résultats
                        if ($i == 0)
                        {
                            // On crée une div avec pour valeur et id  $i  qui correspond au numéro de la page
                            echo "<div class='resdisp' value=" . $i ." id=page-" .$i . " >" ;
                            // On récupère dans l'array le link, la description et le titre en fonction de $a qui est l'index de l'array
                            for ($a = $i; $a < $i+$nbResultsMaxPerPage ; $a++)
                            {
                                echo "<ul>
                                    <li class='result-title'><a href=".$listOfWebsite[$a]->getLink().">" .$listOfWebsite[$a]->getTitle()."</a></li>
                                    <li class='result-description'>".$listOfWebsite[$a]->getDescription() ."</li>
                                    <li class='result-link'><a href=".$listOfWebsite[$a]->getLink().">" .  $listOfWebsite[$a]->getLink()."</a></li>

                                    </ul>" ;
                                // On incrémente notre variable pour les pages suivantes.
                                $increment++;
                            }
                        }
                        else

                            // Si le numéro de page est supèrieur ou égal à 1
                            if ( $i >= 1)
                            {
                                // Si la différence entre le nombre de résultats maximal et notre variable est différent de 0
                                if ($numberOfResults-$increment != 0)
                                {
                                    // Si notre différence est supèrieur ou égal au nombre de résultats par page
                                    if ($numberOfResults-$increment >= $nbResultsMaxPerPage )
                                    {
                                        // On crée une div avec pour valeur et id  $i  qui correspond au numéro de la page
                                        echo "<div class='resdisp' value=" . $i ." id=page-" .$i . " >" ;

                                        // On récupère dans l'array le link, la description et le titre en fonction de $a qui est l'index de l'array
                                        for ($a = $increment; $a < $increment+$nbResultsMaxPerPage ; $a++)
                                        {
                                           echo "<ul>
                                                 <li class='result-title'><a href=" .$listOfWebsite[$a]->getLink().">" .$listOfWebsite[$a]->getTitle(). " </a></li>
                                                 <li class='result-description'>" .  $listOfWebsite[$a]->getDescription() .  "</li>
                                                 <li class='result-link'><a href=" .$listOfWebsite[$a]->getLink().">" .  $listOfWebsite[$a]->getLink() . " </a></li>

                                                 </ul>" ;

                                        }
                                        // On incrémente notre variable.
                                        $increment+=$nbResultsMaxPerPage;
                                    }
                                    // Sinon si notre différence est infèrieur ou égal au nombre de résultats par page
                                    else
                                    {
                                        // On crée une div avec pour valeur et id  $i  qui correspond au numéro de la page
                                        echo "<div class='resdisp' value=" . $i ." id=page-" .$i . " >" ;

                                        // On récupère dans l'array le link, la description et le titre en fonction de $a qui est l'index de l'array
                                        // On affiche les résultats restants.
                                        for ($a = $increment; $a < $numberOfResults ; $a++)
                                        {
                                            echo "<ul>
                                            <li class='result-title'><a href=" .$listOfWebsite[$a]->getLink().">" .$listOfWebsite[$a]->getTitle(). " </a></li>
                                            <li class='result-description'>" .  $listOfWebsite[$a]->getDescription() .  "</li>
                                            <li class='result-link'><a href=" .$listOfWebsite[$a]->getLink().">" .  $listOfWebsite[$a]->getLink() . " </a></li>

                                            </ul>" ;

                                        }

                                    }
                                }

                            }

                        echo "</div>";
                    }





                }




        }





       ?>

    </div>
</div>

<div id="footer">

         <div id="navigation">
             <ul>
                 <li class="number-page"><a href="#" id="precedent" class="btn btn-default btn-primary"><span class="glyphicon glyphicon-step-backward"></span>Precedent</a></li>
                 <li class="number-page"><a href="#" id="suivant" class="btn btn-default btn-primary"> Suivant <span class="glyphicon glyphicon-step-forward"></span></a></li>


             </ul>
         </div>
</div>
</div>
</body>
</html>
