<form action="" method="get" class="-koowa-grid scrollable" style="padding: 20px">
    <div>
        <style>
            .google-visualization-table-tr-head td {
                text-align: right !important;
            }
            .google-visualization-table-tr-head td:first-child {
                text-align: left !important;
            }

            .google-visualization-table-th {
                border: 0 none !important;
                border-bottom: 1px solid #eee !important;
                background: none !important;
            }

            .google-visualization-table-td {
                border: 0 none !important;
                padding: 8px 8px 7px !important;
            }

            h2 {
                margin: 60px 0 20px;
                text-align: center;
            }
        </style>

        <script>
            (function(w,d,s,g,js,fs){
                g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
                js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
                js.src='https://apis.google.com/js/platform.js';
                fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
            }(window,document,'script'));
        </script>

        <div id="embed-api-auth-container"></div>
        <div id="date"></div>
        <h2><?= translate('Pages') ?></h2>
        <div id="pagePath"></div>
        <h2><?= translate('Landing Pages') ?></h2>
        <div id="landingPagePath"></div>
        <h2><?= translate('Search Terms') ?></h2>
        <div id="searchKeyword"></div>

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
                        filters: 'ga:pagePath=@/<?= $site ?>'
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
                        metrics: 'ga:pageviews, ga:bounceRate, ga:exitRate',
                        filters: 'ga:pagePath=@/<?= $site ?>',
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
                    data.setColumnLabel(2, 'Bounce Rate');
                    data.setColumnLabel(3, 'Exit Rate');

                    formatter.format(data, 2);
                    formatter.format(data, 3);

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
                        filters: 'ga:pagePath=@/<?= $site ?>',
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

                var searchKeyword = new gapi.analytics.googleCharts.DataChart({
                    query: {
                        ids: '<?= $viewId ?>',
                        dimensions: 'ga:searchKeyword',
                        'start-date': '30daysAgo',
                        'end-date': 'yesterday',
                        'max-results': 10,
                        metrics: 'ga:searchUniques',
                        filters: 'ga:pagePath=@/<?= $site ?>',
                        sort: '-ga:searchUniques'
                    },
                    chart: {
                        container: 'searchKeyword',
                        type: 'TABLE',
                        options: {
                            width: '100%'
                        }
                    }
                });
                searchKeyword.execute();
            });
        </script>
    </div>
</form>