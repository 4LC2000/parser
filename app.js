const { JSDOM } = require("jsdom");
const { window } = new JSDOM("");
const $ = require("jquery")(window);
const axios = require('axios');

fetch('https://tsn.ua/tags/%D0%9A%D1%80%D0%B5%D0%BC%D0%B5%D0%BD%D1%87%D1%83%D0%BA')
    .then(function (res) {
        return res.text();
    })
    .then(function (body) {
        let news = [];
        $(body).find('article').each(function () {
            news.push(
                parse($(this).find('.c-card__link').attr('href'))
            );
            return false;
            console.log(news);
        })
    }
    )

function parse(url) {
    const news = {
        source: "dsfsfd",
        full_text: ""
    };

    fetch(url)
        .then(function (response) {
            return response.text();
        })
        .then(function (body) {
            console.log($(body).find('.c-article').find('h1').find('span').text());
            console.log($(body).find('.c-article').find('.c-article__body').find('.c-article__lead').find('p').find('strong').text());
            //
        })

    return news;
}