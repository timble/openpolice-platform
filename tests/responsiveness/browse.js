var site = '5388'
var host = 'http://www.lokalepolitie.be/'+site+'/';

casper.test.begin('Testing the Questions search', 4, function suite(test) {
    casper.start(host+'vragen', function() {
        test.assertTitle("Veelgestelde vragen", "page title is the one expected");
        test.assertExists('form', "Search form is found");
    });

    casper.then(function() {
        this.fill('form[action="/5388/vragen"]', { searchword: 'diefstal' }, true);
    });

    casper.then(function() {
        test.assertUrlMatch(/searchword=diefstal/, "Search term has been submitted");
        test.assertEval(function() {
            return __utils__.findAll("div.component ul li").length >= 3;
        }, "Search for \"diefstal\" retrieves 3 or more results");
    });

    casper.run(function() {
        test.done();
    });
});

casper.test.begin('Testing the districts search for Bondgenotenlaan', 4, function suite(test) {
    casper.start(host+'vragen', function() {
        test.assertTitle("Veelgestelde vragen", "page title is the one expected");
        test.assertExists('form', "Search form is found");
    });

    casper.then(function() {
        this.fill('form[action="/5388/contact/je-wijkinspecteur"]', { street: 'bondgenotenlaan' }, true);
    });

    casper.then(function() {
        test.assertUrlMatch("/leuven-centrum-station-1", "District officer is found");
        test.assertVisible('address', "Address information is visible");
    });

    casper.run(function() {
        test.done();
    });
});

casper.test.begin('Testing the districts search for Celestijnenlaan', 4, function suite(test) {
    casper.start(host+'vragen', function() {
        test.assertTitle("Veelgestelde vragen", "page title is the one expected");
        test.assertExists('form', "Search form is found");
    });

    casper.then(function() {
        this.fill('form[action="/5388/contact/je-wijkinspecteur"]', { street: 'celestijnenlaan' }, true);
    });

    casper.then(function() {
        test.assertEval(function() {
            return __utils__.findAll("div.component ul li").length >= 3;
        }, "Search for \"celestijnenlaan\" retrieves 3 or more results");
    });

    casper.then(function() {
        this.click('div.component ul > li a');
    });

    casper.then(function() {
        test.assertVisible('address', "Address information is visible");
    });

    casper.run(function() {
        test.done();
    });
});