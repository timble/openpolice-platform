<style src="assets://analytics/css/default.css" />

<form action="" method="get" class="-koowa-grid scrollable" style="padding: 20px">
    <div>
        <script>
            (function(w,d,s,g,js,fs){
                g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
                js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
                js.src='https://apis.google.com/js/platform.js';
                fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
            }(window,document,'script'));
        </script>

        <div id="embed-api-auth-container"></div>
        <h1><?= $start_date ?> - <?= $end_date ?></h1>
        <div id="date"></div>
        <h2><?= translate('Pages') ?></h2>
        <p class="description"><?= translate('The most visited pages') ?>.</p>
        <div id="pagePath"></div>
        <h2><?= translate('Landing Pages') ?></h2>
        <p class="description"><?= translate('The pages through which visitors entered your site the most') ?>.</p>
        <div id="landingPagePath"></div>
        <h2><?= translate('Acquisition') ?></h2>
        <p class="description"><?= translate('The top places users were before seeing your content, like a search engine or another website') ?>.</p>
        <div id="acquisition"></div>
        <h2><?= translate('Legend') ?></h2>
        <dl>
            <dt><?= translate('Bounce Rate') ?></dt>
            <dd><?= translate('Bounce Rate is the percentage of single-page visits, it indicates how often users exit your site from the entrance page without viewing another page') ?>.</dd>
            <dt><?= translate('Exit Rate') ?></dt>
            <dd><?= translate('Exit Rate indicates how often users exit from that page') ?>.</dd>
            <dt><?= translate('Sessions') ?></dt>
            <dd><?= translate('A session is the period time a user is actively engaged with your website') ?>.</dd>
        </dl>

        <script>
            gapi.analytics.ready(function()
            {
                gapi.analytics.auth.authorize({
                    serverAuth: {
                        access_token: '<?= $accessToken ;?>'
                    }
                });

                var date = new gapi.analytics.googleCharts.DataChart({
                    query: {
                        ids: '<?= $viewId ?>',
                        dimensions: 'ga:date',
                        'start-date': '30daysAgo',
                        'end-date': 'yesterday',
                        metrics: 'ga:sessions',
                        filters: '<?= $filters ?>'
                    },
                    chart: {
                        container: 'date',
                        type: 'LINE',
                        options: {
                            width: '100%'
                        }
                    }
                });
                date.execute();

                var pagePath = new gapi.analytics.report.Data({
                    query: {
                        ids: '<?= $viewId ?>',
                        dimensions: 'ga:pagePath',
                        'start-date': '30daysAgo',
                        'end-date': 'yesterday',
                        'max-results': 10,
                        metrics: 'ga:pageviews, ga:uniquePageviews, ga:bounceRate, ga:exitRate',
                        filters: '<?= $filters ?>',
                        sort: '-ga:pageviews',
                        output: 'dataTable'
                    },
                    chart: {
                        container: 'pagePath',
                        type: 'TABLE',
                        options: {
                            width: '100%'
                        }
                    }
                });
                pagePath.execute();

                pagePath.on('success', function(response) {
                    var data = new google.visualization.DataTable(response.dataTable);
                    var formatter = new google.visualization.NumberFormat({fractionDigits: 0, suffix: ' %'});

                    var options = {
                        sort: 'disable'
                    };

                    data.setColumnLabel(0, 'Page');
                    data.setColumnLabel(1, 'Pageviews');
                    data.setColumnLabel(2, 'Unique Pageviews');
                    data.setColumnLabel(3, 'Bounce Rate');
                    data.setColumnLabel(4, 'Exit Rate');

                    formatter.format(data, 3);
                    formatter.format(data, 4);

                    var table = new google.visualization.Table(document.getElementById('pagePath'));
                    table.draw(data, options);
                });

                var landingPagePath = new gapi.analytics.report.Data({
                    query: {
                        ids: '<?= $viewId ?>',
                        dimensions: 'ga:landingPagePath',
                        'start-date': '30daysAgo',
                        'end-date': 'yesterday',
                        'max-results': 10,
                        metrics: 'ga:entrances, ga:bounceRate',
                        filters: '<?= $filters ?>',
                        sort: '-ga:entrances',
                        output: 'dataTable'
                    },
                    chart: {
                        container: 'landingPagePath',
                        type: 'TABLE',
                        options: {
                            width: '100%'
                        }
                    }
                });
                landingPagePath.execute();

                landingPagePath.on('success', function(response) {
                    var data = new google.visualization.DataTable(response.dataTable);
                    var formatter = new google.visualization.NumberFormat({fractionDigits: 0, suffix: ' %'});

                    var options = {
                        sort: 'disable'
                    };

                    data.setColumnLabel(0, 'Page');
                    data.setColumnLabel(1, 'Entrances');
                    data.setColumnLabel(2, 'Bounce Rate');

                    formatter.format(data, 2);

                    var table = new google.visualization.Table(document.getElementById('landingPagePath'));
                    table.draw(data, options);
                });

                var acquisition = new gapi.analytics.googleCharts.DataChart({
                    query: {
                        ids: '<?= $viewId ?>',
                        dimensions: 'ga:fullReferrer',
                        'start-date': '30daysAgo',
                        'end-date': 'yesterday',
                        'max-results': 10,
                        metrics: 'ga:sessions',
                        filters: '<?= $filters ?>',
                        sort: '-ga:sessions'
                    },
                    chart: {
                        container: 'acquisition',
                        type: 'TABLE',
                        options: {
                            width: '100%'
                        }
                    }
                });
                acquisition.execute();
            });
        </script>
    </div>
</form>