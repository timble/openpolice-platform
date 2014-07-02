function hamburger()
{
    toggleAttribute(document.getElementById('hamburger'), 'aria-pressed');
}

function toggleAttribute(element, attribute)
{
    if (element.getAttribute(attribute) == 'true' ) {
        element.setAttribute(attribute, 'false');
    }
    else {
        element.setAttribute(attribute, 'true');
    }
}