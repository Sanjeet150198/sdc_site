// JavaScript Document



var topi=document.getElementById("top");

var offset;
window.onscroll=function(){
	offset=window.pageYOffset;
	//demo.innerHTML=offset;
	if(offset>200){
		topi.style.display="block";
		}
	else{
		topi.style.display="none";
		}
	}
		
top.addEventListener("click",topreach);
function topreach(){
window.scrollTo(0,0);

	}
	