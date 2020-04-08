'use-strict';

$aquaJq = jQuery.noConflict();

$aquaJq(
    function(){
        $aquaJq(window).scroll(
            function(){
                if($aquaJq(this).scrollTop() > 50){
                    $aquaJq("#topBanner").addClass("shadow-aqua");
                }else{
                    $aquaJq("#topBanner").removeClass("shadow-aqua");
                }
            }
        );
    }
);
