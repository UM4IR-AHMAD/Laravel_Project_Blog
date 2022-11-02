

// category form show and hide 
function addCategoryToggle() {
    
    let target = document.querySelector('.add-category');
    target.classList.toggle('hide');
}


function dropMenu(){
    console.log('dropdown hover working');
    var dropdownMenu = document.querySelector('#dropdownMenu');
    dropdownMenu.style.height = '65px';
}

function closeMenu() {
    var dropdownMenu = document.querySelector('#dropdownMenu');
    dropdownMenu.style.height = '0';
}