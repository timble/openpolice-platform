function hamburger()
{
    toggleAttribute(document.getElementById('button'), 'aria-pressed');

    var User = require('apollo.js');
    var user = new User();

    User.toggleClass(document.getElementById('button'), 'close');
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