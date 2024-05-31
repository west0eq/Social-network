window.addEventListener('load', function(){
    this.setTimeout(function(){
        var loader = document.querySelector('.loader');

        loader.style.transition = 'opacity 0.5s ease-in-out';
        loader.style.opacity = '0'
        setTimeout(function(){
            loader.style.display = 'none';
            loader.style.zIndex = 'auto';

        }, 700);
    }, 2800);
});