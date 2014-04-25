// Set delay
var delay = 500;

initialize();

function initialize() {
    var page = require('webpage').create();
    page.open('http://police.dev/?view=zones&format=json&limit=200', function () {
        var jsonSource = page.plainText;
        var sites = JSON.parse(jsonSource).items;
        console.log(sites.length);

        loopSites(0, sites);
    });
}

function loopSites(i, sites) {
    i = i || 0;
    if(i < sites.length) {

        takeScreenshot(sites[i].data.id);

        i++;

        //create a pause.
        setTimeout(function() { loopSites(i, sites) }, delay);
    } else {
        phantom.exit();
    }
}

function takeScreenshot(site) {
    var page = require('webpage').create();
    page.open('http://lokalepolitie.be/'+site, function (status) {
        if (status === "success") {
            console.log(site + ' : Success');
            page.render('screenshots/'+site+'.png');
            page.close();
        } else {
            console.log(site + ' : Failure');
            page.close();
        }
    });
}