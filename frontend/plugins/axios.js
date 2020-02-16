export default function ({$axios, redirect, store}) {
    $axios.onError(error => {
        const code = parseInt(error.response && error.response.status);

        switch (code) {
            case 401:
                store.dispatch('auth/clearUser');
                break;
            case 404:
                redirect('/404');
                break;
        }
    })
}