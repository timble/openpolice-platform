/*
 * Takes provided URL passed as argument and make screenshots of this page with several viewport sizes.
 * These viewport sizes are arbitrary, taken from iPhone & iPad specs, modify the array as needed
 *
 * Usage:
 * $ casperjs screenshots.js http://example.com
 */

var casper = require("casper").create();

var screenshotUrl = 'http://www.lokalepolitie.be/5388',
    screenshotNow = new Date(),
    screenshotDateTime = screenshotNow.getFullYear() + pad(screenshotNow.getMonth() + 1) + pad(screenshotNow.getDate()) + '-' + pad(screenshotNow.getHours()) + pad(screenshotNow.getMinutes()) + pad(screenshotNow.getSeconds()),
    viewports = [
        {
            'name': '320',
            'viewport': {width: 320}
        },
        {
            'name': '600',
            'viewport': {width: 600}
        },
        {
            'name': '767',
            'viewport': {width: 767}
        },
        {
            'name': '998',
            'viewport': {width: 998}
        }
    ];

casper.start(screenshotUrl, function() {
    this.echo('Current location is ' + this.getCurrentUrl(), 'info');
});

casper.each(viewports, function(casper, viewport) {
    this.then(function() {
        this.viewport(viewport.viewport.width, 1200);
    });
    this.thenOpen(screenshotUrl, function() {
        this.wait(5000);
    });
    this.then(function(){
        this.echo('Screenshot for ' + viewport.name + ' (' + viewport.viewport.width + ')', 'info');
        this.capture('output/' + screenshotDateTime + '/' + viewport.name + '.png', {
            top: 0,
            left: 0,
            width: viewport.viewport.width,
            height: 1200
        });
    });
});

casper.run();

function pad(number) {
    var r = String(number);
    if ( r.length === 1 ) {
        r = '0' + r;
    }
    return r;
}