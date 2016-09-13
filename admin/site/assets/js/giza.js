/*

 * @package component giza for Joomla! 3.x
 * @version $Id: com_giza 1.0.0 2016-07-20 23:26:33Z $
 * @author Kian William Nowrouzian
 * @copyright (C) 2015- Kian William Nowrouzian
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of giza.
    giza is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    giza is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with giza.  If not, see <http://www.gnu.org/licenses/>.

*/

(function($){
	
	var config = {};
	var global = {selected:'', selector:''};
	var index1, index2, index3, index4, counter1, counter2, counter3, counter4, constindex, imageslen, l, t, w, h;
	
	var init = $.prototype.init;
		$.prototype.init = function (selector, context)
	    {
		   var r = init.apply(this, arguments);
		   if(selector && selector.selector)
		   {
			r.context = selector.context;
			r.selector = selector.selector;
		   }
		   if(typeof selector == 'string')
		   {
			r.context = context || document,r.selector = selector,global.selector = r.selector;
		   }
		   global.selected = r;
		   return r;
	   }
	   $.prototype.init.prototype = $.prototype;
	  $.fn.pharoa = {	  
		  config : function(options) {
			  setConfig($.extend({}, $.fn.pharoa.defaults, options));
			  global.selected.pharoa.init();
		  },
		  init : function(){
				
				var dim = parseInt(config.width);
				var x = Math.ceil((dim/0.866)-dim);
				var const1 = Math.ceil((dim - 55)/20);
				var Trans = Math.ceil(x/2) + const1;
				var apex = Math.ceil((9 * dim - 595)/10);
				var topOfBottomDim = Math.ceil((dim + 295)/5);
				
				var leftOfLeftDim = Math.ceil( (dim/200) * 75);
				var rightOfRightDim =Math.ceil((76*leftOfLeftDim-38)/38);
				var apexOfRightDim = Math.ceil((101*apex+200)/90);
				var shadowWidth=parseInt(dim/4);
				var shadowHeight = shadowWidth * 2;
				var shadowTop = dim+10;
				
				 imageslen = config.images.length;
				 constindex = imageslen/4;
				 index1 =0;
				 counter1 = 0;
				 index2 =constindex;
				 counter2 = constindex;
				 index3 =2 * constindex;
				 counter3 = 2 * constindex;
				 index4 =3 * constindex;
				 counter4 = 3 * constindex; 	
				
					
				if(dim < 170)
				{
					apexOfRightDim += 1;
					rightOfRightDim +=2;
				}
				var def =(parseInt(config.width)/2);
				 l=-dim/4;
				 t=-dim+(dim/3);
				 w=(dim/2);
				 h=(dim/3);
				 
				  var colors = hexToRgb(config.color);
				  var ac = colors.split(' ');

				
				global.selected.css({position:'relative', left:'50%', top:'10px', marginLeft:'-100px', perspective:'1000px', mozPerspective:'1000px', webkitPerspective:'1000px', msPerspective:'1000px'});
				$('<div class="pyramid-axis"></div>').css({position:'relative',width:dim+'px',  transformStyle:'preserve-3d', webkitTransformStyle:'preserve-3d', mozTransformStyle:'preserve-3d', msTransformStyle:'preserve-3d'}).appendTo('.pyramid');
				for(var i=0; i<4; i++)
				{					
					
					  $('<div title="" id="dim_'+i+'" style="position:absolute;border:'+(parseInt(config.width)/2)+'px solid transparent;"></div>').appendTo('.pyramid-axis');
					
				}
				
				$('.pyramid').children('div').children('div').eq(0).css({borderBottom:parseInt(config.width)+'px solid rgba('+ac[0]+','+ac[1]+','+ac[2]+', '+config.opacity+')', bottom:(-parseInt(apex))+'px', transform:'translateZ('+Trans+'px) rotateX(30deg)', webkitTransform:'translateZ('+Trans+'px) rotateX(30deg)', mozTransform:'translateZ('+Trans+'px) rotateX(30deg)', msTransform:'translateZ('+Trans+'px) rotateX(30deg)'});
			  	$('.pyramid').children('div').children('div').eq(1).css({borderBottom:parseInt(config.width)+'px solid rgba('+ac[0]+','+ac[1]+','+ac[2]+', '+config.opacity+')', bottom:(-parseInt(apex))+'px', transform:'translateZ('+(-Trans)+'px) rotateY(180deg) rotateX(30deg)', webkitTransform:'translateZ('+(-Trans)+'px) rotateY(180deg) rotateX(30deg)', mozTransform:'translateZ('+(-Trans)+'px) rotateY(180deg) rotateX(30deg)', msTransform:'translateZ('+(-Trans)+'px) rotateY(180deg) rotateX(30deg)'});
				$('.pyramid').children('div').children('div').eq(2).css({left:leftOfLeftDim+'px', borderBottom:parseInt(config.width)+'px solid rgba('+ac[0]+','+ac[1]+','+ac[2]+', '+config.opacity+')', bottom:(-parseInt(apex))+'px', transform:'rotateY(270deg) translateX('+(-(leftOfLeftDim+Trans))+'px) rotateX(30deg)', webkitTransform:'rotateY(270deg) translateX('+(-(leftOfLeftDim+Trans))+'px) rotateX(30deg)', mozTransform:'rotateY(270deg) translateX('+(-(leftOfLeftDim+Trans))+'px) rotateX(30deg)', msTransform:'rotateY(270deg) translateX('+(-(leftOfLeftDim+Trans))+'px) rotateX(30deg)', transformOrigin:'center left', webkitTransformOrigin:'center left', mozTransformOrigin:'center left', msTransformOrigin:'center left'});
				$('.pyramid').children('div').children('div').eq(3).css({right:rightOfRightDim+'px', borderBottom:parseInt(config.width)+'px solid rgba('+ac[0]+','+ac[1]+','+ac[2]+', '+config.opacity+')', bottom:(-parseInt(apexOfRightDim))+'px', transform:'rotateY(-270deg) translateX('+(leftOfLeftDim+Trans)+'px) rotateX(30deg)', webkitTransform:'rotateY(-270deg) translateX('+(leftOfLeftDim+Trans)+'px) rotateX(30deg)', mozTransform:'rotateY(-270deg) translateX('+(leftOfLeftDim+Trans)+'px) rotateX(30deg)', msTransform:'rotateY(-270deg) translateX('+(leftOfLeftDim+Trans)+'px) rotateX(30deg)', transformOrigin:'top right', webkitTransformOrigin:'top right', mozTransformOrigin:'top right', msTransformOrigin:'top right'});
				$('<div class="bottom"></div>').css({position:'absolute', width:dim+'px', height:dim+'px', top:-topOfBottomDim+'px', background:'#eec26f', transform:'rotateX(90deg) translateY('+(leftOfLeftDim+Trans)+'px)', webkitTransform:'rotateX(90deg) translateY('+(leftOfLeftDim+Trans)+'px)' , mozTransform:'rotateX(90deg) translateY('+(leftOfLeftDim+Trans)+'px)', msTransform:'rotateX(90deg) translateY('+(leftOfLeftDim+Trans)+'px)', transformOrigin:'bottom center', webkitTransformOrigin:'bottom center', mozTransformOrigin:'bottom center', msTransformOrigin:'bottom center'}).appendTo('.pyramid-axis');
				$('<div class="shadow"></div>').css({position:'absolute', boxShadow:'0 0 '+shadowWidth+'px '+shadowHeight+'px rgba(0,0,0,0.5)', top:shadowTop+'px', width:0, height:0, transform:'rotateX(90deg) translateX('+(leftOfLeftDim+Trans)+'px)', webkitTransform:'rotateX(90deg) translateX('+(leftOfLeftDim+Trans)+'px)' , mozTransform:'rotateX(90deg) translateX('+(leftOfLeftDim+Trans)+'px)', msTransform:'rotateX(90deg) translateX('+(leftOfLeftDim+Trans)+'px)'}).appendTo('.pyramid-axis');
				$('.pyramid').children('div').children('div').eq(0).css({ background:'url('+config.images[index1]+') no-repeat '+l+'px '+-t+'px', backgroundSize:w+'px '+h+'px'});
				$('.pyramid').children('div').children('div').eq(1).css({ background:'url('+config.images[index2]+') no-repeat '+l+'px '+-t+'px', backgroundSize:w+'px '+h+'px'});
				$('.pyramid').children('div').children('div').eq(2).css({ background:'url('+config.images[index3]+') no-repeat '+l+'px '+-t+'px', backgroundSize:w+'px '+h+'px'});
				$('.pyramid').children('div').children('div').eq(3).css({ background:'url('+config.images[index4]+') no-repeat '+l+'px '+-t+'px', backgroundSize:w+'px '+h+'px'});

				
				global.selected.pharoa.rotate();


		  },
		  rotate : function() {
			$({deg:0}).animate({deg:360}, { duration:parseInt(config.timer), step:function(n){
					$('.pyramid-axis').css({transform:'rotateY('+n+'deg)', webkitTransform:'rotateY('+n+'deg)', mozTransform:'rotateY('+n+'deg)', msTransform:'rotateY('+n+'deg)'});
                }, complete:function(){	

					
					$('.pyramid-axis').children('div').eq(0).hide("slow", function(){
						if(counter1<constindex-1)
							counter1++;
						else
							counter1=index1;
							$(this).css({background:'url('+config.images[counter1]+') no-repeat '+l+'px '+-t+'px', backgroundSize:w+'px '+h+'px'});
							$(this).attr("title", config.descs[counter1]);
							$(this).show("slow", function(){
							
							$('.pyramid-axis').children('div').eq(1).hide("slow", function(){
						       if(counter2<constindex*2-1)
							     counter2++;
						       else
							     counter2=index2;
							     $(this).css({background:'url('+config.images[counter2]+') no-repeat '+l+'px '+-t+'px', backgroundSize:w+'px '+h+'px'});
								 $(this).attr("title", config.descs[counter2]);

							     $(this).show("slow", function(){
								 
										$('.pyramid-axis').children('div').eq(2).hide("slow", function(){
						                     if(counter3<constindex*3-1)
							                   counter3++;
						                     else
							                   counter3=index3;
							                $(this).css({background:'url('+config.images[counter3]+') no-repeat '+l+'px '+-t+'px', backgroundSize:w+'px '+h+'px'});
											$(this).attr("title", config.descs[counter3]);

							                $(this).show("slow", function(){
											
											
												$('.pyramid-axis').children('div').eq(3).hide("slow", function(){
						                                if(counter4<constindex*4-1)
							                               counter4++;
						                                else
							                               counter4=index4;
							                           $(this).css({background:'url('+config.images[counter4]+') no-repeat '+l+'px '+-t+'px', backgroundSize:w+'px '+h+'px'});
													   $(this).attr("title", config.descs[counter4]);

							                           $(this).show("slow", function(){
															global.selected.pharoa.rotate();
													   })
							
					                              });
											
											
											})
							
					                        });
								 
								 })
							
					              });	
							
							})
							
					});
					
					
					
                        				
				} });
				
		  }
		  
	  }
	  
	   function setConfig(value){config = value;}
	   function getConfig() {return config;}
	    function hexToRgb(h)
       {
         var r = parseInt((cutHex(h)).substring(0,2),16), g = parseInt((cutHex(h)).substring(2,4),16), b = parseInt((cutHex(h)).substring(4,6),16);
         return r+' '+g+' '+b;
      }
       function cutHex(h) {return (h.charAt(0)=="#") ? h.substring(1,7):h}
	   
	  
}(jQuery))