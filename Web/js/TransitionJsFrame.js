// TRANSITION FORMULAIRE -> DROP TO PAGES



$(function() {
    // run the currently selected effect
    function runEffect() {
        // get effect type from
        var selectedEffect = "slide";
    /*if (selectedEffect == "slide")
     {
     var selectedEffect2 = "clip";
     $("#effect2").toggle(selectedEffect2,options,500);
     }*/

// most effect types need no options passed by default
var options = {direction: "left"};
// some effects have required parameters
if ( selectedEffect === "scale" ) {
    options = { percent: 0 };
} else if ( selectedEffect === "size" ) {
    options = { to: { width: 200, height: 60 } };
}

// run the effect
$( "#effect" ).toggle( selectedEffect,options , 500 );

};
$( "#2" ).hide();
$( "#3" ).hide();
$( "#4" ).hide();
$( "#5" ).hide();


console.log('hello');
// set effect from select menu value
$( "#button_suivant" ).click(function() {
    var retour = $('.OneForm').parent().attr('id');
    console.log(retour);


  if (document.forms['myform'].elements['Lname'].value != '' && document.forms['myform'].elements['firstName'].value != ''
        && document.forms['myform'].elements['birthDate'].value != '' && document.forms['myform'].elements['job'].value != '' &&
        document.forms['myform'].elements['fumeur'].value != '' && document.forms['myform'].elements['proportion'].value != '' &&
        document.forms['myform'].elements['garantie'].value != '' )
    {
        ClickToMore(retour);
    }



});
    $( "#button_suivant2" ).click(function() {

        var retour = $('.fm-part2').attr('id');
        console.log('2eme' + retour);
        if (document.forms['myform'].elements['Lname2'].value == ''  )
        {
            ClickToMore(retour);
        }
        /*else if ( document.forms['myform'].elements['Lname2'].value != '' && document.forms['myform'].elements['firstName2'].value != ''
         && document.forms['myform'].elements['birthDate2'].value != '' && document.forms['myform'].elements['job2'].value != '' &&
         document.forms['myform'].elements['fumeur2'].value != '' && document.forms['myform'].elements['proportion2'].value != '' &&
         document.forms['myform'].elements['garantie2'].value != '')
        {
            ClickToMore(retour);
        }*/
        else
        {
            ClickToMore(retour);
        }




    });
    $( "#button_suivant3" ).click(function() {

        var retour = $('.fm-part3').attr('id');
        console.log('2eme' + retour);
        if (document.forms['myform'].elements['amount'].value != '' && document.forms['myform'].elements['depreciable'].value != ''
            && document.forms['myform'].elements['type'].value != '' && document.forms['myform'].elements['delay'].value != '' &&
            document.forms['myform'].elements['delayed'].value != '' && document.forms['myform'].elements['extension'].value != '' &&
            document.forms['myform'].elements['nominalRates'].value != '' )
        {
            ClickToMore(retour);
        }




    });
    $( "#button_suivant4" ).click(function() {

        var retour = $('.fm-part4').attr('id');
        console.log('2eme' + retour);
        ClickToMore(retour);



    });
    $( "#button_suivant5" ).click(function() {

        var retour = $('.fm-part5').attr('id');
        console.log('2eme' + retour);
        ClickToMorek(retour);



    });
function ClickToMore (retour)
{
    if (retour == "1")
    {
        $( "#1" ).hide( "drop", { direction: "left" }, "fast" );

        $( "#2" ).show( "drop", 1000 );

        console.log(retour);

        retour = $('.fm-part2').attr('id');
        console.log(retour);

    }

    else
    if(retour == "2")
    {
        $( "#2" ).hide( "drop", { direction: "left" }, "fast" );
        $( "#3" ).show( "drop", 1000 );
       console.log('ca coulisse');
        console.log(retour);


    }
    else
    if (retour == "3")
    {
        $( "#3" ).hide( "drop", { direction: "left" }, "fast" );
        $( "#4" ).show( "drop", 1000 );
        console.log('ca coulisse');
        console.log(retour);


    }
    else
    if (retour == "4")
    {
        $( "#4" ).hide( "drop", { direction: "left" }, "fast" );
        $( "#5" ).show( "drop", 1000 );
        console.log('ca coulisse');
        console.log(retour);


    }
}


    $( "#button_previous2" ).click(function() {
        $( "#2" ).hide( "drop", { direction: "left" }, "fast" );
        $( "#1" ).show( "drop", 1000 );
    });
    $( "#button_previous3" ).click(function() {
        $( "#3" ).hide( "drop", { direction: "left" }, "fast" );
        $( "#2" ).show( "drop", 1000 );
    });
    $( "#button_previous4" ).click(function() {
        $( "#4" ).hide( "drop", { direction: "left" }, "fast" );
        $( "#3" ).show( "drop", 1000 );
    });
    $( "#button_previous5" ).click(function() {
        $( "#5" ).hide( "drop", { direction: "left" }, "fast" );
        $( "#4" ).show( "drop", 1000 );
    });


});


