function menuShow() {
    let menuMobile = document.querySelector('.hide-menu');
    
    if (menuMobile.classList.contains('open-menu')){
        menuMobile.classList.remove('open-menu');
        document.querySelector('.icon').name = "menu-outline";
    }else{
        menuMobile.classList.add('open-menu');
        document.querySelector('.icon').name = "close-outline";
    }
}