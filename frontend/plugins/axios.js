export default function ({$axios, redirect, store, route}) {

    if (process.server) {
        $axios.setBaseURL('http://nginx/')
    }

    $axios.onError(error => {

        const code         = parseInt(error.response.status);
        const excludeRoute = ['login'];

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