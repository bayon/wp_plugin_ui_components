 
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
	 console.log('item looped...');
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    console.log('item clicked...');
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
 

console.log('accordion js is loaded...');