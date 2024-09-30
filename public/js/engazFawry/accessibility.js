    	//gray scale
    	$('#grayscale-btn').on('click', function(){
    		if (!$(this).attr('data-toggled') || $(this).attr('data-toggled') == 'off'){
        /* currently it's not been toggled, or it's been toggled to the 'off' state,
        so now toggle to the 'on' state: */
        $(this).attr('data-toggled','on');
           // and do something...
           $(".accessibility").css({
              "-webkit-filter":"grayscale(100%)","filter":"grayscale(100%)", "width":"100%"
            });
       }
       else if ($(this).attr('data-toggled') == 'on'){
        /* currently it has been toggled, and toggled to the 'on' state,
        so now turn off: */
        $(this).attr('data-toggled','off');
           // and do, or undo, something...
           $(".accessibility").css({
              "-webkit-filter":"grayscale(0%)","filter":"grayscale(0%)", "width":"100%"
            });
       }
   });


      

      //toggle Dark constrant
      $('#dark-mode-btn').on('click', function(){
    		if (!$(this).attr('data-toggled') || $(this).attr('data-toggled') == 'off'){
        /* currently it's not been toggled, or it's been toggled to the 'off' state,
        so now toggle to the 'on' state: */
        $(this).attr('data-toggled','on');
           // and do something...
           $("p").css({"filter":"invert(1)","-webkit-filter":"invert(1)"});
           $("h1").css({"filter":"invert(1)","-webkit-filter":"invert(1)"});
           $("h2").css({"filter":"invert(1)","-webkit-filter":"invert(1)"});
           $("h3").css({"filter":"invert(1)","-webkit-filter":"invert(1)"});
           $("h4").css({"filter":"invert(1)","-webkit-filter":"invert(1)"});
           $("h5").css({"filter":"invert(1)","-webkit-filter":"invert(1)"});
           $("h6").css({"filter":"invert(1)","-webkit-filter":"invert(1)"});
           $("i").css({"filter":"invert(1)","-webkit-filter":"invert(1)"});
           $("a").css({"filter":"invert(1)","-webkit-filter":"invert(1)"});
           $("li").css({"filter":"invert(1)","-webkit-filter":"invert(1)"});
           $(".accessibility").css({"filter":"invert(1)","-webkit-filter":"invert(1)"});
           //$("footer").css({"background-color":"#222"});

       }
       else if ($(this).attr('data-toggled') == 'on'){
        /* currently it has been toggled, and toggled to the 'on' state,
        so now turn off: */
        $(this).attr('data-toggled','off');
           // and do, or undo, something...
           $("p").css({"filter":"invert(0)","-webkit-filter":"invert(0)"});
           $("h1").css({"filter":"invert(0)","-webkit-filter":"invert(0)"});
           $("h2").css({"filter":"invert(0)","-webkit-filter":"invert(0)"});
           $("h3").css({"filter":"invert(0)","-webkit-filter":"invert(0)"});
           $("h4").css({"filter":"invert(0)","-webkit-filter":"invert(0)"});
           $("h5").css({"filter":"invert(0)","-webkit-filter":"invert(0)"});
           $("h6").css({"filter":"invert(0)","-webkit-filter":"invert(0)"});
           $("i").css({"filter":"invert(0)","-webkit-filter":"invert(0)"});
           $("a").css({"filter":"invert(0)","-webkit-filter":"invert(0)"});
           $("li").css({"filter":"invert(0)","-webkit-filter":"invert(0)"});
           $(".accessibility").css({"filter":"invert(0)","-webkit-filter":"invert(0)"});
       }
   });


      //toggle bright constrant
      $('#bright-mode-btn').on('click', function(){
    		if (!$(this).attr('data-toggled') || $(this).attr('data-toggled') == 'off'){
        /* currently it's not been toggled, or it's been toggled to the 'off' state,
        so now toggle to the 'on' state: */
        $(this).attr('data-toggled','on');
           // and do something...
           $("p").css({"filter":"contrast(1.5)","-webkit-filter":"contrast(1.5)"});
           $("h1").css({"filter":"contrast(1.5)","-webkit-filter":"contrast(1.5)"});
           $("h2").css({"filter":"contrast(1.5)","-webkit-filter":"contrast(1.5)"});
           $("h3").css({"filter":"contrast(1.5)","-webkit-filter":"contrast(1.5)"});
           $("h4").css({"filter":"contrast(1.5)","-webkit-filter":"contrast(1.5)"});
           $("h5").css({"filter":"contrast(1.5)","-webkit-filter":"contrast(1.5)"});
           $("h6").css({"filter":"contrast(1.5)","-webkit-filter":"contrast(1.5)"});
           $("i").css({"filter":"contrast(1.5)","-webkit-filter":"contrast(1.5)"});
           $("a").css({"filter":"contrast(1.5)","-webkit-filter":"contrast(1.5)"});
           $("li").css({"filter":"contrast(1.5)","-webkit-filter":"contrast(1.5)"});
           $(".accessibility").css({"filter":"contrast(1.5)","-webkit-filter":"contrast(1.5)"});
           //$("footer").css({"background-color":"#222"});

       }
       else if ($(this).attr('data-toggled') == 'on'){
        /* currently it has been toggled, and toggled to the 'on' state,
        so now turn off: */
        $(this).attr('data-toggled','off');
           // and do, or undo, something...
           $("p").css({"filter":"contrast(1)","-webkit-filter":"contrast()"});
           $("h1").css({"filter":"contrast(1)","-webkit-filter":"contrast(1)"});
           $("h2").css({"filter":"contrast(1)","-webkit-filter":"contrast(1)"});
           $("h3").css({"filter":"contrast(1)","-webkit-filter":"contrast(1)"});
           $("h4").css({"filter":"contrast(1)","-webkit-filter":"contrast(1)"});
           $("h5").css({"filter":"contrast(1)","-webkit-filter":"contrast(1)"});
           $("h6").css({"filter":"contrast(1)","-webkit-filter":"contrast(1)"});
           $("i").css({"filter":"contrast(1)","-webkit-filter":"contrast(1)"});
           $("a").css({"filter":"contrast(1)","-webkit-filter":"contrast(1)"});
           $("li").css({"filter":"contrast(1)","-webkit-filter":"contrast(1)"});
           $(".accessibility").css({"filter":"contrast(1)","-webkit-filter":"contrast(1)"});
       }
   });



      //enlarge font size
	      $('#enlarge-font-btn').on('click', function(){
	    
	        /* currently it's not been toggled, or it's been toggled to the 'off' state,
	           so now toggle to the 'on' state: */
	           $(this).attr('data-toggled','on');
	           // and do something...
	           newFontSize= parseInt($('p').css('font-size')) + 4;
			   $('p').css('font-size', newFontSize);

			   newFontSize= parseInt($('h1').css('font-size')) + 4;
			   $('h1').css('font-size', newFontSize);

			   newFontSize= parseInt($('h2').css('font-size')) + 4;
			   $('h2').css('font-size', newFontSize);

			   newFontSize= parseInt($('h3').css('font-size')) + 4;
			   $('h3').css('font-size', newFontSize);

			   newFontSize= parseInt($('h4').css('font-size')) + 4;
			   $('h4').css('font-size', newFontSize);

			   newFontSize= parseInt($('h5').css('font-size')) + 4;
			   $('h5').css('font-size', newFontSize);

			   newFontSize= parseInt($('h6').css('font-size')) + 4;
			   $('h6').css('font-size', newFontSize);

			   newFontSize= parseInt($('a').css('font-size')) + 4;
			   $('a').css('font-size', newFontSize);

			   newFontSize= parseInt($('li').css('font-size')) + 4;
			   $('li').css('font-size', newFontSize);

			   newFontSize= parseInt($('i').css('font-size')) + 4;
			   $('i').css('font-size', newFontSize);

	    
	});

	      //decrease font size
	      $('#decrease-font-btn').on('click', function(){
	    
	        /* currently it's not been toggled, or it's been toggled to the 'off' state,
	           so now toggle to the 'on' state: */
	           $(this).attr('data-toggled','on');
	           // and do something...
	           newFontSize= parseInt($('p').css('font-size')) - 4;
			   $('p').css('font-size', newFontSize);

			   newFontSize= parseInt($('h1').css('font-size')) - 4;
			   $('h1').css('font-size', newFontSize);

			   newFontSize= parseInt($('h2').css('font-size')) - 4;
			   $('h2').css('font-size', newFontSize);

			   newFontSize= parseInt($('h3').css('font-size')) - 4;
			   $('h3').css('font-size', newFontSize);

			   newFontSize= parseInt($('h4').css('font-size')) - 4;
			   $('h4').css('font-size', newFontSize);

			   newFontSize= parseInt($('h5').css('font-size')) - 4;
			   $('h5').css('font-size', newFontSize);

			   newFontSize= parseInt($('h6').css('font-size')) - 4;
			   $('h6').css('font-size', newFontSize);

			   newFontSize= parseInt($('a').css('font-size')) - 4;
			   $('a').css('font-size', newFontSize);

			   newFontSize= parseInt($('li').css('font-size')) - 4;
			   $('li').css('font-size', newFontSize);

			   newFontSize= parseInt($('i').css('font-size')) - 4;
			   $('i').css('font-size', newFontSize);
	    
	});


	      //large black marker
	      $('#large-black-marker-btn').on('click', function(){
	      	if (!$(this).attr('data-toggled') || $(this).attr('data-toggled') == 'off'){
	      		if($('#large-white-marker-btn').attr('data-toggled') == 'on'){
	      			$('#large-white-marker-btn').attr('data-toggled','off');
	      		}
        /* currently it's not been toggled, or it's been toggled to the 'off' state,
        so now toggle to the 'on' state: */
        $(this).attr('data-toggled','on');
           // and do something...
           $(".accessibility").css({"cursor":"url(images/icons/bigcursorblack.cur), auto"});
       }
       else if ($(this).attr('data-toggled') == 'on'){
        /* currently it has been toggled, and toggled to the 'on' state,
        so now turn off: */
        $(this).attr('data-toggled','off');
           // and do, or undo, something...
           $(".accessibility").css({"cursor":"auto"});
       }
   });

	      //large white marker
	      $('#large-white-marker-btn').on('click', function(){
	      	if (!$(this).attr('data-toggled') || $(this).attr('data-toggled') == 'off'){
	      		if($('#large-black-marker-btn').attr('data-toggled') == 'on'){
	      			$('#large-black-marker-btn').attr('data-toggled','off');
	      		}
        /* currently it's not been toggled, or it's been toggled to the 'off' state,
        so now toggle to the 'on' state: */
        $(this).attr('data-toggled','on');
           // and do something...
           $(".accessibility").css({"cursor":"url(images/icons/bigcursorwhite.cur), auto"});
       }
       else if ($(this).attr('data-toggled') == 'on'){
        /* currently it has been toggled, and toggled to the 'on' state,
        so now turn off: */
        $(this).attr('data-toggled','off');
           // and do, or undo, something...
           $(".accessibility").css({"cursor":"auto"});
       }
   });

	      //Zoom
	      $('#zoom-btn').on('click', function(){
	      	if (!$(this).attr('data-toggled') || $(this).attr('data-toggled') == 'off'){
        /* currently it's not been toggled, or it's been toggled to the 'off' state,
        so now toggle to the 'on' state: */
        $(this).attr('data-toggled','on');
           // and do something...
           $(".accessibility").css({"zoom":"1.5"});
       }
       else if ($(this).attr('data-toggled') == 'on'){
        /* currently it has been toggled, and toggled to the 'on' state,
        so now turn off: */
        $(this).attr('data-toggled','off');
           // and do, or undo, something...
           $(".accessibility").css({"zoom":"1"});
       }
   });

	      //highlight Headings
	      $('#highlight-headings-btn').on('click', function(){
	      	if (!$(this).attr('data-toggled') || $(this).attr('data-toggled') == 'off'){
        /* currently it's not been toggled, or it's been toggled to the 'off' state,
        so now toggle to the 'on' state: */
        $(this).attr('data-toggled','on');
           // and do something...
           
           $("h1").css({"font-weight":"bold","text-decoration":"underline"});
           $("h2").css({"font-weight":"bold","text-decoration":"underline"});
           $("h3").css({"font-weight":"bold","text-decoration":"underline"});
           $("h4").css({"font-weight":"bold","text-decoration":"underline"});
           $("h5").css({"font-weight":"bold","text-decoration":"underline"});
           $("h6").css({"font-weight":"bold","text-decoration":"underline"});
           
           
       }
       else if ($(this).attr('data-toggled') == 'on'){
        /* currently it has been toggled, and toggled to the 'on' state,
        so now turn off: */
        $(this).attr('data-toggled','off');
           // and do, or undo, something...
           
           $("h1").css({"font-weight":"normal","text-decoration":"none"});
           $("h2").css({"font-weight":"normal","text-decoration":"none"});
           $("h3").css({"font-weight":"normal","text-decoration":"none"});
           $("h4").css({"font-weight":"normal","text-decoration":"none"});
           $("h5").css({"font-weight":"normal","text-decoration":"none"});
           $("h6").css({"font-weight":"normal","text-decoration":"none"});
           
       }
   });

	      //highlight Links
	      $('#highlight-links-btn').on('click', function(){
	      	if (!$(this).attr('data-toggled') || $(this).attr('data-toggled') == 'off'){
        /* currently it's not been toggled, or it's been toggled to the 'off' state,
        so now toggle to the 'on' state: */
        $(this).attr('data-toggled','on');
           // and do something...
           
           $("a").css({"font-weight":"bold","text-decoration":"underline"});
           $("li").css({"font-weight":"bold","text-decoration":"underline"});
           
       }
       else if ($(this).attr('data-toggled') == 'on'){
        /* currently it has been toggled, and toggled to the 'on' state,
        so now turn off: */
        $(this).attr('data-toggled','off');
           // and do, or undo, something...
           
           $("a").css({"font-weight":"normal","text-decoration":"none"});
           $("li").css({"font-weight":"normal","text-decoration":"none"});
       }
   });