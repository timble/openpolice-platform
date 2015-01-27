/**
 * Set attributes to hamburger button
 */
function hamburger()
{
    toggleAttribute(document.getElementById('hamburger'), 'aria-pressed');
}

/**
 * Toggle attributes
 * @param      {String}   element       The element to toggle
 * @param      {String}   attribute     The attribute
 */
function toggleAttribute(element, attribute)
{
    if (element.getAttribute(attribute) == 'true' ) {
        element.setAttribute(attribute, 'false');
    }
    else {
        element.setAttribute(attribute, 'true');
    }
}