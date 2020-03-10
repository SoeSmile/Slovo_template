export default ({app}, inject) => {
    /**
     * формирование запроса
     */
    inject('requestMake', (query, data, reset = {count: 20}) => {
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

    });

    /**
     * выполнение
     */
    inject('requestRun', (method, url, data) => {
        let request = ['post', 'put'].includes(method) ? data : {params: data};

        return app.$axios[method](url, request)
            .then(response => {
                return response.data;
            })
            .catch(e => {
                return e.response.data.errors;
            });
    });

    /**
     * реверс массива для выборки дат
     *
     * @example ['1-2-3','1-2-3'] => ['3-2-1','3-2-1']
     */
    inject('reverseRange', (range) => {
        let array = [];

        for (let i in range) {
            if (range[i]) {
                array.push(range[i].split('-').reverse().join('-'));
            } else {
                return null;
            }
        }

        return array;
    });
}