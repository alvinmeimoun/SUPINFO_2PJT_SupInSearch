/**
 * Created with JetBrains PhpStorm.
 * User: Antonin
 * Date: 25/04/14
 * Time: 14:26
 *
 */

// On initialise un entier qui va nous permettre de savoir quelle est la page visualisée
myInteger = 0;
$(document).ready(function(){


    var nb = 1;
    // On compte le nombre de pages de recherches
    var nbDiapos = $('div.resdisp').length;
    console.log(nbDiapos);


    // Pour nb allant de la page 1 au nombre maximum de page, on va cacher toutes les autres pages
    for (nb ; nb < nbDiapos ; nb++)
    {

        $("#page-"+nb).hide();
    }
    if (myInteger == 0)
    {
        $("#precedent").attr("disabled","disable");
    }

       // Si on clique sur suivant
      $("#suivant").click(function() {
         // Si le numéro de page est infèrieur au nombre total de pages.
          if(myInteger < nbDiapos)
          {
              // On cache la page précédente et on affiche la page suivante.
              $("#page-"+myInteger).hide( "drop", { direction: "left" }, "fast" );
              $("#page-"+(myInteger+1)).show( "drop", 1000 );
              // On incrémente notre compteur
              myInteger+=1;

              // On supprime l'attribut désactivé du bouton précédent s'il est désactivé
              $("#precedent").removeAttr("disabled");

              // La page 1 étant numérotée 0 et ainsi de suite, nous devons désactivé le bouton suivant si nous arrivons
              // à la dernière page de résultats.
              if (myInteger == nbDiapos-1)
              {
                  $("#suivant").attr("disabled","disable");

              }
          }


      }) ;

    // Si on clique sur Précédent
    $("#precedent").click(function() {
        // Si notre compteur est infèrieur au nombre maximal de pages
        if(myInteger < nbDiapos)
        {
            // On supprime l'attribut désactivé du bouton suivant
            $("#suivant").removeAttr("disabled");

            // On cache la page actuelle et on affiche la page précédente
            $("#page-"+myInteger).hide( "drop", { direction: "left" }, "fast" );
            $("#page-"+(myInteger-1)).show( "drop", 1000 );
            // On enlève 1 de notre compteur
            myInteger-=1;

            // Si notre compteur est égal à 0, on est sur la première page donc on désactive le bouton précédent.
            if (myInteger == 0)
            {
                $("#precedent").attr("disabled","disable");
            }
        }



    }) ;




















});