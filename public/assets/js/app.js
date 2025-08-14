document.addEventListener('DOMContentLoaded',function(){
	var carousels = document.querySelectorAll('.carousel');
	carousels.forEach(function(c){
		var interval = c.getAttribute('data-bs-interval') || 5000;
		var inst = bootstrap.Carousel.getOrCreateInstance(c, { interval: parseInt(interval,10) });
	});
});