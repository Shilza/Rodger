var casper = require('casper').create();

// casper.userAgent(casper.cli.args[0]);

casper.start('http://rivalregions.com/');

casper.thenClick('div.gogo');

casper.then(function(){
    this.sendKeys('#Email', casper.cli.args[0]);
    this.click('#next');
});

casper.then(function(){
    this.echo(this.cli.args[0]);
    this.waitForSelector('#Passwd', function(){
        this.sendKeys('#Passwd', casper.cli.args[1]);
        this.click('#next');
    });
});

casper.then(function(){
    this.waitForSelector('#money_dis_countdown', function(){
        var arr = [];
        phantom.cookies.forEach(function(e){
            arr.push({
                Name: e.name,
                Value: e.value,
                Domain: e.domain,
                Path: e.path,
                MaxAge: e.maximumAge,
                Expires: e.expiry,
                Secure: false,
                Discard: false,
                HttpOnly: false
            });
        });
        this.echo(JSON.stringify(arr));
    });
});

casper.run();