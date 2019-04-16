
function formToggle(id) 
{
    let formAppear = document.getElementById(id);
    formAppear.style.display !== 'block' ? formAppear.style.display = 'block' : formAppear.style.display = 'none' 
}

function promHide(id) 
{
    document.getElementById(id).style.display = "none";
}

function confirmIt() 
{
    location.reload();
    //window.location.href = window.location.pathname + window.location.search + window.location.hash;
    return confirm('Are you sure you want to do it?');
}

function showCart(id) 
{
    let cart = document.getElementById(id)
    cart.style.display !== 'block' ? cart.style.display = 'block' : cart.style.display = 'none';
}