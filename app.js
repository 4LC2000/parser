const { JSDOM } = require("jsdom");
const { window } = new JSDOM("");
const $ = require("jquery")(window);
const axios = require('axios');

let news = [];

(async () => {
    const response = await fetch('https://tsn.ua/tags/%D0%9A%D1%80%D0%B5%D0%BC%D0%B5%D0%BD%D1%87%D1%83%D0%BA');
    let body = await response.text();

    $(body).find('article').each(async function () {
        news.push(
            parse($(this).find('.c-card__link').attr('href'))
        );
    });

    let data = await Promise.all(news)

    storeNews(data);
})();

async function parse(url) {
    let news = {
        source: "TSN",
        full_text: "",
        description: "",
        title: "",
        link: url,
        category: "",
        pub_date: ""
    };

    const response = await fetch(url);
    let body = await response.text();

    news.title = $(body).find('.c-article').find('h1').find('span').text();
    news.description = $(body).find('.c-article').find('.c-article__body').find('.c-article__lead').find('p').find('strong').text();
    news.full_text = $(body).find('.c-article').find('.c-article__body').find('div').find('p').text();
    news.pub_date = $(body).find('.c-article').find('.c-card__body').find('.c-bar').find('.c-bar__label').find('time').attr('datetime');
    news.link = url;

    return news;
}

function storeNews(news) {
    axios.post('http://localhost/index.php?route=save', {data:  news})
        .then(function (response) {
            console.log(response, 'resp');
        })
        .catch(function (error) {
            console.log(error, 'e');
        });
}

