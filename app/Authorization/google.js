var casper = require('casper').create();

// casper.userAgent(casper.cli.args[0]);

casper.start('http://rivalregions.com/');

casper.thenClick('div.gogo');

casper.thenEvaluate(function(){
    document.getElementById('Email').setAttribute('value', casper.cli.args[0]);
    document.getElementById('next').click();
});

casper.then(function(){
    this.waitForSelector('#Passwd', function(){
        this.evaluate(function(){
            document.getElementById('Passwd').setAttribute('value', casper.cli.args[1]);
            document.getElementById('next').click();
        });
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