"use strict";

function loadData(url, onLoadFunc) {
    fetch(url).then((response) => {
        if (response.ok) {
            return response.json();
        } else {
            alert('Error: ' + response.status + ' - ' + response.statusText);
        }
    }).then((data) => {
        if (data) {
            onLoadFunc(data);
        }
    });
}

function loadTickers(onLoadFunc) {
    let url = '/ticker/get_all';
    loadData(url, onLoadFunc);
}

function addTickersToPage(tickers) {

    function tickerToHtml(ticker) {
        let tickerKey = ticker['ticker'];
        let tickerHtml = '<tr>';
        tickerHtml += '<td>'+tickerKey+'</td>';
        tickerHtml += '<td><div id="ticker'+tickerKey+'"></div><input type="button" onclick="showTicker(\''+tickerKey+'\')" value="Show detail"/></td>';
        tickerHtml += '</tr>';
        return tickerHtml;
    }

    let tickersHtml;
    if (tickers && tickers.length) {
        tickersHtml = tickers.reduce((acc, item)=>{
                return acc += tickerToHtml(item);
            }, '<table>') + '</table>';
    } else {
        tickersHtml = 'Empty. No one tickers have loaded';
    }

    let el = document.getElementById('tickersList');
    el.innerHTML = tickersHtml;
}

function showTickers() {
    loadTickers(addTickersToPage);
}

function loadTicker(tickerKey, onLoadFunc) {
    let url = encodeURI('/ticker/search/'+tickerKey);
    loadData(url, onLoadFunc);
}

function addTickerToPage(ticker) {
    if (!(ticker && ticker['ticker'])) {
        alert('Empty. No ticker info has loaded');
        return;
    }

    let el = document.getElementById('ticker'+ticker['ticker']);
    if (!el) {
        alert('Unknown ticker loaded: ' + ticker['ticker']);
        return;
    }

    let tickerHtml = '<p>Date pay: ';
    tickerHtml += ticker['date_pay'] ? ticker['date_pay'] : '';
    tickerHtml += '</p>';
    tickerHtml += '<p>Amount: ';
    tickerHtml +=ticker['amount'] ? ticker['amount'] : '';
    tickerHtml += '</p>';
    tickerHtml += '<p>Date ex: ';
    tickerHtml += ticker['date_ex'] ? ticker['date_ex'] : '';
    tickerHtml += '</p>';

    el.innerHTML = tickerHtml;
}

function showTicker(tickerKey) {
    loadTicker(tickerKey, addTickerToPage);
}