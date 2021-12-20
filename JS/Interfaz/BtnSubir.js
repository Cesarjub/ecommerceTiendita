
(function() 
{
    /* Boton ir hacia arriba */
    const buttonTop = document.querySelector('.botonArriba')
    
    window.onscroll = () => 
    {
        if (document.body.scrollTop > 100) //document.documentElement.scrollTop
           buttonTop.classList.add('shows')
        else
           buttonTop.classList.remove('shows')

        buttonTop.addEventListener('click', () => 
        {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            })
        })
    }

})()