function toggleHelpBox() {
    var helpBoxOuter = document.getElementById('backtrace');
    helpBoxOuter.classList.toggle('is-hidden');
    var moreLessButton = document.getElementById('more-less-button');
    if (helpBoxOuter.classList.contains('hidden')) {
        moreLessButton.innerText = moreLessButton.moreText;
    } else {
        moreLessButton.innerText = moreLessButton.lessText;
    }
}