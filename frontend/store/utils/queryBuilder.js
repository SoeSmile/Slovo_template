export default function (query, data, reset = {count: 20}) {

    // если обект дополнить и изменить запрос
    if (data instanceof Object) {
        for (let i in data) {
            query[i] = data[i];
        }
    }

    // сброс запроса
    if (data === 'reset') {
        query = reset;
    }

    return query;
}