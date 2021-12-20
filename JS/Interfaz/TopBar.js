
(function() 
{

    /* Selector */
    const select = (el, all = false) => {
    el = el.trim()
        if (all) {
            return [...document.querySelectorAll(el)]
        } else {
            return document.querySelector(el)
        }
    };


    /* Funcion event listener */
    const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
        if (all) {
        selectEl.forEach((e) => e.addEventListener(type, listener))
        } else {
        selectEl.addEventListener(type, listener)
        }
    }
    }

    /* On Scroll evnt listener */
    const onscroll = (el, listener) => {
    el.addEventListener("scroll", listener)
    }

    /* Navbar active state on scroll */
    let navbarlinks = select("#navbar .scrollto", true)
    const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach((navbarlink) => {
        if (!navbarlink.hash) return
        let section = select(navbarlink.hash)
        if (!section) return
        if (
        position >= section.offsetTop &&
        position <= section.offsetTop + section.offsetHeight
        ) {
        navbarlink.classList.add("active")
        } else {
        navbarlink.classList.remove("active")
        }
    })
    }
    window.addEventListener("load", navbarlinksActive)
    onscroll(document, navbarlinksActive)

    /* Scroll a elemento con header offset */
    const scrollto = (el) => {
    let header = select("#header")
    let offset = header.offsetHeight

    let elementPos = select(el).offsetTop
    window.scrollTo({
        top: elementPos - offset,
        behavior: "smooth",
    })
    }

    /* Toggle .header-scrolled class to #header when page is scrolled */
    let selectHeader = select("#header")
    let selectTopbar = select("#topbar")
    if (selectHeader) {
    const headerScrolled = () => {
        if (window.scrollY > 100) {
        selectHeader.classList.add("header-scrolled")
        if (selectTopbar) {
            selectTopbar.classList.add("topbar-scrolled")
        }
        } else {
        selectHeader.classList.remove("header-scrolled")
        if (selectTopbar) {
            selectTopbar.classList.remove("topbar-scrolled")
        }
        }
    }
    window.addEventListener("load", headerScrolled)
    onscroll(document, headerScrolled)
    }

})()
