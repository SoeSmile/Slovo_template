export default function ({$axios, redirect, store, route}) {
    $axios.onError(error => {

        const code         = parseInt(error.response.status);
        const excludeRoute = ['api/login'];

        switch (code) {
            case 401:
                if (!excludeRoute.includes(error.response.config.url)) {
                    store.dispatch('auth/clearUser');
                }
                break;
            case 404:
                redirect('/404');
                break;
        }
    })
}